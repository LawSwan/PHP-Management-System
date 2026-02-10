<?php
// Customer registration controller.
// Reads registration form values.
// Checks required fields.
// Inserts a new row into the customer table.

require_once("model/db_customers.php");

// Used to show messages on the registration page.
$errorMessage = "";
$successMessage = "";

// Only insert when the form is submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Variables match the input names in the form.
    $emailText = "";
    $firstNameText = "";
    $lastNameText = "";
    $streetAddressText = "";
    $cityText = "";
    $stateText = "";
    $zipCodeText = "";
    $phoneNumberText = "";
    $passwordText = "";

    // Pull values from $_POST.
    if (isset($_POST["email"])) $emailText = $_POST["email"];
    if (isset($_POST["first_name"])) $firstNameText = $_POST["first_name"];
    if (isset($_POST["last_name"])) $lastNameText = $_POST["last_name"];
    if (isset($_POST["street_address"])) $streetAddressText = $_POST["street_address"];
    if (isset($_POST["city"])) $cityText = $_POST["city"];
    if (isset($_POST["state"])) $stateText = $_POST["state"];
    if (isset($_POST["zip_code"])) $zipCodeText = $_POST["zip_code"];
    if (isset($_POST["phone_number"])) $phoneNumberText = $_POST["phone_number"];
    if (isset($_POST["customer_password"])) $passwordText = $_POST["customer_password"];

    // Basic required field check.
    if ($emailText == "" || $firstNameText == "" || $lastNameText == "" || $passwordText == "") {
        $errorMessage = "Please complete the required fields.<br>";
    }
    //password complexity validation:
    // Minimum length 8, at least 1 uppercase, 1 lowercase, 1 special character.
    if (strlen($passwordText) <8) {
        $errorMessage .= "Password must be at least 8 characters long.<br>";
    }
    if (!preg_match('/[A-Z]/', $passwordText)) {
        $errorMessage .= "Password must contain at least 1 uppercase letter.<br>";
    }
    if (!preg_match('/[a-z]/', $passwordText)) {
        $errorMessage .= "Passowrd must contain at least 1 lowercase letter.<br>";
    }
    if (!preg_match('/[^a-zA-Z0-9]/', $passwordText)) {
        $errorMessage .= "Password must contain at least 1 special character.<br>";
    } 
    if ($errorMessage == ""){
        // Insert the new customer record.
        // Password is stored plain text for now since hashing has not been covered yet.
        $insertWorked = insertCustomer(
            $emailText,
            $firstNameText,
            $lastNameText,
            $streetAddressText,
            $cityText,
            $stateText,
            $zipCodeText,
            $phoneNumberText,
            $passwordText
        );

        if ($insertWorked == true) {
            $successMessage = "Account created.";
        } else {
            $errorMessage = "Registration failed.";
        }
    }
}


// Load the registration view.
require_once("view/register.php");
