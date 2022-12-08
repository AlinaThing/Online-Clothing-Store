<?php
// echo "TEST PAGE";
//$data['token'] = $_POST['token'] ;
if(isset($_POST['token'])){
    $token=$_POST['token'];
}else{
    $token="<br>No token";
}
echo $token;
?>