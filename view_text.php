<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
<meta name="robots" content="noindex,nofollow">
<meta http-equiv="x-dns-prefetch-control" content="off">
<script type="text/javascript" language="JavaScript">
<!--
if (self != top) { try { if (document.domain != top.document.domain) { throw "Clickjacking security violation! Please log out immediately!"; /* this code should never execute - exception should already have been thrown since it's a security violation in this case to even try to access top.document.domain (but it's left here just to be extra safe) */ } } catch (e) { self.location = "/src/signout.php"; top.location = "/src/signout.php" } }
// -->
</script>

<title>SquirrelMail 1.4.22</title><script language="JavaScript" type="text/javascript">
<!--
function checkForm() {
   var f = document.forms.length;
   var i = 0;
   var pos = -1;
   while( pos == -1 && i < f ) {
       var e = document.forms[i].elements.length;
       var j = 0;
       while( pos == -1 && j < e ) {
           if ( document.forms[i].elements[j].type == 'text'            || document.forms[i].elements[j].type == 'password' ) {
               pos = j;
           }
           j++;
       }
   i++;
   }
   if( pos >= 0 ) {
       document.forms[i-1].elements[pos].focus();
   }
   
}
// -->
</script>

<!--[if IE 6]>
<style type="text/css">
/* avoid stupid IE6 bug with frames and scrollbars */
body {
    width: expression(document.documentElement.clientWidth - 30);
}
</style>
<![endif]-->

</head>

<body text="#000000" bgcolor="#ffffff" link="#0000cc" vlink="#0000cc" alink="#0000cc" onload="checkForm();">

<a name="pagetop"></a>
<table bgcolor="#ffffff" border="0" width="100%" cellspacing="0" cellpadding="2">

<tr bgcolor="#ababab">

<td align="left">

&nbsp;      </td>
<td align="right">
<b>
<a href="/src/signout.php" target="_top">Fermer la session</a></b></td>
   </tr>
<tr bgcolor="#ffffff">

<td align="left">

<a href="/src/compose.php?mailbox=None&amp;startMessage=0">Composer</a>&nbsp;&nbsp;
<a href="/src/addressbook.php">Adresses</a>&nbsp;&nbsp;
<a href="/src/folders.php">Dossiers</a>&nbsp;&nbsp;
<a href="/src/options.php">Options</a>&nbsp;&nbsp;
<a href="/src/search.php?mailbox=None">Rechercher</a>&nbsp;&nbsp;
<a href="/src/help.php">Aide</a>&nbsp;&nbsp;
      </td>
<td align="right">

<a href="http://squirrelmail.org/" target="_blank">SquirrelMail</a></td>
   </tr>
</table><br>

<br /><table width="100%" border="0" cellspacing="0" cellpadding="2" align="center"><tr><td bgcolor="#dcdcdc">
<b><center>
Voir un fichier texte joint - <a href="read_body.php?mailbox=Mail%2FINBOX.Sent&amp;passed_id=1472&amp;startMessage=1&amp;ent_id=0">Voir le message</a></b></td><tr><tr><td><center>
<a href="../src/download.php?mailbox=Mail%2FINBOX.Sent&amp;passed_id=1472&amp;startMessage=1&amp;ent_id=2&amp;absolute_dl=true">Télécharger en tant que fichier</a></center><br />
</center></b>
</td></tr></table>
<table width="98%" border="0" cellspacing="0" cellpadding="2" align="center"><tr><td bgcolor="#dcdcdc">
<tr><td bgcolor="#ffffff"><tt>
<pre>&lt;?xml version=&quot;1.0&quot; encoding=&quot;US-ASCII&quot;?&gt;
&lt;!DOCTYPE rfc SYSTEM &quot;rfc2629.dtd&quot; []&gt;
&lt;?xml-stylesheet type='text/xsl' href='rfc2629.xslt' ?&gt;
&lt;?rfc toc=&quot;yes&quot;?&gt;
&lt;?rfc tocdepth=&quot;2&quot;?&gt;
&lt;?rfc symrefs=&quot;yes&quot;?&gt;
&lt;?rfc sortrefs=&quot;yes&quot; ?&gt;
&lt;?rfc compact=&quot;yes&quot; ?&gt;
&lt;rfc category=&quot;exp&quot; docName=&quot;rfc-tos-specific&quot;
ipr=&quot;trust200902&quot; updates=&quot;6126&quot;&gt;
&lt;front&gt;
&lt;title&gt;TOS-Specific Routing in Babel&lt;/title&gt;
&lt;author fullname=&quot;Gwendoline Chouasne&quot; initials=&quot;G.&quot; surname=&quot;Chouasne&quot;&gt;
&lt;organization&gt;PPS, University of Paris-Diderot&lt;/organization&gt;
&lt;address&gt;
&lt;postal&gt;
&lt;street&gt;Case 7014&lt;/street&gt;
&lt;city&gt;75205 Paris Cedex 13&lt;/city&gt;
&lt;region&gt;&lt;/region&gt;
&lt;code&gt;&lt;/code&gt;
&lt;country&gt;France&lt;/country&gt;
&lt;/postal&gt;
&lt;email&gt;<a href="/src/compose.php?send_to=gwendoline.chouasne-guillon%40ens.fr">gwendoline.chouasne-guillon@ens.fr</a>&lt;/email&gt;
&lt;/address&gt;
&lt;/author&gt;
&lt;author fullname=&quot;Juliusz Chroboczek&quot; initials=&quot;J.&quot; surname=&quot;Chroboczek&quot;&gt;
&lt;organization&gt;PPS, University of Paris-Diderot&lt;/organization&gt;
&lt;address&gt;
&lt;postal&gt;
&lt;street&gt;Case 7014&lt;/street&gt;
&lt;city&gt;75205 Paris Cedex 13&lt;/city&gt;
&lt;region&gt;&lt;/region&gt;
&lt;code&gt;&lt;/code&gt;
&lt;country&gt;France&lt;/country&gt;
&lt;/postal&gt;
&lt;email&gt;<a href="/src/compose.php?send_to=jch%40pps.univ-paris-diderot.fr">jch@pps.univ-paris-diderot.fr</a>&lt;/email&gt;
&lt;/address&gt;
&lt;/author&gt;

