<?php
// Admin employee list page.
// Shows all technicians and administrators.
// Uses db_employees.php to load the employee rows.

require_once("view/header.php");
require_once("model/db_employees.php");

// Pull all employee rows from the database.
$employeeList = getAllEmployees();
?>

<h2>Admin Employee List</h2>

<!-- Link to the add employee page -->
<p><a href="index.php?action=admin_employee_add">Add Employee</a></p>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Extension</th>
        <th>Level</th>
        <th>Action</th>
    </tr>

    <?php foreach ($employeeList as $employeeRow) { ?>
        <tr>

            <!-- Primary key -->
            <td><?php echo $employeeRow["employee_id"]; ?></td>

            <!-- Username used for login later -->
            <td><?php echo $employeeRow["user_id"]; ?></td>

            <!-- Last name, First name format -->
            <td><?php echo $employeeRow["last_name"]; ?>, <?php echo $employeeRow["first_name"]; ?></td>

            <!-- Work email -->
            <td><?php echo $employeeRow["email"]; ?></td>

            <!-- Extension number -->
            <td><?php echo $employeeRow["phone_extension"]; ?></td>

            <!-- administrator or technician -->
            <td><?php echo $employeeRow["level"]; ?></td>

            <!-- Edit link passes employee_id in the URL -->
            <td><a href="index.php?action=admin_employee_edit&employee_id=<?php echo $employeeRow["employee_id"]; ?>">Edit</a></td>

        </tr>
    <?php } ?>
</table>

<?php require_once("view/footer.php"); ?>
