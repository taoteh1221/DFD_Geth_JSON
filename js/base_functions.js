
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function eth_mining_profit() {

    if ( eth_mining == true ) {
        
    var scale = ( difficulty / 1000000 );  //MHs
    
    var time = ( scale.toFixed(2) / eth_hash_rate_convert['MHs'].toFixed(2) );
    
    var hours = ( time / 3600 );
    
    var days = ( hours / 24 );
    
    var months = ( days / 30 );
    
    var years = ( days / 365 );

        if ( hours < 24 ) {
        
        window.node_html = window.node_html + '<p><b>Hours until block found:</b> ' + hours.toFixed(2) + '</p>';
        
        }
    
        else if ( days < 30 ) {
        
        window.node_html = window.node_html + '<p><b>Days until block found:</b> ' + days.toFixed(2) + '</p>';
        
        }
    
        else if ( days < 365 ) {
        
        window.node_html = window.node_html + '<p><b>Months until block found:</b> ' + months.toFixed(2) + '</p>';
        
        }
        
        else {
        
        window.node_html = window.node_html + '<p><b>Years until block found:</b> ' + years.toFixed(2) + '</p>';
        
        }
    
        var average_daily = (5 / days);
        
        
        window.node_html = window.node_html + '<p><b>Average Daily Earnings:</b> ' + average_daily.toFixed(2) + ' ETH</p>';
        
    }


}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function node_stats() {

    
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

    /*
    web3.eth.getHashrate( function (error, hashrate2) {
                                                        
                                                        
              var eth_hash_rate_convert2 = {
                                          Hs: hashrate2,
                                          KHs: (hashrate2 / 200000000000000),
                                          MHs: (hashrate2 / 200000000000000000)
                                          };
                                
    if (!error)
    document.getElementById('hashrate').innerHTML = ( eth_mining == true ) ? "Yes (localhost hashrate is " + eth_hash_rate_convert2['MHs'].toFixed(2) + " MHs)" : "No" + "</p>";
                                              
                                              });
    
    web3.eth.getBlock(48, function(error, result){
    if(!error)
        console.log(result)
    else
        console.error(error);
    });
    */
    
    window.node_html = '';

    window.node_html = "<p><b>Client Version:</b> "+client_version+"</p>";
    
    window.node_html = window.node_html + "<p><b>Number of Peers:</b> "+peer_count+"</p>";
    
    window.node_html = window.node_html + "<p><b>Current Block Number:</b> "+number_format(block_number)+"</p>";
    
    window.node_html = window.node_html + "<p><b>Gas Price:</b> "+(gas_price / 1000000000)+" gwei</p>";
    
    window.node_html = window.node_html + "<p><b>Gas Limit:</b> "+number_format(block_info['gasLimit'])+" gas</p>";
    
    window.node_html = window.node_html + "<p><b>Addresses:</b> <ul>";
    
        for(var account in window.accounts) {
    window.node_html = window.node_html + "<li><a href='http://etherscan.io/address/" + accounts[account] + "' target='_blank'>" + accounts[account] + "</a> (Local Account " + account + "): "+ web3.eth.getBalance(accounts[account]) / 1000000000000000000 +" ETH, "+web3.eth.getTransactionCount(accounts[account])+" sent transactions</li>";
        }
        
    window.node_html = window.node_html + "</ul></p>";
    
    window.node_html = window.node_html + "<p><b>Available Compilers:</b> <ul>";
        
        for(var compiler in compilers) {
    window.node_html = window.node_html + "<li>" + compilers[compiler] + "</li>";
        }
        
    window.node_html = window.node_html + "</ul></p>";
    
    window.node_html = window.node_html + "<p><b>ETH Coinbase:</b> <a href='http://etherscan.io/address/" + coin_base + "' target='_blank'>"+coin_base+"</a></p>";
    
    window.node_html = window.node_html + "<p><b>Mining Difficulty:</b> "+number_format(difficulty)+"</p>";
    
    var is_mining = ( eth_mining == true ) ? "Yes (localhost hashrate is " + eth_hash_rate_convert['MHs'].toFixed(2) + " MHs)" : "No" + "</p>";
    
    window.node_html = window.node_html + "<p><b>Mining</b>: " + is_mining;
    
    eth_mining_profit();
    
    document.getElementById('node_stats').innerHTML = window.node_html;
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function reset_focus() {
    
console.log( "Ran workaround for editarea focus bug" );
$('#source_code').blur();
$('#focus').focus();
$('#focus').blur();
//window.focus();

}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function run_js(code) {
    var el = code;
    var scriptText = el.value;
    var oldScript = document.getElementById('scriptContainer');
    var newScript;

    if (oldScript) {
      oldScript.parentNode.removeChild(oldScript);
    }

    newScript = document.createElement('script');
    newScript.id = 'scriptContainer';
    newScript.text = el.value;
    document.body.appendChild(newScript);
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
// Decimal to hexidecimal, and opposite
function d2h(d) {return d.toString(16);}
function h2d(h) {return parseInt(h,16);}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function saveTextAsFile(doc_id, fileNameToSaveAs)
{      
// grab the content of the form field and place it into a variable
    var textToWrite = doc_id.value;
//  create a new Blob (html5 magic) that conatins the data from your form feild
    var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});
    
// Optionally allow the user to choose a file name by providing 
// an imput field in the HTML and using the collected data here
// var fileNameToSaveAs = txtFileName.text;

// create a link for our script to 'click'
    var downloadLink = document.createElement("a");
//  supply the name of the file (from the var above).
// you could create the name here but using a var
// allows more flexability later.
    downloadLink.download = fileNameToSaveAs;
// provide text for the link. This will be hidden so you
// can actually use anything you want.
    downloadLink.innerHTML = "My Hidden Link";
    
// allow our code to work in webkit & Gecko based browsers
// without the need for a if / else block.
    window.URL = window.URL || window.webkitURL;
          
// Create the link Object.
    downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
// when link is clicked call a function to remove it from
// the DOM in case user wants to save a second file.
    downloadLink.onclick = destroyClickedElement;
// make sure the link is hidden.
    downloadLink.style.display = "none";
// add the link to the DOM
    document.body.appendChild(downloadLink);
    
// click the new link
    downloadLink.click();
}