&lt;date day=&quot;10&quot; month=&quot;May&quot; year=&quot;2017&quot;/&gt;

&lt;abstract&gt;
&lt;t&gt;This document describes an extension to the Babel routing protocol to
support TOS-specific routing. This version is using mandatory sub-TLVs.&lt;/t&gt;


&lt;/abstract&gt;

&lt;/front&gt;

&lt;middle&gt;

&lt;section title=&quot;Introduction and background&quot;&gt;

&lt;t&gt;The Type of Service (ToS) is a field of the IPV4 header. It is used to indicate
the type of routing a packet needs (for example, low-delay or high throughput).&lt;/t&gt;
&lt;t&gt;ToS-specific routing has been implemented for various protocols, as described in
&lt;xref target=&quot;TOS-ROUTING&quot;/&gt;&lt;/t&gt;
&lt;t&gt;This document defines an extension to the Babel protocol that allows routers
to discover routes corresponding to a certain ToS. It enables packets to be routed
according to their ToS field.&lt;/t&gt;

&lt;t&gt;This extension defines an extension to the base Babel protocol defined in 
&lt;xref target=&quot;BABEL&quot;/&gt;. It is compatible and interoperable with it.&lt;/t&gt;


&lt;/section&gt;

&lt;section title=&quot;ToS version&quot;&gt;

&lt;t&gt;Several interpretations have been defined for the ToS field. This extension 
uses the Differentiated Service Field interpretation, defined in RFC 2474.&lt;/t&gt;

&lt;t&gt;This interpretation is compatible with the previous interpretation described
in RFC 791, called IP Precedence, and the ECN protocol, described in RFC 3168.
This extension preserves both compatibilities.&lt;/t&gt;

&lt;/section&gt;

&lt;section title=&quot;Data Structures&quot;&gt;

&lt;t&gt;This extension needs Babel to save additional data in the structures it
maintains.&lt;/t&gt;

&lt;section title=&quot;The Source Table&quot;&gt;

&lt;t&gt;The source table maintained by any Babel node, as described in &lt;xref
target=&quot;BABEL&quot;/&gt;,
Section 3.2.4, needs to be extended with the following field:
&lt;list style=&quot;symbols&quot;&gt;
&lt;t&gt;the ToS specifying the ToS of packets to which this entry applies.&lt;/t&gt;
&lt;/list&gt;
If it is a non-ToS-specific entry, then the ToS is set to 0.&lt;/t&gt;

&lt;/section&gt;

&lt;section title=&quot;The Table of Pending Requests&quot;&gt;

