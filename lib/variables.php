<?php

// Data
$web3_client = json_post_data('web3_clientVersion');
$eth_coinbase = json_post_data('eth_coinbase');
$eth_mining = json_post_data('eth_mining');
$eth_compilers = json_post_data('eth_getCompilers');
$js_test = file_get_contents('example.sol');

// Convert a few values from hexadecimal 
$peercount = hexdec(json_post_data('net_peerCount'));
$gas_price = hexdec(json_post_data('eth_gasPrice'));
$eth_blocknumber = number_format(hexdec(json_post_data('eth_blockNumber')));
$eth_hashrate = array(
                      'Hs' => hexdec(json_post_data('eth_hashrate')),
                      'KHs' => ( hexdec(json_post_data('eth_hashrate')) / 100000000000000 ),
                      'MHs' => ( hexdec(json_post_data('eth_hashrate')) / 100000000000000000 )
                    );


// Array data
$eth_accounts = json_post_data('eth_accounts');

if ( trim($eth_compilers[0]) != '' ) {
$js_test_compiled_code = compile_solidity($js_test);
}

?>