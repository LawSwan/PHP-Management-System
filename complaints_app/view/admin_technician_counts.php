<?php
// Admin Technician Counts.
// Page or helper used by the application.

/*
    Admin technician counts.

    Shows each technician with a count of open complaints assigned to them.
*/
require_once("view/header.php");
require_once("model/db_complaints.php");

$countList = getTechnicianOpenComplaintCounts();
?>

<h2>Admin Technician Counts</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>Employee ID</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Open Complaints</th>
        <th>View</th>
    </tr>

    <?php foreach ($countList as $countRow) { ?>
        <tr>
            <td><?php echo $countRow["employee_id"]; ?></td>
            <td><?php echo $countRow["user_id"]; ?></td>
            <td><?php echo $countRow["last_name"]; ?>, <?php echo $countRow["first_name"]; ?></td>
            <td><?php echo $countRow["open_count"]; ?></td>
            <td><a href="index.php?action=technician_complaint_list&employee_id=<?php echo $countRow["employee_id"]; ?>">View List</a></td>
        </tr>
    <?php } ?>
</table>

<?php require_once("view/footer.php"); ?>
