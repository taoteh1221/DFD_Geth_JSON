<?php

require("config.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>DFD Geth JSON - Activate / Update Password Protection</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
    
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

    
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

</style>
  
</head>
<body>

<?php

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    echo ' <p style="font-weight: bold; color: red;">You are running PHP on a Windows server, so this feature probably will not work at all.</p>';
}

if ( trim($_POST['ht_user']) != '' && trim($_POST['ht_pass']) != '' ) {



$ht_contents = '
Order allow,deny
Allow from all
AuthType        Basic
AuthUserFile    '.getcwd().'/.passwd

AuthName        "Authorized Persons Only"
require valid-user
';

$ht_file_result = file_put_contents(".htaccess", $ht_contents);
chmod(".htaccess", 0644);


$_POST['ht_pass'] = crypt(trim($_POST['ht_pass']));

    if ( $_POST['update_method'] == 'append' ) {
    $orig_user_passes = file_get_contents(".passwd");
    $pass_file_result = file_put_contents(".passwd", $orig_user_passes . trim($_POST['ht_user']).':'.$_POST['ht_pass'] . "\n");
    }
    else {
    $pass_file_result = file_put_contents(".passwd", trim($_POST['ht_user']).':'.$_POST['ht_pass'] . "\n");
    }

chmod(".passwd", 0644);


    if ( $ht_file_result && $pass_file_result ) {
    echo ' <p style="font-weight: bold; color: red;">Password protection created / updated.</p>';
    }
    else {
    $sol_file_result_alert = ' <p style="font-weight: bold; color: red;">Error creating / updating password protection files ".htaccess" and ".passwd". Check your directory / file permissions.</p>';
    }


}


?>

<p><b>Activate / Update Password Protection:</b></p>
    
    <form name='update_password_protection' action='' method='post'>
        
    <p>Username: <input type='text' name='ht_user' /></p>
    
    <p>Password: <input type='text' name='ht_pass' /></p>
    
    <p>Update Method:<br />
    Erase / Reset All Existing Users <input type='radio' name='update_method' value='overwrite' checked /><br />
    Add New User, Keep Existing Users <input type='radio' name='update_method' value='append' />
    </p>
    
    <input type='submit' value='Activate / Update Password Protection' />
    
    </form>


<p style='margin-top: 15px;'>To delete only one username's login, download the .passwd file and remove the line that has that username on it, then replace the remote file with the new version.</p>


<p align='center'>Version <?=$version?> <br /><a href='http://www.dragonfrugal.com/download-bin/DFD_Geth_JSON_<?=$version?>.zip' target='_blank'>Download Source Code Here</a><br /><br />BTC Donations welcome: 1FfWHekHPLH7hQcU4d5MBVQ4WekJiA8Mk2</p>

</body>
</html>
