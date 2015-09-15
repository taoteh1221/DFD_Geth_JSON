

INSTALLING GETH:

https://github.com/ethereum/go-ethereum/wiki/Installation-Instructions-for-Ubuntu

INSTALLING A FULL WEB SERVER STACK VIA VIRTUALMIN GPL:

http://www.webmin.com/vinstall.html

After installing geth / web server stack on your machine, add this to your /etc/rc.local file above the exit code, and make sure /etc/rc.local is executable, then reboot (OR skip this step, use the alernate method described in UNLOCK-WALLET-WITH-CAUTION.txt):

su PUT_YOUR_USERNAME_HERE -c '/usr/bin/geth --rpc --rpcapi "db,eth,net,web3" --rpcaddr "PUT_YOUR_IP_ADDRESS_HERE" --rpcport "8545"'

OR just run this in a terminal:

geth --rpc --rpcapi "db,eth,net,web3" --rpcaddr "PUT_YOUR_IP_ADDRESS_HERE" --rpcport "8545" console

Notice I added 'console' to the end of this command line...this allows you to run commands in geth.

VERY IMPORTANT NOTE: The command --rpcaddr "PUT_YOUR_IP_ADDRESS_HERE" allows remote operations such as mining remotely with ethminer on another machine to this instance of geth, AS WELL AS ENABLING REMOTE ABILITY TO TRANSFER BALANCES IF YOUR ACCOUNT IS UNLOCKED. USE THIS PARAMETER WITH EXTREME CAUTION! TO SKIP ENABLING REMOTE CONNECTION CAPABILITY DO NOT INCLUDE THIS COMMAND PARAMETER. ADDITIONALLY IT IS HIGHLY RECOMMENDED TO ONLY USE YOUR --INTERNAL NETWORK-- IP ADDRESSES AND ---NOT--- EVER HAVE YOUR RPC PORT EXPOSED TO THE INTERNET BY OPENING THE ROUTER PORT TO HAVE ACCESS TO IT. 

MORE SECURITY ALERT INFORMATION CAN BE FOUND HERE:
https://blog.ethereum.org/2015/08/29/security-alert-insecurely-configured-geth-can-make-funds-remotely-accessible/

The above setup will allow remote mining and commands to JSON-RPC port 8545 across your network, and run the node as a normal system user for better system security (NOT run as root or any other system user). Make sure you open any installed firewall to port 30303 and 8545 on the LOCAL machine running this instance of geth (AND ONLY OPEN PORT 30303 TO THE INTERNET ON YOUR ROUTER, ---DO NOT--- OPEN PORT 8545 TO THE INTERNET AS IT IS A ---BIG--- SECURITY RISK), and let geth sync up with the blockchain for awhile. You will need to set your network ip address and RPC proxy address in the config.php file.

Many of the features in this script require you to unlock your wallet. DO THIS WITH EXTREME CAUTION. I recommend only unlocking an account with a very small balance, and immeadiately transferring and mined coins to another locked or cold wallet address. See UNLOCK-WALLET-WITH-CAUTION.txt for details on unlocking your wallet per session OR at system startup.

This PHP script that connects to Geth is a VERY EARLY Beta release version, mostly just proof-of-concept to see what's possible. USE WITH CAUTION!