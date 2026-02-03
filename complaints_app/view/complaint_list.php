<?php
// Complaint list page.
// Shows every complaint currently in the database.
// Data is loaded before this page runs and stored in $complaintList.

require_once("view/header.php");
?>

<h2>Complaint List</h2>

<!-- Table headers -->
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Customer</th>
        <th>Technician</th>
        <th>Product/Service</th>
        <th>Complaint Type</th>
        <th>Description</th>
        <th>Created</th>
    </tr>

    <?php foreach ($complaintList as $complaintRow) { ?>
        <tr>

            <!-- Complaint ID from complaints.complaint_id -->
            <td><?php echo $complaintRow["complaint_id"]; ?></td>

            <!-- Status column is either open or closed -->
            <td><?php echo $complaintRow["status"]; ?></td>

            <!-- Customer name from the customer table -->
            <td><?php echo $complaintRow["customer_last_name"]; ?>, <?php echo $complaintRow["customer_first_name"]; ?></td>

            <!-- Technician name might be blank if unassigned -->
            <td>
                <?php echo $complaintRow["employee_last_name"]; ?>
                <?php if ($complaintRow["employee_last_name"] != "") { ?>,<?php } ?>
                <?php echo $complaintRow["employee_first_name"]; ?>
            </td>

            <!-- Lookup names from the products_services and complaint_types tables -->
            <td><?php echo $complaintRow["product_service_name"]; ?></td>
            <td><?php echo $complaintRow["complaint_type_name"]; ?></td>

            <!-- Complaint description typed by the customer -->
            <td><?php echo $complaintRow["description"]; ?></td>

            <!-- Auto timestamp -->
            <td><?php echo $complaintRow["created_at"]; ?></td>

        </tr>
    <?php } ?>
</table>

<?php require_once("view/footer.php"); ?>
