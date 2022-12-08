<?php

if(isset($_GET['key'])){
    $key=$_GET['key'];
    $conn= mysqli_connect("localhost","root","","shopping");
    $result = mysqli_query($conn,"SELECT Verification_Code FROM customer_registration WHERE Verification_Code='".$key."' and Verified=0");
    if($result){
        if(mysqli_num_rows($result)>0){
            $updateQuery ="Update customer_registration SET Verified =1 WHERE Verification_Code='$key'";
            if(mysqli_query($conn,$updateQuery)){
                echo '<script type="text/javascript">alert("Succesfully Verified.");window.location=\'index.php\';</script>';
            }else{
                echo '<script type="text/javascript">alert("Not Verified.");window.location=\'index.php\';</script>';

            }
        }
    }


}else{
    die ("Something went wrong.");
}

?>