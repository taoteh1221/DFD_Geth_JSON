<?php

require("config.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>DFD Geth JSON</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=<?php echo ( str_replace("px", '', $textarea_widths) + 75 ) ?>, initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.min.css">
    
<script type='text/javascript'>
// Keep above all other script
var proxy_url = "//<?=$proxy_server?>";
</script>

<script type="text/javascript" src="js/editarea_0_8_2/edit_area/edit_area_full.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bignumber.js/bignumber.min.js"></script>
<script type="text/javascript" src="js/web3/dist/web3-light.js"></script>

<script type="text/javascript" src="js/base_functions.js"></script>

<?php include("js/base_variables.js.php"); ?>

<script type='text/javascript'>

$( document ).ready(function() {
    
    setTimeout( reset_focus, 1500 );  // Workaround for editarea focus bug
    
});

</script>
    
<style type='text/css'>

body {
 margin: 30px;
}

textarea {
resize: none;
}

a {
text-decoration: underline;
}

div#container {
width: <?php echo ( str_replace("px", '', $textarea_widths) + 15 ) ?>px;
}

.send_eth {
margin: 4px;
}

.black {
color: black;
}

</style>
    
</head>
<body>
<div id='container' style=''>
    
<input type='button' id='focus' value='Reset Contract Defaults' style='position: relative; top: 0px; left: 0px; margin-bottom: 30px;' onclick='window.location.href= "./";' /> <!-- Workaround for editarea focus bug (focus here instead, 1.5 seconds after page load), as well as resetting page data to defaults when clicked -->


<p><b style='color: red;'>ALERT: Only recommended for usage on CLOSED INTERNAL NETWORKS, <i>with NO ports routed to the internet other than port 30303 for geth peers!</i> <a href='IMPORTANT_SECURITY_ALERT.txt' target='_blank'>More Info Here</a></b></p>

<p><b style='color: red;'><a href='password-protect.php' target='_blank'>Activate / Update Password Protection</a></b></p>

<div style='height: 15px;'></div>


<?php

if ( $_POST['sol_file'] == 'sol/user-customized.sol' && trim($_POST['source_code']) != '' ) {
    
$sol_file_result = file_put_contents("sol/user-customized.sol", $_POST['source_code']);


    if ( $sol_file_result ) {
    $sol_file_result_alert = ' <span style="font-weight: bold; color: red;">Custom sol file "sol/user-customized.sol" updated.</span>';
    }
    else {
    $sol_file_result_alert = ' <span style="font-weight: bold; color: red;">Error updating "sol/user-customized.sol". Check your sol directory / user-customized.sol file permissions.</span>';
    }


}


//echo 'var dump: '; var_dump($_SESSION['json_server_array']);

if ( $_SESSION['node_alert'] ) {
?>
<div id='node_alert' style='padding: 7px; border: 2px dotted red; font-weight: bold; color: red; margin-bottom: 20px;'><?=$_SESSION['node_alert']?><p><a href='?nodes=recheck'>Re-Check Nodes</a></p></div>
<?php
}
?>

<form name='server_select' action='' method='post'><p><b>Proxy Target (node RPC ip/port):</b> 
<select name='json_server' onchange='document.server_select.submit();' style='font-weight: bold;'>
<?php
foreach ( $_SESSION['json_server_array'] as $server_name => $server_address ) {
?>
<option value='<?=$server_name?>' <?=( $server_address == $json_server ? 'selected' : '' )?>> <?=$server_name?> (<?=$server_address?>) </option>
<?php
}
?>
</select> <a href='?nodes=recheck'>Re-Check Nodes</a></p></form>

<script type='text/javascript'>

document.write("<p><b>DFD Geth JSON Proxy URL (avoids modern strict Javascript Xsite port restrictions):</b> <br />"+window.location.protocol+proxy_url+"</p>");

</script>


<div style='height: 9px;'></div>
<div id='node_stats'></div>
<div id='status' style='font-weight: bold; color: red;'></div>
<div style='height: 9px;'></div>


<script type='text/javascript'>

