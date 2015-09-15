<?php


// Output data on webpage
echo "<noscript>";
echo "<p>Addresses: </p>";
foreach ( $eth_accounts as $value ) {
?>
<li><?=$value?> ( <?=eth_balance($value)?> ETH, <?=eth_transactions($value)?> sent transactions )</li>
<?php
}


echo "<p>ETH Coinbase: " . $eth_coinbase . "</p>";

echo "<p>ETH Mining: " . ( $eth_mining == true ? 'Yes (localhost hashrate is ' . $eth_hashrate['MHs'] . ' MHs)' : 'No' ) . "</p>";

echo "<p>Client Version: " . $web3_client . "</p>";

echo "<p>Available Compilers: </p>";
foreach ( $eth_compilers as $value ) {
?>
<li><?=$value?></li> 
<?php
}


echo "<p>Number of Peers: " . $peercount . "</p>";

echo "<p>Current Block Number: " . $eth_blocknumber . "</p>";

echo "<p>Gas Price: " . number_format($gas_price) . " Wei</p>";

echo "<p>Test Code: " . htmlentities($js_test) . "</p>";

if ( trim($eth_compilers[0]) != '' ) {
    
$array_contents = json_encode($js_test_compiled_code, JSON_PRETTY_PRINT);
$array_contents = str_replace('\/', '/', $array_contents);
$array_contents = str_replace('[

                    ]', '[]', $array_contents);

echo "<p>Compiled Code Array: </p><textarea cols='120' rows='25'>" .$array_contents. "</textarea>";

}


echo "</noscript>";

?>