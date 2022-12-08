<?php 

if(isset($_POST['token'])){
    $token=$_POST['token'];
}else{
    $token=$_POST['token'];
}

if(isset($_POST['amount'])){
    $amount=$_POST['amount'];
}else{
    $amount=$_POST['amount'];
}

$args = http_build_query(array(
    'token' => $token,
    'amount'  => $amount
));

$url = "https://khalti.com/api/v2/payment/verify/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = ['Authorization: Key test_secret_key_3e596fdacf2c47d6a966187362b03c3d'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Response
$response = curl_exec($ch);
// $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Check HTTP status code
if (!curl_errno($ch)) {
    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
      case 200: 
        session_start();
    
        $con = mysqli_connect ("localhost","root", "", "shopping");
        
        $sql = "insert into Shopping_Cart_Final(CustomerID,ItemName,Quantity,Price,Total,OrderDate)  select CustomerID,ItemName,Quantity,Price,Total,OrderDate from Shopping_Cart where CustomerID=".$_SESSION['ID']."";
        
        mysqli_query ($con, $sql);
    
        mysqli_close ($con);
        
        $con = mysqli_connect ("localhost","root", "", "shopping");
        
        $sql = "delete from Shopping_Cart where CustomerID=".$_SESSION['ID']."";
        
        mysqli_query ($con, $sql);
    
        mysqli_close ($con);

        echo 'Payment Successful to Online Clothing Store ';

        
        break;
      default:
        echo 'Unexpected HTTP code: ', $http_code, "\n";
    }
  }
// echo $response;
// echo $status_code;
curl_close($ch);

?> 