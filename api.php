<?php
#API IS DISABLED BY DEFAULT AS ITS STILL IN DEV. ENABLE AT YOUR OWN RISK.
define("IN_WALLET", true); #TO ENABLE SET TO TRUE
###################################################

include('common.php');

if(!empty($_GET['key'])) {
    $key = $_GET['key'];
    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    if (!$con) {
        $json = array("success" => false, "message" => "Internal Error!", "result" => "error");
        echo json_encode($json);
    }
    $result = mysqli_query($con,"SELECT * FROM users where secret = '$key' and authused=1");
    $user = $result->fetch_assoc();
    mysqli_close($con);
    if($user) {
        $username = $user['username'];
        if(!empty($_GET['action'])) {
            $action = $_GET['action'];
            $client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
            switch($_GET['action']) {
                case "getaccount":
                    $id = $user['id'];
                    $pin = $user['supportpin'];
                    $twofactoren = $user['authused'];
                    $isadmin = $user['admin'];
                    $json = array("success" => true, "message" =>"", "result" => array("id" => "$id", "username" => "$username", "balance" => satoshitize($client->getBalance($username)), "addresses" => $client->getAddressList($username), "Support Pin" => "$pin", "admin" => "$isadmin"));
                    echo json_encode($json);
                break;
                case "getaddresses":
                    $json = array("success" => true, "message" =>"", "result" => array("addressses" => $client->getAddressList($username)));
                    echo json_encode($json);
                break;
                case "getbalance":
                    $json = array("success" => true, "message" =>"", "result" => array("balance" => satoshitize($client->getBalance($username))));
                    echo json_encode($json);
                break;
                case "gettransactions":
                    $json = array("success" => true, "message" =>"", "result" => array("transactions" => $client->getTransactionList($username)));
                    echo json_encode($json);
                break;
                case "getnewaddress":
                    $json = array("success" => true, "message" =>"", "result" => array("address" => $client->getnewaddress($username)));
                    echo json_encode($json);
                break;
                case "withdraw":
                    if (!WITHDRAWALS_ENABLED) {
                        $json = array("success" => false, "message" => "Withdrawals Disabled!", "result" => "error");
                    } elseif (empty($_GET['address']) || empty($_GET['amount']) || !is_numeric($_GET['amount'])) {
                        $json = array("success" => false, "message" => "You have to provide all the values!", "result" => "error");
                    } elseif (($_GET['amount'] + $fee) > $client->getBalance($username)) {
                        $json = array("success" => false, "message" => "Withdrawal amount exceeds your wallet balance", "result" => "error");
                    } else {
                        $withdraw_message = $client->withdraw($username, $_GET['address'], (float)$_GET['amount']);
                        $json = array("success" => true, "message" =>"Withdrawal successful", "result" => "");
                    }
                    echo json_encode($json);
                break;
                default;
                    $json = array("success" => false, "message" => "Unkown Action!", "result" => "error");
                    echo json_encode($json);
                break;
            }
        } else {
            $json = array("success" => false, "message" => "No Action provided", "result" => "error");
            echo json_encode($json);
        }
    } else {
        $json = array("success" => false, "message" => "API Key invalid", "result" => "error");
        echo json_encode($json);
    }
} else {
    $json = array("success" => false, "message" => "You MUST provide an API key", "result" => "error");
    echo json_encode($json);
}
?>