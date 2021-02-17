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

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

$emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";
$email = $street = $streetnumber = $city = $zipcode = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = htmlspecialchars($_POST["email"]);
        if (empty($_POST["email"])) {
            $emailErr = "Email is a required field";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }

    }

    $streetErr = "";
    if (isset($_POST["street"])) {
        $street = htmlspecialchars($_POST["street"]);
        if (empty($_POST["street"])) {
            $streetErr = "Street is a required field";
        } else if (!preg_match("/^[a-zA-Z-' ]+$/", $street)) {
            $streetErr = "Invalid street name";
        }
    }

    $streetnumberErr = "";
    if (isset($_POST["streetnumber"])) {
        $streetnumber = htmlspecialchars($_POST["streetnumber"]);
        if (empty($_POST["streetnumber"])) {
            $streetnumberErr = "Street Number is a required field";
        } else if (!filter_var($streetnumber, FILTER_VALIDATE_INT)) {
            $streetnumberErr = "invalid street number";
        }
    }

    $cityErr = "";
    if (isset($_POST["city"])) {
        $city = htmlspecialchars($_POST["city"]);
        if (empty($_POST["city"])) {
            $cityErr = "City is a required field";
        }
    }

    $zipcodeErr = "";
    if (isset($_POST["zipcode"])) {
        $zipcode = htmlspecialchars($_POST["zipcode"]);
        if (empty($_POST["zipcode"])) {
            $zipcodeErr = "Zipcode is a required field";
        } else if (!filter_var($zipcode, FILTER_VALIDATE_INT)) {
            $zipcodeErr = "invalid Zipcode";
        }
    }
}

require 'form-view.php';