// Output node data...
node_stats();
// Reload every 10 seconds
setInterval(function() {
node_stats();
}, 10 * 1000); // 10 * 1000 milsec is 10 seconds

    
    document.write("<p><div align='left' style='width: 600px'><form name='send_form' action='' method='post'><b>Send: <input class='send_eth' type='text' name='eth_send' value='' style='width: 445px;' /> <select name='eth_unit'><option value='ether'> Ether </option><option value='finney'> Finney </option><option value='szabo'> Szabo </option></select> <br />To Receiving Address:</b> <input class='send_eth' type='text' style='width: 400px;' name='eth_to_address' value='' style='width: 350px;' /> <br /><b>From:</b> <select name='eth_from_address'>");
    
    
        for(var account in window.accounts) {
    window.node_html = window.node_html + "<li><a href='http://"+blockexplorer_host+"/address/" + accounts[account] + "' target='_blank'>" + accounts[account] + "</a> (account " + account + "): "+ web3.eth.getBalance(accounts[account]) / 1000000000000000000 +" ETH, "+web3.eth.getTransactionCount(accounts[account])+" sent transactions</li>";
    
        document.write("<option value='" + account + "'> Local Account " + account + " </option>");
    
        }
    
    document.write("</select> <input type='button' value='Send Transaction' onclick='var ok_proceed = confirm(document.send_form.eth_send.value + \" \" +document.send_form.eth_unit.value+ \" will be sent to Address \" +document.send_form.eth_to_address.value+ \" from local account \" +document.send_form.eth_from_address.value+ \", Proceed?\"); if ( ok_proceed == true ) { send_eth(document.send_form.eth_from_address.value, document.send_form.eth_to_address.value, document.send_form.eth_send.value, document.send_form.eth_unit.value); document.send_form.eth_to_address.value = \"\"; document.send_form.eth_send.value = \"\"; return false; } else {}' /></form></div></p>");

</script>

<div style='height: 20px;'></div>

<?=( $is_curl == 1 ? '' : '<p style="font-weight: bold; color: red;">You have no PHP curl module loaded.</p>' )?>

<p>
    
<form name='select_sol' action='' method='post'><b><a href=''>Reload / Reset Default Contract Data Example</a>, Or Choose From Other Examples: </b>

<select name='sol_file' onchange='document.select_sol.submit();' style='font-weight: bold;'>
<?php
$files = glob('sol/*.{sol}', GLOB_BRACE);
foreach($files as $file) {
?>
<option value='<?=$file?>' <?=( $_POST['sol_file'] == $file ? 'selected' : ( !$_POST['sol_file']  && $file == 'sol/greeter-default.sol' ? 'selected' : '' ) )?>> <?=$file?> </option>
<?php
}
?>
</select> <?=$sol_file_result_alert?>
    
    </form>

</p>

    <form name='settings_textarea' action='' method='post' style='display: none;'>
    <input type='hidden' name='sol_file' value='<?=$_POST['sol_file']?>' />
    <input type='hidden' name='textarea_widths' value='' />
    </form>

<form name='solidity_code' action='' method='post'>
<input type='hidden' name='sol_file' value='' />
    
<p><b>Javascript Run Before Contract Creation (must use variable names "var_1" through "var_16" to pass variables from jasvascript to contract source code before compilation, including any web3.* vars):</b> </p>
<textarea rows='15' style='width: <?=$textarea_widths?>;' name='js_code' id='js_code'><?=trim($_POST['js_code'])?></textarea>

<p style='color: red;'><b>Clicking the save button in the contract editing area will run your Javascript on the contract source code.</b></p>

<div style='height: 20px;'></div>

<?php include("js/contract_variables.js.php"); ?>

<p><b>Solidity Contract Source Code: <!-- No longer used, but keep for backup right now <input type='button' value='Re-Compile Contract Code Below Now' onclick=' document.solidity_code.sol_file.value = \"sol/user-customized.sol\"; document.solidity_code.submit();' /> --> <span style='color: red;'>(if you edit this contract, click the save button to recompile your new code...you also must save before downloading a backup file)</span></b></p>

