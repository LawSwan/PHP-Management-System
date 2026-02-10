<?php
// Customer database functions.
// Handles inserting, reading, listing, and updating customer records.
// Used by registration and admin customer pages.

require_once("model/db_connect.php");

function insertCustomer($emailText, $firstNameText, $lastNameText, $streetAddressText, $cityText, $stateText, $zipCodeText, $phoneNumberText, $passwordText) {
    global $databaseConnection;

    // Insert a new customer row.
    $sql = "insert into customer
            (email, first_name, last_name, street_address, city, state, zip_code, phone_number, customer_password)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the query so we can plug values
    $statement = mysqli_prepare($databaseConnection, $sql);

    // put customer info into insert statement
    mysqli_stmt_bind_param(
        $statement,
        "sssssssss",
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

    return mysqli_stmt_execute($statement);
}

function getAllCustomers() {
    global $databaseConnection;

    // Pull customer list for admin page.
    $sql = "select customer_id, email, first_name, last_name, street_address, city, state, zip_code, phone_number
            from customer
            order by last_name, first_name";

    $result = mysqli_query($databaseConnection, $sql);

    $customerList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $customerList[] = $row;
    }

    return $customerList;
}

function getCustomerById($customerIdNumber) {
    global $databaseConnection;

    // Pull one customer by primary key.
    $sql = "select customer_id, email, first_name, last_name, street_address, city, state, zip_code, phone_number
            from customer
            where customer_id = ?";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "i", $customerIdNumber);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    return mysqli_fetch_assoc($result);
}

function updateCustomer($customerIdNumber, $emailText, $firstNameText, $lastNameText, $streetAddressText, $cityText, $stateText, $zipCodeText, $phoneNumberText) {
    global $databaseConnection;

    // Update customer info from the admin edit page.
    $sql = "update customer
            set email = ?,
                first_name = ?,
                last_name = ?,
                street_address = ?,
                city = ?,
                state = ?,
                zip_code = ?,
                phone_number = ?
            where customer_id = ?";

    $statement = mysqli_prepare($databaseConnection, $sql);

    // Last parameter is the customer id.
    mysqli_stmt_bind_param(
        $statement,
        "ssssssssi",
        $emailText,
        $firstNameText,
        $lastNameText,
        $streetAddressText,
        $cityText,
        $stateText,
        $zipCodeText,
        $phoneNumberText,
        $customerIdNumber
    );

    return mysqli_stmt_execute($statement);
}
