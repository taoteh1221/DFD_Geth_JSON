<?php

require("../config.php");

?>
<!doctype>
<html>

<head>
    <script type='text/javascript'>
    // Keep above all other script
    var proxy_url = "//<?=$proxy_server?>";
    </script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/web3/dist/web3.js"></script>
<script type="text/javascript">

    var web3 = require('web3');
    var BigNumber = require('bignumber.js');
    web3.setProvider(new web3.providers.HttpProvider(proxy_url));
    var from = web3.eth.coinbase;
    web3.eth.defaultAccount = from;

    var nameregAbi = [
        {"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"name","outputs":[{"name":"o_name","type":"bytes32"}],"type":"function"},
        {"constant":true,"inputs":[{"name":"_name","type":"bytes32"}],"name":"owner","outputs":[{"name":"","type":"address"}],"type":"function"},
        {"constant":true,"inputs":[{"name":"_name","type":"bytes32"}],"name":"content","outputs":[{"name":"","type":"bytes32"}],"type":"function"},
        {"constant":true,"inputs":[{"name":"_name","type":"bytes32"}],"name":"addr","outputs":[{"name":"","type":"address"}],"type":"function"},
        {"constant":false,"inputs":[{"name":"_name","type":"bytes32"}],"name":"reserve","outputs":[],"type":"function"},
        {"constant":true,"inputs":[{"name":"_name","type":"bytes32"}],"name":"subRegistrar","outputs":[{"name":"o_subRegistrar","type":"address"}],"type":"function"},
        {"constant":false,"inputs":[{"name":"_name","type":"bytes32"},{"name":"_newOwner","type":"address"}],"name":"transfer","outputs":[],"type":"function"},
        {"constant":false,"inputs":[{"name":"_name","type":"bytes32"},{"name":"_registrar","type":"address"}],"name":"setSubRegistrar","outputs":[],"type":"function"},
        {"constant":false,"inputs":[],"name":"Registrar","outputs":[],"type":"function"},
        {"constant":false,"inputs":[{"name":"_name","type":"bytes32"},{"name":"_a","type":"address"},{"name":"_primary","type":"bool"}],"name":"setAddress","outputs":[],"type":"function"},
        {"constant":false,"inputs":[{"name":"_name","type":"bytes32"},{"name":"_content","type":"bytes32"}],"name":"setContent","outputs":[],"type":"function"},
        {"constant":false,"inputs":[{"name":"_name","type":"bytes32"}],"name":"disown","outputs":[],"type":"function"},
        {"constant":true,"inputs":[{"name":"_name","type":"bytes32"}],"name":"register","outputs":[{"name":"","type":"address"}],"type":"function"},
        {"anonymous":false,"inputs":[{"indexed":true,"name":"name","type":"bytes32"}],"name":"Changed","type":"event"},
        {"anonymous":false,"inputs":[{"indexed":true,"name":"name","type":"bytes32"},{"indexed":true,"name":"addr","type":"address"}],"name":"PrimaryChanged","type":"event"}
    ];

    var depositAbi = [{"constant":false,"inputs":[{"name":"name","type":"bytes32"}],"name":"deposit","outputs":[],"type":"function"}];

    var Namereg = web3.eth.contract(nameregAbi);
    var Deposit = web3.eth.contract(depositAbi);

    var namereg = web3.eth.ibanNamereg;
    var deposit; 
    var iban;

    function validateNamereg() {
        var address = document.getElementById('namereg').value;
        var ok = web3.isAddress(address) || address === 'default';
        if (ok) {
            namereg = address === 'default' ? web3.eth.ibanNamereg : Namereg.at(address);
            document.getElementById('nameregValidation').innerText = 'ok!';
        } else {
            document.getElementById('nameregValidation').innerText = 'namereg address is incorrect!';
        }
        return ok;
    };

    function onNameregKeyUp() {
        updateIBAN(validateNamereg());
        onExchangeKeyUp();
    };
    
    function validateExchange() {
        var exchange = document.getElementById('exchange').value;
        var ok = /^[0-9A-Z]{4}$/.test(exchange);
        if (ok) {
            var address = namereg.addr(exchange);
            deposit = Deposit.at(address);
            document.getElementById('exchangeValidation').innerText = 'ok! address of exchange: ' + address;
        } else {
            document.getElementById('exchangeValidation').innerText = 'exchange id is incorrect';
        }
        return ok;
    };

    function onExchangeKeyUp() {
        updateIBAN(validateExchange());
    };

    function validateClient() {
        var client = document.getElementById('client').value;
        var ok = /^[0-9A-Z]{9}$/.test(client);
        if (ok) {
            document.getElementById('clientValidation').innerText = 'ok!';
        } else {
            document.getElementById('clientValidation').innerText = 'client id is incorrect';
        }
        return ok;
    };

    function onClientKeyUp() {
        updateIBAN(validateClient());
    };

    function validateValue() {
        try {
            var value = document.getElementById('value').value;
            var bnValue = new BigNumber(value);
            document.getElementById('valueValidation').innerText = bnValue.toString(10);
            return true;
        } catch (err) {
            document.getElementById('valueValidation').innerText = 'Value is incorrect, cannot parse';
            return false;
        }
    };

    function onValueKeyUp() {
        validateValue();
    };

    function validateIBAN() {
        if (!iban.isValid()) {
            return document.getElementById('ibanValidation').innerText = ' - IBAN number is incorrect';
        }
        document.getElementById('ibanValidation').innerText = ' - IBAN number correct';
    };

    function updateIBAN(ok) {
        var exchangeId = document.getElementById('exchange').value;
        var clientId = document.getElementById('client').value; 
        iban = web3.eth.iban.createIndirect({
            institution: exchangeId,
            identifier: clientId
        });
        document.getElementById('iban').innerText = iban.toString();
        validateIBAN();
    };

    function transfer() {
        var value = new BigNumber(document.getElementById('value').value);
        var exchange = document.getElementById('exchange').value;
        var client = document.getElementById('client').value;
        deposit.deposit(web3.fromAscii(client), {value: value});
        displayTransfer("deposited client's " + client + " funds " + value.toString(10) + " to exchange " + exchange);
    };

    function displayTransfer(text) {
        var node = document.createElement('li');
        var textnode = document.createTextNode(text);
        node.appendChild(textnode);
        document.getElementById('transfers').appendChild(node);
    }
    
</script>
</head>
<body>
    <div class="col-lg-12">
        <i>This page expects geth with JSON-RPC running at port 8545</i>
        <div class="page-header">
            <h1>ICAP transfer</h1>
        </div>
        <div class="col-lg-6">
            <div class="well">
                <legend class="lead">namereg address</legend>
                <small>eg. 0x436474facc88948696b371052a1befb801f003ca or 'default')</small>
                <div class="form-group">
                    <input class="form-control" type="text" id="namereg" onkeyup='onNameregKeyUp()' value="default"></input>
                    <text id="nameregValidation"></text>
                </div>

                <legend class="lead">exchange identifier</legend>
                <small>eg. WYWY</small>
                <div class="form-group">
                    <input class="form-control" type="text" id="exchange" onkeyup='onExchangeKeyUp()'></input>
                    <text id="exchangeValidation"></text>
                </div>

                <legend class="lead">client identifier</legend>
                <small>eg. GAVOFYORK</small>
                <div class="form-group">
                    <input class="form-control" type="text" id="client" onkeyup='onClientKeyUp()'></input>
                    <text id="clientValidation"></text>
                </div>

                <legend class="lead">value</legend>
                <small>eg. 100</small>
                <div class="form-group">
                    <input class="form-control" type="text" id="value" onkeyup='onValueKeyUp()'></input>
                    <text id="valueValidation"></text>
                </div>

                <legend class="lead">IBAN: </legend>
                <div class="form-group">

                    <text id="iban"></text>
                    <text id="ibanValidation"></text>
                </div>
                <div>
                    <button class="btn btn-default" id="transfer" type="button" onClick="transfer()">Transfer!</button>
                    <text id="transferValidation"></text>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="well">
                <div>
                    <legend class="lead">transfers</legend>
                </div>
                <div>
                    <ul id='transfers'></ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