<p>
    
        <b>Text Area Widths: </b> 
        <select name='' onchange='document.settings_textarea.textarea_widths.value = this.value; document.settings_textarea.submit();' style='font-weight: bold;'>
        <option value='600px' <?=( $textarea_widths == '600px' ? 'selected' : '' )?>> 600px </option>
        <option value='700px' <?=( $textarea_widths == '700px' ? 'selected' : '' )?>> 700px </option>
        <option value='800px' <?=( $textarea_widths == '800px' ? 'selected' : '' )?>> 800px </option>
        <option value='900px' <?=( $textarea_widths == '900px' ? 'selected' : '' )?>> 900px </option>
        <option value='1000px' <?=( $textarea_widths == '1000px' ? 'selected' : '' )?>> 1000px </option>
        <option value='1100px' <?=( $textarea_widths == '1100px' ? 'selected' : '' )?>> 1100px </option>
        <option value='1200px' <?=( $textarea_widths == '1200px' ? 'selected' : '' )?>> 1200px </option>
        <option value='1300px' <?=( $textarea_widths == '1300px' ? 'selected' : '' )?>> 1300px </option>
        <option value='1400px' <?=( $textarea_widths == '1400px' ? 'selected' : '' )?>> 1400px </option>
        <option value='1500px' <?=( $textarea_widths == '1500px' ? 'selected' : '' )?>> 1500px </option>
        <option value='1600px' <?=( $textarea_widths == '1600px' ? 'selected' : '' )?>> 1600px </option>
        </select>

<script type='text/javascript'>
    
    document.write(' &nbsp;&nbsp;<input class="black" type="button" value="Make A Backup File of This Contract Source Code To My Computer" onclick="saveTextAsFile(document.getElementById(\'source_code\'),\'user-customized.sol\');" /></p>');
    
    document.write("<textarea id='source_code' name='source_code' rows='45' style='width: <?=$textarea_widths?>;'>" +
                   contract_source_code + "</textarea><input type='hidden' name='create_now' value='0' />");

</script>

</form>

<div style='height: 20px;'></div>

<script type='text/javascript'>


// Only display if compilers exist
if ( window.compilers.length > 0  ) {

    
    if ( solidity_compiled ) {
        
    /*
    document.write("<p><b>Compiled Code Array ("+
solidity_compiled[get_key(solidity_compiled)]['info']['language'] + ' version ' + solidity_compiled[get_key(solidity_compiled)]['info']['compilerVersion']+
"):</b> </p>");
    document.write("<textarea cols='120' rows='30' style='width: <?=$textarea_widths?>;'>" + JSON.stringify(solidity_compiled, null, 4) + "</textarea>");

    document.write("<div style='height: 20px;'></div>");
    */
    
    document.write("<p><b>Compiled Bytecode ("+
solidity_compiled[get_key(solidity_compiled)]['info']['language'] + ' version ' + solidity_compiled[get_key(solidity_compiled)]['info']['compilerVersion']+
"):</b> </p>");
    document.write("<textarea cols='120' rows='30' style='width: <?=$textarea_widths?>;'>" + compiled_array_bytecode + "</textarea>");

    document.write("<div style='height: 20px;'></div>");
    
    document.write("<p><b>Compiled Code ABI:</b> </p>");
    document.write("<textarea cols='120' rows='30' style='width: <?=$textarea_widths?>;'>" + JSON.stringify(compiled_array_abi, null, 4) + "</textarea>");
    
    document.write("<p><b>Gas Estimate For Creating The Above Contract:</b> "+number_format(gas_estimate)+" gas</p>");
    
    document.write("<p><input type='button' value='Looks Good, Create The Above Contract Now' onclick='var ok_proceed = confirm(\"IMPORTANT NOTES:  \\n \\n1. Make sure you saved any changes you made to your source code before you deploy this contract.  \\n \\n2. If you have no contract kill function in this contract, you will not be able to delete it ever.  \\n \\n3.Contracts that are left unused and are not deleted do bloat the blockchain, so it is a good idea to deploy new contracts with discretion.  \\n \\nContract Will Be Created Now, Proceed\? \"); if ( ok_proceed == true ) { create_contract(web3.eth.accounts[0], compiled_array_abi, compiled_array_bytecode, gas_estimate, get_key(solidity_compiled), document.getElementById(\"status\")); return false; } else {}' /></p>");
    
    }
    else {
    document.write("<p><b style='color: red;'>Could not compile, check your source code...also look for any comments in the source code related to steps required before compiling.  Debugging via command line with 'solc /path/to/your-source-file.sol' will give verbose error outputs that can help determine the cause.</b></p>");
    }
    

}
else {
document.write('<p style="font-weight: bold; color: red;">You have no compilers installed.</p>');
}




    document.write("<p><form name='live_contract' action='' method='post'><b>View Live Contract Bytecode From An Address:</b> <br /><br /><input type='text' size='65' name='get_live_contract_code' value='<?=trim($_POST['get_live_contract_code'])?>' /> <input type='button' value='Get Live Contract Bytecode' onclick='document.live_contract.submit();' /></form></p>");
    
