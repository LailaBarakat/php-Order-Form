<?php

//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
//your products with their price.
if(isset($_GET['food'])){
    if ($_GET['food']==1){
        $products = [
            ['name' => 'Club Ham', 'price' => 3.20],
            ['name' => 'Club Cheese', 'price' => 3],
            ['name' => 'Club Cheese & Ham', 'price' => 4],
            ['name' => 'Club Chicken', 'price' => 4],
            ['name' => 'Club Salmon', 'price' => 5]
        ];

    }else{
        $products = [
            ['name' => 'Cola', 'price' => 2],
            ['name' => 'Fanta', 'price' => 2],
            ['name' => 'Sprite', 'price' => 2],
            ['name' => 'Ice-tea', 'price' => 3],
        ];

    }

}




$totalValue = 0;

session_start();

$emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";
$email = $street = $streetnumber = $city = $zipcode = $validate = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
            $emailErr = "Email is a required field";
    } else {
        $email = htmlspecialchars($_POST["email"]);
        $_SESSION["email"]=$email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["street"])) {
            $streetErr = "Street is a required field";
    } else {
        $street = htmlspecialchars($_POST["street"]);
        $_SESSION["street"] = $street;
        if (!preg_match("/^[a-zA-Z-' ]+$/", $street)) {
                $streetErr = "Invalid street name";
        }

    }

    if (empty($_POST["streetnumber"])) {
            $streetnumberErr = "Street Number is a required field";
        } else {
            $streetnumber = htmlspecialchars($_POST["streetnumber"]);
            $_SESSION["streetnumber"] = $streetnumber;
            /*if (!filter_var($streetnumber, FILTER_VALIDATE_INT)) {
                $streetnumberErr = "invalid street number";
             }*/
            if(!is_numeric($streetnumber)){
                $streetnumberErr = "invalid street number";
            }

        }

    if (empty($_POST["city"])) {
            $cityErr = "City is a required field";
        }else{
            $city = htmlspecialchars($_POST["city"]);
            $_SESSION["city"] = $city;
    }

    if (empty($_POST["zipcode"])) {
            $zipcodeErr = "Zipcode is a required field";
        } else {
            $zipcode = htmlspecialchars($_POST["zipcode"]);
            $_SESSION ["zipcode"] = $zipcode;
            /*if (!filter_var($zipcode, FILTER_VALIDATE_INT)){
            $zipcodeErr = "invalid Zipcode";
            }*/
            if(!is_numeric($zipcode)){
                $zipcodeErr = "invalid Zipcode";
            }
        }
    if (!$emailErr && !$streetErr && !$streetnumberErr && !$cityErr && !$zipcodeErr){
        $validate = "Your order has been sent!";
    }
}



require 'form-view.php';