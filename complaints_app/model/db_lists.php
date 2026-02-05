<?php
// Dropdown list database functions.
// Pulls lookup data for dropdown menus like products/services and complaint types.
// Also pulls technician list for admin assignment dropdown.

require_once("model/db_connect.php");

function getAllProductsServices() {
    global $databaseConnection;

    // Pull id + name so the dropdown can show the name but submit the id.
    $sql = "select product_service_id, product_service_name
            from products_services
            order by product_service_name";

    $result = mysqli_query($databaseConnection, $sql);

    // Store rows in an array so views can loop through them.
    $productServiceList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $productServiceList[] = $row;
    }

    return $productServiceList;
}

function getAllComplaintTypes() {
    global $databaseConnection;

    // Same idea as products/services.
    $sql = "select complaint_type_id, complaint_type_name
            from complaint_types
            order by complaint_type_name";

    $result = mysqli_query($databaseConnection, $sql);

    $complaintTypeList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $complaintTypeList[] = $row;
    }

    return $complaintTypeList;
}

function getAllTechnicians() {
    global $databaseConnection;

    // Only pull technicians since admins should not be assigned complaints.
    $sql = "select employee_id, user_id, first_name, last_name
            from employees
            where level = 'technician'
            order by last_name, first_name";

    $result = mysqli_query($databaseConnection, $sql);

    $technicianList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $technicianList[] = $row;
    }

    return $technicianList;
}