function destroyClickedElement(event)
{
// remove the link from the DOM
    document.body.removeChild(event.target);
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function number_format(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function get_key(data) {
    
  for (var key in data) {
    
    if (data.propertyIsEnumerable(key)) {
    return key;
    }
    
  }

return false;
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function create_contract(account, abi, code, gas_estimate, contract_name, status_html_tag) {
    
    
        reset_focus();
        
        // create contract
        status_html_tag.innerHTML = "Transaction is being sent, waiting for confirmation...";
        
        web3.eth.contract(abi).new({
                                    from: account, 
                                    data: code,
                                    gas: gas_estimate
                                    }, function (err, contract) {
            
            if(err) {
                
                console.error(err);
                return;

            // callback fires twice, we only want the second call when the contract is deployed
            }
            else if(contract.address) {
                
                var contract_javascript = 'var '+contract_name+' = web3.eth.contract('+JSON.stringify(abi, null, 4)+').at("'+contract.address+'");';
                
                document.getElementById('status').innerHTML = 'Processed to blockchain sucessfully, the contract address is: ' + contract.address + '<p>This code below allows you and other individuals to run your contract from the blockchain with the Geth client software, and also allows you to delete your contract as well (if you lose this code or did not include a contract kill function in it before creating it, you <i>cannot delete this contract ever</i>). To delete this contract (if you included a basic kill function in it) run this additional javascript kill code from Geth in console mode (with the same account you created it with) <i>AFTER</i> running the contract javascript code: <br /><br /> '+contract_name+'.YOUR_KILL_FUNCTION_NAME_HERE.sendTransaction({from:ACCOUNT_ID_HERE}) <br /><br /><input class="black" type="button" value="Save This Contract Initiation Data As A Javascript File To My Computer" onclick="saveTextAsFile(document.getElementById(\'contract_javascript\'),\'eth_contract_'+contract_name+'.js\');" /><br /><br /><textarea class="black" id="contract_javascript" cols="120" rows="25">'+contract_javascript+'</textarea></p>';
                
            }
            
        });
        
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function call_contract() {
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function send_eth(from_address, to_address, eth_amount, eth_unit) {
                            
document.getElementById('status').innerHTML = 'Transaction is being processed, please wait...';
    
var inwei = web3.toWei(eth_amount, eth_unit);
    
    web3.eth.sendTransaction({from: web3.eth.accounts[from_address], to: to_address, value: inwei}, function(err, transaction_id) {
                            
                            if (!err) {
                            document.getElementById('status').innerHTML = 'Address ' + to_address + ' was sent ' + eth_amount + ' '+eth_unit+' from local account '+from_address+', ' + "\n Transaction ID: " + transaction_id;
                            }
                            else {
                            document.getElementById('status').innerHTML = err;
                            }
                            
    });
    

}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function get_contract_code(address) {
return web3.eth.getCode(address);
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


