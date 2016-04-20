<?php

#http://ethereum.gitbooks.io/frontier-guide/content/rpc.html
$general_commands = array (
                        'eth_accounts' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_accounts",
                                            "params" => "",
                                            "id" => "1"
                                          ),
                        
                        'web3_clientVersion' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "web3_clientVersion",
                                            "params" => "",
                                            "id" => "67"
                                          ),
                        
                        'net_peerCount' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "net_peerCount",
                                            "params" => "",
                                            "id" => "3"
                                          ),
                        
                        'eth_coinbase' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_coinbase",
                                            "params" => "",
                                            "id" => "4"
                                          ),
                        
                        'eth_mining' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_mining",
                                            "params" => "",
                                            "id" => "5"
                                          ),
                        
                        'eth_hashrate' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_hashrate",
                                            "params" => "",
                                            "id" => "6"
                                          ),
                        
                        'eth_gasPrice' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_gasPrice",
                                            "params" => "",
                                            "id" => "7"
                                          ),
                        
                        'eth_blockNumber' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_blockNumber",
                                            "params" => "",
                                            "id" => "8"
                                          ),
                        
                        'eth_getBalance' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_getBalance",
                                            //"params" => '["0x407d73d8a49eeb85d32cf465507dd71d507100c1", "latest"]',
                                            "params" => '', // Modify this dynamically with a function
                                            "id" => "9"
                                          ),
                        
                        'eth_getTransactionCount' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_getTransactionCount",
                                            //"params" => '["0x407d73d8a49eeb85d32cf465507dd71d507100c1", "latest"]',
                                            "params" => '', // Modify this dynamically with a function
                                            "id" => "10"
                                          ),
                        
                        'eth_getCompilers' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_getCompilers",
                                            "params" => '',
                                            "id" => "11"
                                          ),
                        
                        'eth_compileSolidity' => array(
                                            "jsonrpc" => "2.0",
                                            "method" => "eth_compileSolidity",
                                            //"params" => '["contract test { function multiply(uint a) returns(uint d) {   return a * 7;   } }"]',
                                            "params" => '', // Modify this dynamically with a function
                                            "id" => "12"
                                          )
                        
                       );
                       
?>