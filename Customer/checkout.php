<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
<style>
	.khaltiButton {
  background-color: white; 
  color: #3f51b5; 

}
	</style>
<body>
<?php
	session_start();
	
    $con = mysqli_connect ("localhost","root", "", "shopping");
	
	$query = "Select SUM(price*quantity) from shopping_cart where  CustomerID=".$_SESSION['ID']."";
	$result=$con->query($query);
    while ($row=mysqli_fetch_array($result)){
        $s=$row['SUM(price*quantity)'];
       
    }
	
	?>

<div>
...
    <!-- Place this where you need payment button -->
    <button id="payment-button" class="button khaltiButton">Pay with Khalti</button>
   
    <input type="hidden" id="total" value=spge>

    <!-- Place this where you need payment button -->
    <!-- Paste this code anywhere in you body tag -->
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_01d7f3f7a9804dafa49e72ab33eb6676",
            "productIdentity": "121",
            "productName": "Alina",
            "productUrl": "https://www.google.com.np/",
            "paymentPreference": [
                "KHALTI",
              /*  "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",*/
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    //console.log(payload);
                    showPayload(payload);
                },	
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        spge = '<?php echo $s ;?>';
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            totalValue=spge*100;
            checkout.show({amount: totalValue});
        }
    </script>

   <script>
        function showPayload(payload){ 
        var am = payload.amount;
        var tk = payload.token;
    
      
        jQuery.ajax({
        url:'KhaltiVerification.php',
        type:'post',
        data:{
            token:tk,
            amount:am
        },
        success:function(result){
            alert(result);
            
            // <?php
            // $con = mysqli_connect ("localhost","root", "", "shopping");

            
	
        	// $sql = "insert into Shopping_Cart_Final(CustomerID,ItemName,Quantity,Price,Total,OrderDate)  select CustomerID,ItemName,Quantity,Price,Total,OrderDate from Shopping_Cart where CustomerID=".$_SESSION['ID']."";
	
        	// mysqli_query ($con, $sql);
           
            
            // $con = mysqli_connect ("localhost","root", "", "shopping");
            // $sql = "delete from Shopping_Cart where CustomerID=".$_SESSION['ID']."";
            
            // mysqli_query ($con, $sql);

            // mysqli_close ($con);
                    
                    
            // ?>

            window.location.href='index.php';

        },
                error:function(xhr){
                    alert("failed")
                }
       });
           
        }
    </script> 
</body>
</html>
