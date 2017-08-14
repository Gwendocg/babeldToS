sshiota='ssh iota'
sshzeta='ssh -t iota ssh fe80::e091:f5ff:fecc:7abd%eth0.1'
sshrho='ssh -t iota ssh fe80::e091:f5ff:fecc:7a93%eth0.4'
ssheta='ssh -t iota ssh -t fe80::e091:f5ff:fecc:7abd%eth0.1 ssh fe80::e091:f5ff:fecc:7a00%eth0.2'

$sshiota killall babeld
$sshzeta killall babeld
$sshrho killall babeld
$ssheta killall babeld