&lt;t&gt;The table of pending requests, maintained by any Babel node, as described in 
&lt;xref target=&quot;BABEL&quot;/&gt;, Section 3.2.4, needs to be extended with the following field:
&lt;list style=&quot;symbols&quot;&gt;
&lt;t&gt;the ToS being requested.&lt;/t&gt;
&lt;/list&gt;
If it is a non-ToS-specific entry, then the ToS is set to 0.&lt;/t&gt;

&lt;/section&gt;

&lt;/section&gt;

&lt;section title=&quot;ToS-specific sub-TLV&quot; anchor=&quot;encoding&quot;&gt;

&lt;t&gt;This extension defines a new sub-TLV to add a ToS field to a Babel packet.&lt;/t&gt;

&lt;section title=&quot;Usage&quot;&gt;

&lt;t&gt;This extension defines a new sub-TLV for turning regular Updates, Route Requests
and Seqno Requests into ToS-specific Updates, Route Requests and Seqno Requests.
Other TLVs MUST NOT use this sub-TLV.&lt;/t&gt;

&lt;t&gt;The new sub-TLV MUST be used by ToS-specific Update, Route Request and Seqno 
Request, if the ToS is different from 0. It MUST NOT be used by non-ToS-specific 
Update, Route Request and Seqno Request. &lt;/t&gt;

&lt;t&gt;A node MUST send ToS-specific Update, Route Request and Seqno Request if the ToS 
is different from 0.  Otherwise, a node MUST send non-ToS-specific Update, Route
Request and Seqno Request.&lt;/t&gt;

&lt;t&gt;When a non-ToS-specific Babel node receives an Update, Route Request or Seqno 
Request with a ToS-specific sub-TLV, it will ignore it, according to the base 
protocol defined in &lt;xref target=&quot;BABEL&quot;/&gt;.&lt;/t&gt;

&lt;t&gt;When a ToS-specific Babel node receives a non-ToS-specific Update, Route Request 
or Seqno Request, it MUST consider this update as a ToS-specific Update, Route 
Request or Seqno Request with ToS 0.&lt;/t&gt;

&lt;/section&gt;

&lt;section title=&quot;Encoding&quot;&gt;
&lt;t&gt;The sub-TLV must set the mandatory bit to 1. It is defined as follow:&lt;/t&gt;

&lt;figure&gt;&lt;artwork&gt;&lt;![CDATA[
 0                   1                   2                   3
 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
|  Type  = TBD   |      Length       |        ToS        |
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
]]&gt;&lt;/artwork&gt;&lt;/figure&gt;

&lt;t&gt;Fields :&lt;/t&gt;
&lt;t&gt;
&lt;list style=&quot;hanging&quot; hangIndent=&quot;10&quot;&gt;
&lt;t hangText=&quot;Type&quot;&gt;Set to TBD to indicate a ToS-specific mandatory sub-TLV..&lt;/t&gt;
&lt;t hangText=&quot;Length&quot;&gt;The length of the body, exclusive of the Type and Length
             fields. It MUST be set to 1.&lt;/t&gt;
&lt;t hangText=&quot;ToS&quot;&gt;The ToS value&lt;/t&gt;
&lt;/list&gt;
&lt;/t&gt;

&lt;/section&gt;

&lt;/section&gt;

&lt;section title=&quot;Protocol Operation&quot;&gt;

&lt;t&gt;This section describes the changes in the protocol operation required by this
extension.&lt;/t&gt;

&lt;section title=&quot;Updates&quot;&gt;

&lt;t&gt;Whenever an Update or a ToS-specific Update is sent by a node 
implementing this extension, the source table MUST be updated . In both 
cases, if an entry indexed by (prefix, plen, router-id, ToS), with 
ToS 0 if the update is non-ToS-specific, exists, it MUST be modified as
described in section 3.7.3 of &lt;xref target=&quot;BABEL&quot;/&gt;. Otherwise, a new 
entry is created with value (prefix, plen, router-id, ToS, seqno, metric), 
ToS also being 0 if the update is non-ToS-specific.&lt;/t&gt;

&lt;/section&gt;


&lt;section title=&quot;Requests&quot;&gt;

&lt;t&gt;Whenever a node implementing this extension receives a Request or a ToS-specific
Request,
it MUST add its content to the Pending Requests Table, as described in section
3.2.6 of &lt;xref target=&quot;BABEL&quot;/&gt; [TODO chercher la bonne section]. In the case of a 
non-ToS-specific Request, the ToS used in the entry MUST be 0.&lt;/t&gt;

&lt;section title=&quot;Route Requests&quot;&gt;

