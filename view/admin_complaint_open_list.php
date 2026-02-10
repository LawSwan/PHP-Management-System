<?php
// Admin Complaint Open List.
// Page or helper used by the application.

/*
    Admin open complaints list.

    Shows open complaints, including assigned technician if there is one.
*/
require_once("view/header.php");
require_once("model/db_complaints.php");

$complaintList = getOpenComplaintsWithNames();
?>

<h2>Admin Open Complaints</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Customer</th>
        <th>Technician</th>
        <th>Product/Service</th>
        <th>Complaint Type</th>
        <th>Created</th>
        <th>Assign</th>
    </tr>

    <?php foreach ($complaintList as $complaintRow) { ?>
        <tr>
            <td><?php echo $complaintRow["complaint_id"]; ?></td>
            <td><?php echo $complaintRow["status"]; ?></td>
            <td><?php echo $complaintRow["customer_last_name"]; ?>, <?php echo $complaintRow["customer_first_name"]; ?></td>
            <td><?php echo $complaintRow["employee_last_name"]; ?><?php if ($complaintRow["employee_last_name"] != "") { ?>,<?php } ?> <?php echo $complaintRow["employee_first_name"]; ?></td>
            <td><?php echo $complaintRow["product_service_name"]; ?></td>
            <td><?php echo $complaintRow["complaint_type_name"]; ?></td>
            <td><?php echo $complaintRow["created_at"]; ?></td>
            <td><a href="index.php?action=admin_complaint_assign&complaint_id=<?php echo $complaintRow["complaint_id"]; ?>">Assign</a></td>
        </tr>
    <?php } ?>
</table>

<?php require_once("view/footer.php"); ?>
