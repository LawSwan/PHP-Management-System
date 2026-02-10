<?php
// Technician complaint list.
// Uses employee_id in the URL instead of a real login session.
// Example URL:
// index.php?action=technician_complaint_list&employee_id=1

require_once("view/header.php");
require_once("model/db_complaints.php");

// Pull employee_id from the URL.
$employeeIdNumber = 0;
if (isset($_GET["employee_id"])) $employeeIdNumber = (int)$_GET["employee_id"];
?>

<h2>Technician Complaint List</h2>

<?php if ($employeeIdNumber == 0) { ?>

    <!-- No employee_id means we don't know which technician to display -->
    <p>Missing employee id.</p>

<?php } else { ?>

    <?php
    // Get complaints assigned to this technician.
    $complaintList = getComplaintsByEmployeeIdWithNames($employeeIdNumber);
    ?>

    <p>Viewing complaints assigned to technician id: <?php echo $employeeIdNumber; ?></p>

    <?php if (count($complaintList) == 0) { ?>

        <!-- No complaints assigned -->
        <p>No complaints assigned.</p>

    <?php } else { ?>

        <table border="1" cellpadding="6">
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Product/Service</th>
                <th>Complaint Type</th>
                <th>Created</th>
                <th>Action</th>
            </tr>

            <?php foreach ($complaintList as $complaintRow) { ?>
                <tr>
                    <td><?php echo $complaintRow["complaint_id"]; ?></td>
                    <td><?php echo $complaintRow["status"]; ?></td>
                    <td><?php echo $complaintRow["customer_last_name"]; ?>, <?php echo $complaintRow["customer_first_name"]; ?></td>
                    <td><?php echo $complaintRow["product_service_name"]; ?></td>
                    <td><?php echo $complaintRow["complaint_type_name"]; ?></td>
                    <td><?php echo $complaintRow["created_at"]; ?></td>

                    <!-- Link to update page and pass complaint_id + employee_id -->
                    <td>
                        <a href="index.php?action=technician_complaint_update&complaint_id=<?php echo $complaintRow["complaint_id"]; ?>&employee_id=<?php echo $employeeIdNumber; ?>">Update</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    <?php } ?>

<?php } ?>

<?php require_once("view/footer.php"); ?>
