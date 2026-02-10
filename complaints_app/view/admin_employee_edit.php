<?php
// Admin Employee Edit.
// Page or helper used by the application.

/*
    Admin edit employee.

    User ID is add-only, so it shows but does not update.
*/
require_once("view/header.php");
require_once("model/db_employees.php");

$errorMessage = "";
$successMessage = "";

$employeeIdNumber = 0;
if (isset($_GET["employee_id"])) $employeeIdNumber = (int)$_GET["employee_id"];

$employeeRow = null;

if ($employeeIdNumber == 0) {
    $errorMessage = "Missing employee id.";
} else {
    $employeeRow = getEmployeeById($employeeIdNumber);
    if ($employeeRow == null) $errorMessage = "Employee not found.";
}

if ($errorMessage == "" && $_SERVER["REQUEST_METHOD"] == "POST") {

    $firstNameText = "";
    $lastNameText = "";
    $emailText = "";
    $phoneExtensionText = "";
    $levelText = "";

    if (isset($_POST["first_name"])) $firstNameText = $_POST["first_name"];
    if (isset($_POST["last_name"])) $lastNameText = $_POST["last_name"];
    if (isset($_POST["email"])) $emailText = $_POST["email"];
    if (isset($_POST["phone_extension"])) $phoneExtensionText = $_POST["phone_extension"];
    if (isset($_POST["level"])) $levelText = $_POST["level"];

    if ($firstNameText == "" || $lastNameText == "" || $emailText == "" || $levelText == "") {
        $errorMessage = "Please complete the required fields.";
    } else {

        $updateWorked = updateEmployee($employeeIdNumber, $firstNameText, $lastNameText, $emailText, $phoneExtensionText, $levelText);

        if ($updateWorked == true) {
            $successMessage = "Employee updated.";
            $employeeRow = getEmployeeById($employeeIdNumber);
        } else {
            $errorMessage = "Update failed.";
        }
    }
}
?>

<h2>Admin Employee Edit</h2>

<?php if ($errorMessage != "") { ?><p><?php echo $errorMessage; ?></p><?php } ?>
<?php if ($successMessage != "") { ?><p><?php echo $successMessage; ?></p><?php } ?>

<?php if ($errorMessage == "" && $employeeRow != null) { ?>

<form action="index.php?action=admin_employee_edit&employee_id=<?php echo $employeeIdNumber; ?>" method="post">

    <label>User ID</label><br>
    <input type="text" value="<?php echo $employeeRow["user_id"]; ?>" disabled>

    <br><br>

    <label>First Name</label><br>
    <input type="text" name="first_name" value="<?php echo $employeeRow["first_name"]; ?>">

    <br><br>

    <label>Last Name</label><br>
    <input type="text" name="last_name" value="<?php echo $employeeRow["last_name"]; ?>">

    <br><br>

    <label>Email</label><br>
    <input type="text" name="email" value="<?php echo $employeeRow["email"]; ?>">

    <br><br>

    <label>Phone Extension</label><br>
    <input type="text" name="phone_extension" value="<?php echo $employeeRow["phone_extension"]; ?>">

    <br><br>

    <label>Level</label><br>
    <select name="level">
        <option value="">Select</option>
        <option value="administrator" <?php if ($employeeRow["level"] == "administrator") echo "selected"; ?>>administrator</option>
        <option value="technician" <?php if ($employeeRow["level"] == "technician") echo "selected"; ?>>technician</option>
    </select>

    <br><br>

    <input type="submit" value="Update Employee">

</form>

<p><a href="index.php?action=admin_employee_list">Back to employee list</a></p>

<?php } ?>

<?php require_once("view/footer.php"); ?>
