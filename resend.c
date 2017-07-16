/*
Copyright (c) 2007, 2008 by Juliusz Chroboczek

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

#include <sys/time.h>
#include <time.h>
#include <string.h>
#include <stdlib.h>

#include "babeld.h"
#include "util.h"
#include "neighbour.h"
#include "resend.h"
#include "message.h"
#include "interface.h"
#include "configuration.h"
#include "route.h"

struct timeval resend_time = {0, 0};
struct resend *to_resend = NULL;

static int
resend_match(struct resend *resend,
             int kind, const unsigned char *prefix, unsigned char plen,
             const unsigned char *src_prefix, unsigned char src_plen,
             unsigned char tos)
{
    return (resend->kind == kind &&
            resend->plen == plen && memcmp(resend->prefix, prefix, 16) == 0 &&
            resend->src_plen == src_plen &&
            resend->tos == tos &&
            memcmp(resend->src_prefix, src_prefix, 16) == 0);
}

static struct resend *
find_resend(int kind, const unsigned char *prefix, unsigned char plen,
            const unsigned char *src_prefix, unsigned char src_plen,
            unsigned char tos,
            struct resend **previous_return)
{
    struct resend *current, *previous;

    previous = NULL;
    current = to_resend;
    while(current) {
        if(resend_match(current, kind, prefix, plen,
                        src_prefix, src_plen, tos)) {
            if(previous_return)
                *previous_return = previous;
            return current;
        }
        previous = current;
        current = current->next;
    }

    return NULL;
}

struct resend *
find_request(const unsigned char *prefix, unsigned char plen,
             const unsigned char *src_prefix, unsigned char src_plen,
             unsigned char tos,
             struct resend **previous_return)
{
    return find_resend(RESEND_REQUEST, prefix, plen, src_prefix, src_plen, tos,
                       previous_return);
}

int
record_resend(int kind, const unsigned char *prefix, unsigned char plen,
              const unsigned char *src_prefix, unsigned char src_plen,
              unsigned char tos,
              unsigned short seqno, const unsigned char *id,
              struct interface *ifp, int delay)
{
    struct resend *resend;
    unsigned int ifindex = ifp ? ifp->ifindex : 0;

    if((kind == RESEND_REQUEST &&
        input_filter(NULL, prefix, plen, src_prefix, src_plen, tos, NULL,
                     ifindex) >=
        INFINITY) ||
       (kind == RESEND_UPDATE &&
        output_filter(NULL, prefix, plen, src_prefix, src_plen, tos, ifindex) >=
        INFINITY))
        return 0;

    if(delay >= 0xFFFF)
        delay = 0xFFFF;

    resend = find_resend(kind, prefix, plen, src_prefix, src_plen, tos, NULL);
    if(resend) {
        if(resend->delay && delay)
            resend->delay = MIN(resend->delay, delay);
        else if(delay)
            resend->delay = delay;
        resend->time = now;
        resend->max = RESEND_MAX;
        if(id && memcmp(resend->id, id, 8) == 0 &&
           seqno_compare(resend->seqno, seqno) > 0) {
            return 0;
        }
        if(id)
            memcpy(resend->id, id, 8);
        else
            memset(resend->id, 0, 8);
        resend->seqno = seqno;
        if(resend->ifp != ifp)
            resend->ifp = NULL;
    } else {
        resend = calloc(1, sizeof(struct resend));
        if(resend == NULL)
            return -1;
        resend->kind = kind;
        resend->max = RESEND_MAX;
        resend->delay = delay;
        memcpy(resend->prefix, prefix, 16);
        resend->plen = plen;
        memcpy(resend->src_prefix, src_prefix, 16);
        resend->src_plen = src_plen;
        resend->tos = tos;
        resend->seqno = seqno;
        if(id)
            memcpy(resend->id, id, 8);
        resend->ifp = ifp;
        resend->time = now;
        if(kind == RESEND_UPDATE) {
            int neigh_num = 0;
            struct neighbour *neigh;
            FOR_ALL_NEIGHBOURS(neigh) {
                neigh_num++;
            }
            resend->neigh = malloc(neigh_num * sizeof(*resend->neigh));
            if(!resend->neigh) {
                neigh_num = 0;
            } else {
                resend->neigh_num = neigh_num;
                FOR_ALL_NEIGHBOURS(neigh) {
                    --neigh_num;
                    resend->neigh[neigh_num] = neigh;
                }
                resend->nonce = random() & 0xFFFF;
            }
        }
        resend->next = to_resend;
        to_resend = resend;
    }

    if(resend->delay) {
        struct timeval timeout;
        timeval_add_msec(&timeout, &resend->time, resend->delay);
        timeval_min(&resend_time, &timeout);
    }
    return 1;
}

static int
resend_expired(struct resend *resend)
{
    switch(resend->kind) {
    case RESEND_REQUEST:
        return timeval_minus_msec(&now, &resend->time) >= REQUEST_TIMEOUT;
    default:
        return resend->max <= 0;
    }
}

int
unsatisfied_request(const unsigned char *prefix, unsigned char plen,
                    const unsigned char *src_prefix, unsigned char src_plen,
                    unsigned char tos,
                    unsigned short seqno, const unsigned char *id)
{
    struct resend *request;

    request = find_request(prefix, plen, src_prefix, src_plen, tos, NULL);
    if(request == NULL || resend_expired(request))
        return 0;

    if(memcmp(request->id, id, 8) != 0 ||
       seqno_compare(request->seqno, seqno) <= 0)
        return 1;

    return 0;
}

/* Determine whether a given request should be forwarded. */
int
request_redundant(struct interface *ifp,
                  const unsigned char *prefix, unsigned char plen,
                  const unsigned char *src_prefix, unsigned char src_plen,
                  unsigned char tos,
                  unsigned short seqno, const unsigned char *id)
{
    struct resend *request;

    request = find_request(prefix, plen, src_prefix, src_plen, tos, NULL);
    if(request == NULL || resend_expired(request))
        return 0;

    if(memcmp(request->id, id, 8) == 0 &&
       seqno_compare(request->seqno, seqno) > 0)
        return 0;

    if(request->ifp != NULL && request->ifp != ifp)
        return 0;

    if(request->max > 0)
        /* Will be resent. */
        return 1;

    if(timeval_minus_msec(&now, &request->time) <
       (ifp ? MIN(ifp->hello_interval, 1000) : 1000))
        /* Fairly recent. */
        return 1;

    return 0;
}