if ( $_POST['get_live_contract_code'] ) {
    document.write("<textarea name='live_contract_code' rows='30' style='width: <?=$textarea_widths?>;'>" +
                   get_contract_code($_POST['get_live_contract_code'].trim()) + "</textarea>");
}

</script>


<p align='center'>
	
	<a href='https://github.com/taoteh1221/DFD_Geth_JSON/releases' target='_blank'>Version <?=$version?></a>
	
	<br /><br />Donations are welcome to support further development...
	<br /><br />BTC: 1FfWHekHPLH7hQcU4d5MBVQ4WekJiA8Mk2
	<br /><br />ETH: 0xf3da0858c3cfcc28a75c1232957a7fb190d7e5e9

</p>

</div> <!-- #wrapper -->

<script type='text/javascript'>

		editAreaLoader.init({
			id: "source_code"	// id of the textarea to transform	
			,start_highlight: true
			,allow_toggle: true
                        ,word_wrap: true
			,language: "en"
			,syntax: "sol"	
			,toolbar: "new_document, save, |, search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"

			//,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,syntax_selection_allow: "sol,js,c,cpp,python,vb,basic,php"
			,show_line_colors: true
			,save_callback: "source_code_save"
			,change_callback: "source_code_change"
		});
                
                
// callback functions
function source_code_change(id, content){
document.solidity_code.source_code.value = content;
}
function source_code_save(id, content){

document.solidity_code.sol_file.value = "sol/user-customized.sol";

// Run our custom js vars etc before compiling
console.log('running js code....');
run_js(document.getElementById('js_code'));


    // Find / replace up to 16 vars
    if ( typeof var_1 !== 'undefined' ) {
    var content = content.replace(/var_1/g, var_1);
    console.log('processed var to contract: '+var_1);
    }
    if ( typeof var_2 !== 'undefined' ) {
    var content = content.replace(/var_2/g, var_2);
    console.log('processed var to contract: '+var_2);
    }
    if ( typeof var_3 !== 'undefined' ) {
    var content = content.replace(/var_3/g, var_3);
    console.log('processed var to contract: '+var_3);
    }
    if ( typeof var_4 !== 'undefined' ) {
    var content = content.replace(/var_4/g, var_4);
    console.log('processed var to contract: '+var_4);
    }
    if ( typeof var_5 !== 'undefined' ) {
    var content = content.replace(/var_5/g, var_5);
    console.log('processed var to contract: '+var_5);
    }
    if ( typeof var_6 !== 'undefined' ) {
    var content = content.replace(/var_6/g, var_6);
    console.log('processed var to contract: '+var_6);
    }
    if ( typeof var_7 !== 'undefined' ) {
    var content = content.replace(/var_7/g, var_7);
    console.log('processed var to contract: '+var_7);
    }
    if ( typeof var_8 !== 'undefined' ) {
    var content = content.replace(/var_8/g, var_8);
    console.log('processed var to contract: '+var_8);
    }
    if ( typeof var_9 !== 'undefined' ) {
    var content = content.replace(/var_9/g, var_9);
    console.log('processed var to contract: '+var_9);
    }
    if ( typeof var_10 !== 'undefined' ) {
    var content = content.replace(/var_10/g, var_10);
    console.log('processed var to contract: '+var_10);
    }
    if ( typeof var_11 !== 'undefined' ) {
    var content = content.replace(/var_11/g, var_11);
    console.log('processed var to contract: '+var_11);
    }
    if ( typeof var_12 !== 'undefined' ) {
    var content = content.replace(/var_12/g, var_12);
    console.log('processed var to contract: '+var_12);
    }
    if ( typeof var_13 !== 'undefined' ) {
    var content = content.replace(/var_13/g, var_13);
    console.log('processed var to contract: '+var_13);
    }
    if ( typeof var_14 !== 'undefined' ) {
    var content = content.replace(/var_14/g, var_14);
    console.log('processed var to contract: '+var_14);
    }
    if ( typeof var_15 !== 'undefined' ) {
    var content = content.replace(/var_15/g, var_15);
    console.log('processed var to contract: '+var_15);
    }
    if ( typeof var_16 !== 'undefined' ) {
    var content = content.replace(/var_16/g, var_16);
    console.log('processed var to contract: '+var_16);
    }
    

document.solidity_code.source_code.value = content;

document.solidity_code.submit();

//alert("Here is the content of the EditArea '"+ id +"' as received by the save callback function:\n"+content);
}

</script>


</body>
</html>