&lt;t&gt; When a node receives a Route Request for a prefix (prefix, plen) with
a ToS-specific sub-TLV with ToS t, it checks its route table for a selected 
route with this prefix, plen, and with ToS t in the corresponding source. If such a
route
doesn't exist, it MUST send a ToS-specific retraction for that prefix, 
with a ToS-specific sub-TLV for ToS t.&lt;/t&gt;

&lt;/section&gt;

&lt;section title=&quot;Seqno Requests&quot;&gt;

&lt;t&gt;When a node receives a Seqno Request for a prefix (prefix, plen) with
a ToS-specific sub-TLV with ToS t, it MUST send a ToS-specific update
with ToS t for a selected route specified by the Plen, Prefix and Source
ToS field, with either a router-id different from what
is specified by the Router-Id field, or a Seqno no less than what is
specified by the Seqno field. It there is no such route in the Route Table,
it MUST forward the seqno request according to the rules defined in Section
3.8.1.2 of &lt;xref target=&quot;BABEL&quot;/&gt;. &lt;/t&gt;

&lt;/section&gt;

&lt;/section&gt;

&lt;/section&gt;

&lt;section title=&quot;Data Forwarding&quot;&gt;

&lt;t&gt;When a packet for an address A arrives to a node, it may match two routes: one 
with the most prefix including A but no ToS, and one with a 
less precise prefix, and the ToS required by the packet.&lt;/t&gt;

&lt;t&gt;It is necessary that all routers use the same priority rules between 
destination and ToS to avoid creating routing loops.&lt;/t&gt;

&lt;t&gt;A Babel implementation with this extension MUST choose the route with the 
destination-first ordering. This ordering first considers the routes with
the most specific prefixes, and then chooses among them the one with the
ToS of the packet. If it doesn't exist, then it gradually considers the
routes with the less specific prefixes, until it finds one with the required
ToS. &lt;/t&gt;

&lt;t&gt;This means that a Babel implementation of this extension must ensure that
lower layers observe these semantics. If they don't, 
the implementation MUST disambiguate the routing tables by using a suitable
algorithm (for example the algorithm of M. Boutier &lt;xref target=&quot;SS-ROUTING&quot;/&gt;)&lt;/t&gt;

&lt;/section&gt;


&lt;section title=&quot;Compatibility&quot;&gt;

&lt;t&gt;The protocol extension defined in this document is interoperable with
the base protocol defined in &lt;xref target=&quot;BABEL&quot;/&gt;.&lt;/t&gt;

&lt;section title=&quot;Interaction with non-Tos-specific Babel&quot;&gt;

&lt;t&gt;In a topology of routers implementing ToS-specific Babel 
and non-ToS-specific Babel, all packets will reach their destination
if it is reachable. Non-ToS-specific packets will follow the same routes 
as if ToS-specific routers were non-ToS-specific routers. ToS-specific packets may
switch to a non-ToS-specific route if and only if there is no route for
the required ToS. &lt;/t&gt;

&lt;/section&gt;

&lt;section title=&quot;Interaction with other known extensions&quot;&gt;

&lt;t&gt;[TODO : a ecrire, mais a definir avant]&lt;/t&gt;

&lt;/section&gt;

&lt;section title=&quot;Remark on the mandatory bit&quot;&gt;

&lt;t&gt;This extension uses a mandatory bit on each sub-TLV. It is necessary 
that this bit is set to 1 for all ToS-specific sub-TLV to avoid loops,
as shown in the following example.&lt;/t&gt;

&lt;t&gt;Consider two neighboring routers A and B, A implementing the 
ToS-specific Babel extension, and B implementing just the base Babel 
protocol. Suppose that A has a ToS-specific route for a prefix P and ToS t.&lt;/t&gt;
&lt;t&gt;B will receive an update from A with this ToS-specific route. Suppose that
B reads the update TLV but drops the ToS-specific sub-TLV. It will now
forwards packets for P through A.&lt;/t&gt;
&lt;t&gt;B will then send an update to A, who will treat it as an update for (P, 0), 
and take B as next-hop for the matching packets.&lt;/t&gt;
&lt;t&gt;When a packet with ToS t arrives to A or B, it will travel between A and B 
indefinitely, as shown in the figure below.&lt;/t&gt;

&lt;figure&gt;&lt;artwork&gt;&lt;![CDATA[
            (P, 0)          (P)
             --&gt;            &lt;--
----------- A ----------------- B -----------
        &lt;--
      (P, t)
]]&gt;&lt;/artwork&gt;&lt;/figure&gt;


