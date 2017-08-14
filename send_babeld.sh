sshiota='ssh iota'
sshzeta='ssh -t iota ssh fe80::e091:f5ff:fecc:7abd%eth0.1'
scp babeld [iota]:
$sshiota scp babeld [fe80::e091:f5ff:fecc:7abd%eth0.1]:
$sshiota scp babeld [fe80::e091:f5ff:fecc:7a93%eth0.4]:
$sshzeta scp babeld [fe80::e091:f5ff:fecc:7a00%eth0.2]:
