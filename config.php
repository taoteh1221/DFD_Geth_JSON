<?php

error_reporting(-1);


if ( !$_SESSION ) {
session_start();
}

if ( $_GET['nodes'] == 'recheck' ) {
$_SESSION['json_server_array'] = FALSE;
}


header('Content-Type: text/html; charset=utf-8');


$version = '1.0.3';  // 2016/April/19th


// START OF CONFIGURATION
/*
!!!!!!NEVER OPEN THIS LOCATION TO THE OUTSIDE INTERNET, ALWAYS KEEP EXTERNAL PORTS CLOSED OR YOU MAY LOSE FUNDS!!!!!!
Change the protocol/ip address/port to your INTERNAL network address or INTERNAL domain name where Geth JSON is running,
leave the port number at the end alone unless you changed it in Geth.
!!!!!!NEVER OPEN THIS LOCATION TO THE OUTSIDE INTERNET, ALWAYS KEEP EXTERNAL PORTS CLOSED OR YOU MAY LOSE FUNDS!!!!!!
*/
$json_server_array = array(
                     // ADD AS MANY NODES AS YOU WANT
                     //"NAME YOUR NODE HERE" => "http://NODE.IP.ADDRESS.HERE:PORT_NUMBER_HERE",
                     "Gigabyte 1900 Node" => "http://192.168.1.140:8545",
                     "ASUS M5A97 R2.0 Node" => "http://192.168.1.112:8888"
                    );

                    
/*
!!!!!!NEVER OPEN THIS LOCATION TO THE OUTSIDE INTERNET, ALWAYS KEEP EXTERNAL PORTS CLOSED OR YOU MAY LOSE FUNDS!!!!!!
DO NOT INCLUDE HTTP:// OR HTTPS:// AS THIS IS AUTOMATICALLY DETERMINED
Set to your 'internal.network.name.or.internal.ip.address/path/to/proxy/' directory location to that of the 'proxy' subdirectory in this application.
DO NOT INCLUDE HTTP:// OR HTTPS:// AS THIS IS AUTOMATICALLY DETERMINED
!!!!!!NEVER OPEN THIS LOCATION TO THE OUTSIDE INTERNET, ALWAYS KEEP EXTERNAL PORTS CLOSED OR YOU MAY LOSE FUNDS!!!!!!
*/
$proxy_server = 'gigabyte1900.dragonfrugal.network/dfd_geth_json/proxy/';  // ALWAYS include a forward slash at the end of proxy/


// END OF CONFIGURATION
/////////////////////////////////////////////////////////////////////
// DO NOT EDIT BELOW THIS LINE, UNLESS YO KNOW WHAT YOU ARE DOING
/////////////////////////////////////////////////////////////////////

// See if any nodes in config array are unresponsive, and disable for this session if so to prevent application from hanging
if ( !$_SESSION['json_server_array'] || $_GET['nodes'] == 'recheck' ) {
    
$_SESSION['node_alert'] = FALSE;

    foreach ( $json_server_array as $key => $value ) {
    
    
        if ( !ping_server($value, 5) ) {  // 5 second timeout on server ping test
            
        unset($json_server_array[$key]);
        
        $_SESSION['node_alert'] .= '<p>' . $key . ' (' . $value . ') was not responsive. Disabling it in the configuration for <i>this session only</i>, to prevent this application from hanging.</p>';
        
        }
    
    }
    
$_SESSION['json_server_array'] = $json_server_array;

    if ( $_GET['nodes'] == 'recheck' ) {
    header("Location: index.php");
    exit;
    }

}


reset($_SESSION['json_server_array']);
$firstKey = key($_SESSION['json_server_array']);

if ( $_POST['json_server'] ) {
$json_server = $_SESSION['json_server_array'][$_POST['json_server']];
$_SESSION['json_server'] = $_POST['json_server'];
}
elseif ( $_SESSION['json_server'] ) {
$json_server = $_SESSION['json_server_array'][$_SESSION['json_server']];
}
else {
$json_server = $_SESSION['json_server_array'][$firstKey];
}

if ( !$json_server ) {
echo '<b style="color: red;">You have no responsive nodes configured in the config file. Try adding a node that exists and is responding properly.</b>';
$_SESSION['json_server_array'] = FALSE;
exit;
}


if ( $_POST['textarea_widths'] ) {
$textarea_widths = $_POST['textarea_widths'];
$_SESSION['textarea_widths'] = $_POST['textarea_widths'];
}
elseif ( $_SESSION['textarea_widths'] ) {
$textarea_widths = $_SESSION['textarea_widths'];
}
else {
$textarea_widths = '600px';
}

// Needs to be at end of config file, or variables don't load
require("lib/functions.php");
require("lib/commands.php");
require("lib/variables.php");


?>