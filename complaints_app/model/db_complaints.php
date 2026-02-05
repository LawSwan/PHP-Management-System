<?php
// Complaint database functions.
// Handles inserting, reading, and updating complaints.
// Also provides admin reports like open complaint lists and technician counts.

require_once("model/db_connect.php");

function insertComplaint($customerIdNumber, $productServiceIdNumber, $complaintTypeIdNumber, $complaintDescriptionText) {
    global $databaseConnection;

    // Create a new complaint.
    // status starts as open.
    $sql = "insert into complaints
            (customer_id, product_service_id, complaint_type_id, description, status)
            values (?, ?, ?, ?, 'open')";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "iiis", $customerIdNumber, $productServiceIdNumber, $complaintTypeIdNumber, $complaintDescriptionText);

    return mysqli_stmt_execute($statement);
}

function getAllComplaintsWithNames() {
    global $databaseConnection;

    // Pull complaints and join lookup tables so views can show readable names.
    // Left joins allow null employee_id for unassigned complaints.
    $sql = "select c.complaint_id,
                   c.status,
                   c.description,
                   c.created_at,
                   cu.first_name as customer_first_name,
                   cu.last_name as customer_last_name,
                   e.first_name as employee_first_name,
                   e.last_name as employee_last_name,
                   ps.product_service_name,
                   ct.complaint_type_name
            from complaints c
            left join customer cu on c.customer_id = cu.customer_id
            left join employees e on c.employee_id = e.employee_id
            left join products_services ps on c.product_service_id = ps.product_service_id
            left join complaint_types ct on c.complaint_type_id = ct.complaint_type_id
            order by c.created_at desc";

    $result = mysqli_query($databaseConnection, $sql);

    $complaintList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $complaintList[] = $row;
    }

    return $complaintList;
}

function getOpenComplaintsWithNames() {
    global $databaseConnection;

    // Same as getAllComplaintsWithNames but only open status.
    $sql = "select c.complaint_id,
                   c.status,
                   c.description,
                   c.created_at,
                   cu.first_name as customer_first_name,
                   cu.last_name as customer_last_name,
                   e.first_name as employee_first_name,
                   e.last_name as employee_last_name,
                   ps.product_service_name,
                   ct.complaint_type_name
            from complaints c
            left join customer cu on c.customer_id = cu.customer_id
            left join employees e on c.employee_id = e.employee_id
            left join products_services ps on c.product_service_id = ps.product_service_id
            left join complaint_types ct on c.complaint_type_id = ct.complaint_type_id
            where c.status = 'open'
            order by c.created_at desc";

    $result = mysqli_query($databaseConnection, $sql);

    $complaintList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $complaintList[] = $row;
    }

    return $complaintList;
}

function getUnassignedOpenComplaintsWithNames() {
    global $databaseConnection;

    // Open complaints where employee_id is null.
    $sql = "select c.complaint_id,
                   c.status,
                   c.description,
                   c.created_at,
                   cu.first_name as customer_first_name,
                   cu.last_name as customer_last_name,
                   ps.product_service_name,
                   ct.complaint_type_name
            from complaints c
            left join customer cu on c.customer_id = cu.customer_id
            left join products_services ps on c.product_service_id = ps.product_service_id
            left join complaint_types ct on c.complaint_type_id = ct.complaint_type_id
            where c.status = 'open' and c.employee_id is null
            order by c.created_at desc";

    $result = mysqli_query($databaseConnection, $sql);

    $complaintList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $complaintList[] = $row;
    }

    return $complaintList;
}

function assignComplaintToTechnician($complaintIdNumber, $employeeIdNumber) {
    global $databaseConnection;

    // Admin assigns a complaint by setting employee_id.
    $sql = "update complaints
            set employee_id = ?
            where complaint_id = ?";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "ii", $employeeIdNumber, $complaintIdNumber);

    return mysqli_stmt_execute($statement);
}

function getComplaintsByEmployeeIdWithNames($employeeIdNumber) {
    global $databaseConnection;

    // Technician list page. Pull only complaints assigned to this technician.
    $sql = "select c.complaint_id,
                   c.status,
                   c.description,
                   c.created_at,
                   cu.first_name as customer_first_name,
                   cu.last_name as customer_last_name,
                   ps.product_service_name,
                   ct.complaint_type_name
            from complaints c
            left join customer cu on c.customer_id = cu.customer_id
            left join products_services ps on c.product_service_id = ps.product_service_id
            left join complaint_types ct on c.complaint_type_id = ct.complaint_type_id
            where c.employee_id = ?
            order by c.created_at desc";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "i", $employeeIdNumber);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    $complaintList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $complaintList[] = $row;
    }

    return $complaintList;
}

function getComplaintById($complaintIdNumber) {
    global $databaseConnection;

    // Technician update page loads one complaint row.
    $sql = "select complaint_id, customer_id, employee_id, product_service_id, complaint_type_id,
                   description, status, technician_notes, resolution_notes, resolution_date, created_at
            from complaints
            where complaint_id = ?";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "i", $complaintIdNumber);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    return mysqli_fetch_assoc($result);
}

function updateComplaintTechnicianFields($complaintIdNumber, $technicianNotesText, $statusText, $resolutionDateText, $resolutionNotesText) {
    global $databaseConnection;

    // Update fields that the technician can change.
    $sql = "update complaints
            set technician_notes = ?,
                status = ?,
                resolution_date = ?,
                resolution_notes = ?
            where complaint_id = ?";

    $statement = mysqli_prepare($databaseConnection, $sql);
    mysqli_stmt_bind_param($statement, "ssssi", $technicianNotesText, $statusText, $resolutionDateText, $resolutionNotesText, $complaintIdNumber);

    return mysqli_stmt_execute($statement);
}

function getTechnicianOpenComplaintCounts() {
    global $databaseConnection;

    // Admin report. Count open complaints per technician.
    // Left join keeps technicians that have zero open complaints.
    $sql = "select e.employee_id,
                   e.user_id,
                   e.first_name,
                   e.last_name,
                   count(c.complaint_id) as open_count
            from employees e
            left join complaints c
                on e.employee_id = c.employee_id
                and c.status = 'open'
            where e.level = 'technician'
            group by e.employee_id, e.user_id, e.first_name, e.last_name
            order by e.last_name, e.first_name";

    $result = mysqli_query($databaseConnection, $sql);

    $countList = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $countList[] = $row;
    }

    return $countList;
}
