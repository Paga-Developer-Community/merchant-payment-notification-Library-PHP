<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

global $validuser,$validpassword;

$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

$service = $_GET["service"];

$bodyJSON = file_get_contents('php://input');
$body = json_decode($bodyJSON, TRUE);

if ($service == "getIntegrationServices") {

    $response = getIntegrationServices($body);

    echo($response);

} elseif ($service == "validateCustomer") {

    $response = validateCustomer($body);

    echo($response);

}elseif($service == "getMerchantServices"){

    $response = getMerchantServices($body);

    echo($response);

}elseif($service == "submitTransaction"){

    $response = submitTransaction($body);

    echo($response);
}
else {
    //400 bad request
    http_response_code(400);

    echo json_encode(array("message" => "No service"));
}


function getIntegrationServices($body){

    validateUser($body["isTest"]);

    $response = null;

    if($body["isTest"]){
        //response from QA test db
        $response = array("services" => array("VALIDATE_CUSTOMER", "MERCHANT_SERVICES", "SUBMIT_PAYMENT"));

    }else {
        //response from live db

    }

    if($response != null)
        $response = json_encode($response);

    return $response;

}

function validateCustomer($body){

    validateUser($body["isTest"]);

    $response = null;

    if($body["isTest"]){
        //response from QA test db
        $response = array("status" => "SUCCESS", "message"=>"Test Message", "isValid"=>true, "firstName"=>"firstName",
            "lastName"=>"lastName", "lastPaymentDate"=>"2020-01-01", "accountStatus"=>"SUCCESS",
            "paymentDueDate"=>"2022-01-01", "isDisplayed"=>true);


    }else {
        //response from live db

    }

    if($response != null)
        $response = json_encode($response);

    return $response;
}

function getMerchantServices($body){

    validateUser($body["isTest"]);

    $response = null;

    if($body["isTest"]){
        //response from QA db
        $response = array(
            "status" => "SUCCESS",
            "services" =>
                array(
                    array("name"=>"Service name1", "price"=>1200.23, "shortCode"=>"serviceCode1", "productCode"=>"prodCode1",
                        "isPublic"=>true),
                    array("name"=>"Service name2", "price"=>1300.23, "shortCode"=>"serviceCode2", "productCode"=>"prodCode2",
                        "isPublic"=>true))
             );

    }else {
        //response from live db

    }

    if($response != null)
        $response = json_encode($response);

    return $response;

}

function submitTransaction($body){

    validateUser($body["isTest"]);

    $response = null;

    if($body["isTest"]){
        //response from QA test db,
        $customerReference= $body["transaction"]["customerReference"];
        $response = array("status"=>"SUCCESS", "uniqueTransactionId"=>"trxn_Id", "customerReference"=>$customerReference, "merchantStatus"=>"SUCCESS", "message"=>"successful payment from merchant", "confirmationCode"=>"Code12345");

    }else {

        //response from live db

    }

    if($response != null)
        $response = json_encode($response);

    return $response;
}

function validateUser($isTest){

    if($isTest) {
        //credentials from QA test db
        $validuser = "test_user";
        $validpassword = "Password1";
    }else{
        //credentials from live db
    }

    if ($_SERVER['PHP_AUTH_USER'] != $validuser || $_SERVER['PHP_AUTH_PW'] != $validpassword) {
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }

    http_response_code(200);

}


?>