&lt;/section&gt;

&lt;/section&gt;

&lt;section title=&quot;IANA Considerations&quot;&gt;

&lt;t&gt;IANA is instructed to add the following entry to the &quot;Babel sub-TLV type&quot;
registry:&lt;/t&gt;

&lt;texttable&gt;
&lt;ttcol&gt;Type&lt;/ttcol&gt;&lt;ttcol&gt;Name&lt;/ttcol&gt;&lt;ttcol&gt;Reference&lt;/ttcol&gt;
&lt;c&gt;TBD&lt;/c&gt;&lt;c&gt;ToS-specific TLV&lt;/c&gt;&lt;c&gt;(this document)&lt;/c&gt;
&lt;/texttable&gt;

&lt;/section&gt;

&lt;section title=&quot;Security considerations&quot;&gt;

&lt;t&gt;The extension defined in this protocol defines three new sub-TLVs for
defined TLVs. This extension doesn't alterate any of the security properties
of the base protocol.&lt;/t&gt;

&lt;/section&gt;

&lt;section title=&quot;todos&quot;&gt;

&lt;t&gt;Compression&lt;/t&gt;
&lt;t&gt;Wildcard requests&lt;/t&gt;

&lt;/section&gt;

&lt;/middle&gt;

&lt;back&gt;

&lt;references title=&quot;Normative References&quot;&gt;

&lt;reference anchor=&quot;BABEL&quot;&gt;&lt;front&gt;
&lt;title&gt;The Babel Routing Protocol&lt;/title&gt;
&lt;author fullname=&quot;Juliusz Chroboczek&quot; initials=&quot;J.&quot; surname=&quot;Chroboczek&quot;/&gt;
&lt;date month=&quot;February&quot; year=&quot;2011&quot;/&gt;
&lt;/front&gt;
&lt;seriesInfo name=&quot;RFC&quot; value=&quot;6126&quot;/&gt;
&lt;/reference&gt;

&lt;reference anchor=&quot;BABEL-EXT&quot;&gt;&lt;front&gt;
&lt;title&gt;Extension Mechanism for the Babel Routing Protocol&lt;/title&gt;
&lt;author fullname=&quot;Juliusz Chroboczek&quot; initials=&quot;J.&quot; surname=&quot;Chroboczek&quot;/&gt;
&lt;date day=&quot;28&quot; month=&quot;May&quot; year=&quot;2015&quot;/&gt;
&lt;/front&gt;
&lt;seriesInfo name=&quot;RFC&quot; value=&quot;7557&quot;/&gt;
&lt;/reference&gt;

&lt;/references&gt;

&lt;references title=&quot;Informative References&quot;&gt;

&lt;reference anchor=&quot;SS-ROUTING&quot;&gt;
&lt;front&gt;
&lt;title&gt;Source-Specific Routing&lt;/title&gt;
&lt;author initials=&quot;M.&quot; surname=&quot;Boutier&quot; fullname=&quot;Matthieu Boutier&quot;/&gt;
&lt;author initials=&quot;J.&quot; surname=&quot;Chroboczek&quot; fullname=&quot;Juliusz Chroboczek&quot;/&gt;
&lt;date year=&quot;2014&quot; month=&quot;August&quot;/&gt;
&lt;/front&gt;
&lt;annotation&gt;In Proc. IFIP Networking 2015.  A slightly earlier version
is available online from <a href="http://arxiv.org/pdf/1403.0445" target="_blank">http://arxiv.org/pdf/1403.0445</a>.&lt;/annotation&gt;
&lt;/reference&gt;

&lt;reference anchor=&quot;TOS-ROUTING&quot;&gt;
&lt;front&gt;
&lt;title&gt;ToS-Specific Routing&lt;/title&gt;
&lt;author initials=&quot;M.&quot; surname=&quot;Boutier&quot; fullname=&quot;Matthieu Boutier&quot;/&gt;
&lt;author initials=&quot;J.&quot; surname=&quot;Chroboczek&quot; fullname=&quot;Juliusz Chroboczek&quot;/&gt;
&lt;date year=&quot;2014&quot; month=&quot;August&quot;/&gt;
&lt;/front&gt;
&lt;annotation&gt;[TODO mettre un bo article qui parle de ToS]&lt;/annotation&gt;
&lt;/reference&gt;

&lt;/references&gt;

&lt;/back&gt;

&lt;/rfc&gt;
</pre></tt></td></tr></table>
</body></html>
