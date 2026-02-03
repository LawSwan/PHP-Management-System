<?php
// Site map page.
// Lists links to every page in the project so nothing is hidden.

require_once("view/header.php");
?>

<h2>VelocityNet Site Map</h2>

<ul>
    <li><a href="index.php">Home</a></li>

    <li><a href="index.php?action=login">Login</a></li>
    <li><a href="index.php?action=register">Register</a></li>

    <li><a href="index.php?action=enter_complaint">Enter Complaint</a></li>
    <li><a href="index.php?action=complaint_list">Complaint List</a></li>

    <li><a href="index.php?action=technician_complaint_list&employee_id=1">Technician List (id 1)</a></li>
    <li><a href="index.php?action=technician_password_change">Technician Password Change</a></li>

    <li><a href="index.php?action=admin_customer_list">Admin Customers</a></li>
    <li><a href="index.php?action=admin_employee_list">Admin Employees</a></li>

    <li><a href="index.php?action=admin_complaint_open_list">Admin Open Complaints</a></li>
    <li><a href="index.php?action=admin_complaint_unassigned_list">Admin Unassigned Complaints</a></li>

    <li><a href="index.php?action=admin_technician_counts">Admin Technician Counts</a></li>
    <li><a href="index.php?action=admin_complaint_assign">Admin Assign Complaint</a></li>
</ul>

<?php require_once("view/footer.php"); ?>
