<?php
// Employee database functions.
// Handles listing, inserting, reading, and updating employees.
// Employees are technicians and administrators.

require_once("model/db_connect.php");

function getAllEmployees() {
    global $databaseConnection;

    // List employees for admin employee list page.
    $sql = "select employee_id, user_id, first_name, last_name, email, phone_extension, level
            from employees
            order by last_name, first_name";

    $result = mysqli_query($databaseConnection, $sql);

    $employeeList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $employeeList[] = $row;
    }

    return $employeeList;
}

function getEmployeeById($employeeIdNumber) {
    global $databaseConnection;

    // Pull one employee row for the edit page.
    $sql = "select employee_id, user_id, first_name, last_name, email, phone_extension, level
            from employees
            where employee_id = ?";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "i", $employeeIdNumber);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    return mysqli_fetch_assoc($result);
}

function insertEmployee($userIdText, $passwordText, $firstNameText, $lastNameText, $emailText, $phoneExtensionText, $levelText) {
    global $databaseConnection;

    // Insert a new employee row.
    // user_id is add-only for now.
    $sql = "insert into employees
            (user_id, employee_password, first_name, last_name, email, phone_extension, level)
            values (?, ?, ?, ?, ?, ?, ?)";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "sssssss", $userIdText, $passwordText, $firstNameText, $lastNameText, $emailText, $phoneExtensionText, $levelText);

    return mysqli_stmt_execute($statement);
}

function updateEmployee($employeeIdNumber, $firstNameText, $lastNameText, $emailText, $phoneExtensionText, $levelText) {
    global $databaseConnection;

    // Update employee fields that are allowed to change.
    // user_id stays the same.
    $sql = "update employees
            set first_name = ?,
                last_name = ?,
                email = ?,
                phone_extension = ?,
                level = ?
            where employee_id = ?";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "sssssi", $firstNameText, $lastNameText, $emailText, $phoneExtensionText, $levelText, $employeeIdNumber);

    return mysqli_stmt_execute($statement);
}
