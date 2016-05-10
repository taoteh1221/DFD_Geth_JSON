

<script type="text/javascript">
                            
    
    window.Web3 = require('web3');
    window.web3 = new Web3();
    web3.setProvider(new web3.providers.HttpProvider(proxy_url));
    
    var $_POST = <?php echo json_encode($_POST); ?>;


    window.accounts = web3.eth.accounts;
    //var balance = web3.eth.getBalance("ADDRESS-HERE");
    //var transactions = web3.eth.getTransactionCount("ADDRESS-HERE");
    window.coin_base = web3.eth.coinbase;
    window.client_version = web3.version.node;
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
    window.genesis_block = web3.eth.getBlock(0);
    window.genesis_hash = genesis_block['hash'];
    window.block_number = web3.eth.blockNumber;
    window.block_info = web3.eth.getBlock(block_number);
    window.difficulty = block_info['difficulty'].toString(10);
    window.gas_price = web3.eth.gasPrice.toString(10);
    window.transaction_info = web3.eth.getTransaction(block_info['hash']);

    if ( genesis_hash == '0x0cd786a2425d16f152c658316c423e6ce1181e15c3295826d7c9904cba9ce303' ) {
    window.network_name = 'Testnet';
    window.blockexplorer_host = 'testnet.etherscan.io';
    }
    else if ( genesis_hash == '0xd4e56740f876aef8c010b86a40d5f56745a118d0906a34e69aec8c0db1cb8fa3' ) {
    window.network_name = 'Mainnet';
    window.blockexplorer_host = 'etherscan.io';
    }
    else {
    window.network_name = 'Private Network';
    window.blockexplorer_host = '';
    }
    
</script>