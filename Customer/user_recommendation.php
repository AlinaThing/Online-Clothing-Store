<?php
include "recommend.php";
$conn = mysqli_connect ("localhost","root", "", "shopping");

$users = $conn->query("SELECT DISTINCT CustomerId FROM shopping_cart_final");

$matrix = array();

while($user = $users->fetch_assoc())
{
    $customer_id = $user['CustomerId'];

    $clothes = $conn->query("SELECT ItemName FROM shopping_cart_final WHERE CustomerId = '$customer_id'");
    while($cloth = $clothes->fetch_assoc())
    {
        $cloth_name = $cloth['ItemName'];
        $ratings = $conn->query("SELECT Feedback FROM feedback_master WHERE ItemName = '$cloth_name' &&  CustomerId= '$customer_id'");
        
        $cloth_rating = -1;
        while($rating = $ratings->fetch_assoc()){            
            $cloth_rating = $rating['Feedback'];
        }

        if($cloth_rating != -1)
        {
            $matrix[$customer_id][$cloth_name] = $cloth_rating;
        }
                
    }    
}


// $clothes = $conn->query("SELECT * FROM shopping_cart_final");
// while($clotheses = $clothes->fetch_assoc()){    
//     $users = $conn->query("SELECT * FROM customer_registration WHERE CustomerId = '$clotheses[CustomerId]'");
//     while($username = $users->fetch_assoc()){
//         $ratings = $conn->query("SELECT * FROM feedback_master WHERE ItemName = '$clotheses[ItemName]' &&  CustomerId= '$username[CustomerId]'") ;
//         while($rating = $ratings->fetch_assoc()){
//             $matrix[$username['CustomerName']][$clotheses['ItemName']]= $rating['Feedback'];
//         }
//     }    
// }



// echo "<pre>";
// print_r($matrix);
// echo "</pre>"; 

$user_id = $_SESSION['ID'];

// $user_id_sql = $conn->query("SELECT CustomerId FROM customer_registration where CustomerName = 'alina'");
// while($user_id_res = $user_id_sql->fetch_assoc()){            
//     $user_id = $user_id_res['CustomerId'];
// }

//echo $user_id;

$conn -> close();

//var_dump(getRecommendation($matrix, $user_id));
$recommendation = array();
$recommendation = getRecommendation($matrix, $user_id);

$recommended_products = array();

foreach($recommendation as $product=>$rating)
{
    $recommended_products[] = $product;
}

?>