

<script type="text/javascript">
                            
    window.web3 = require('web3');
    web3.setProvider(new web3.providers.HttpProvider());
    
    var $_POST = <?php echo json_encode($_POST); ?>;


    window.accounts = web3.eth.accounts;
    //var balance = web3.eth.getBalance("ADDRESS-HERE");
    //var transactions = web3.eth.getTransactionCount("ADDRESS-HERE");
    window.coin_base = web3.eth.coinbase;
    window.client_version = web3.version.client;
    window.compilers = web3.eth.getCompilers();
    
    
    // Vars updated frequently
    window.eth_mining = web3.eth.mining;
    window.eth_hash_rate = web3.eth.hashrate;
    
    
    window.eth_hash_rate_convert = {
                                Hs: eth_hash_rate,
                                KHs: (eth_hash_rate / 200000000000000),
                                MHs: (eth_hash_rate / 200000000000000000)
                                };
                                
                                
    
    window.peer_count = web3.net.peerCount;
    window.block_number = web3.eth.blockNumber;
    window.block_info = web3.eth.getBlock(block_number);
    window.difficulty = block_info['difficulty'].toString(10);
    window.gas_price = web3.eth.gasPrice.toString(10);
    window.transaction_info = web3.eth.getTransaction(block_info['hash']);

</script>