int
satisfy_request(const unsigned char *prefix, unsigned char plen,
                const unsigned char *src_prefix, unsigned char src_plen,
                unsigned char tos,
                unsigned short seqno, const unsigned char *id,
                struct interface *ifp)
{
    struct resend *request, *previous;

    request = find_request(prefix, plen, src_prefix, src_plen, tos, &previous);
    if(request == NULL)
        return 0;

    if(ifp != NULL && request->ifp != ifp)
        return 0;

    if(memcmp(request->id, id, 8) != 0 ||
       seqno_compare(request->seqno, seqno) <= 0) {
        /* We cannot remove the request, as we may be walking the list right
           now.  Mark it as expired, so that expire_resend will remove it. */
        request->max = 0;
        request->time.tv_sec = 0;
        recompute_resend_time();
        return 1;
    }

    return 0;
}

void
expire_resend()
{
    struct resend *current, *previous;
    int recompute = 0;

    previous = NULL;
    current = to_resend;
    while(current) {
        if(resend_expired(current)) {
            if(previous == NULL) {
                to_resend = current->next;
                free(current);
                current = to_resend;
            } else {
                previous->next = current->next;
                free(current);
                current = previous->next;
            }
            recompute = 1;
        } else {
            previous = current;
            current = current->next;
        }
    }
    if(recompute)
        recompute_resend_time();
}

void
recompute_resend_time()
{
    struct resend *request;
    struct timeval resend = {0, 0};

    request = to_resend;
    while(request) {
        if(!resend_expired(request) && request->delay > 0 && request->max > 0) {
            struct timeval timeout;
            timeval_add_msec(&timeout, &request->time, request->delay);
            timeval_min(&resend, &timeout);
        }
        request = request->next;
    }

    resend_time = resend;
}

void
do_resend()
{
    struct resend *resend;

    resend = to_resend;
    while(resend) {
        if(!resend_expired(resend) && resend->delay > 0 && resend->max > 0) {
            struct timeval timeout;
            timeval_add_msec(&timeout, &resend->time, resend->delay);
            if(timeval_compare(&now, &timeout) >= 0) {
                switch(resend->kind) {
                case RESEND_REQUEST:
                    send_multihop_request(resend->ifp,
                                          resend->prefix, resend->plen,
                                          resend->src_prefix, resend->src_plen,
                                          resend->tos,
                                          resend->seqno, resend->id, 127);
                    break;
                case RESEND_UPDATE:
                    if(resend->neigh) 
                        send_update(resend->ifp, 1,
                                 resend->prefix, resend->plen,
                                 resend->src_prefix, resend->src_plen,
                                 resend->tos);
                    break;
                default: abort();
                }
                resend->delay = MIN(0xFFFF, resend->delay * 2);
                resend->max--;
            }
        }
        resend = resend->next;
    }
    recompute_resend_time();
}

int
find_nonce(const unsigned char *prefix, unsigned char plen,
            const unsigned char *src_prefix, unsigned char src_plen,
            unsigned char tos)
{
    struct resend *resend = find_resend(RESEND_UPDATE, prefix, plen,
            src_prefix, src_plen,
            tos, NULL);
    return resend ? resend->nonce : -1;
}

static struct resend *
flush_neighbour_resend_1(struct resend *previous, struct resend *curr,
                         const struct neighbour *neigh)
{
    int i;
    if(neigh == NULL) {
        curr->neigh_num = 0;
    } else {
        for(i = 0; i < curr->neigh_num; i++) {
            if(curr->neigh[i] == neigh) {
                memcpy(curr->neigh + i, curr->neigh + i + 1,
                       (curr->neigh_num - 1 - i) * sizeof(*curr->neigh));
                curr->neigh_num--;
            }
        }
    }
    if(curr->neigh_num == 0) {
        struct babel_route *route = find_installed_route(curr->prefix, curr->plen,
                                        curr->src_prefix, curr->src_plen, 
                                        curr->tos);
        if(previous)
            previous->next = curr->next;
        else
            to_resend = curr->next;
        free(curr->neigh);
        free(curr);
        if(route && route->refmetric >= INFINITY)
            flush_route(route);
        return previous;
    }
    return curr;
}

/* This is called by neigh.c when a neighbour is flushed */
void
flush_resends(struct neighbour *neigh)
{
    struct resend *curr = to_resend, *previous = NULL;
    while(curr) {
        previous = flush_neighbour_resend_1(previous, curr, neigh);
        curr = previous ? previous->next : to_resend;
    }
}

void
no_resend(unsigned short nonce, const struct neighbour *neigh)
{
    struct resend *curr = to_resend, *previous = NULL;
    while(curr && curr->nonce != nonce) {
        previous = curr;
        curr = curr->next;
    }
    if(curr)
        flush_neighbour_resend_1(previous, curr, neigh);
}
