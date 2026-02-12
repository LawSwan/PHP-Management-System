<?php
// Admin assign complaint page.
// Picks an unassigned open complaint, then assigns it to a technician.
// This updates complaints.employee_id.

require_once("view/header.php");
require_once("model/db_lists.php");
require_once("model/db_complaints.php");

// Used to show messages on the page.
$errorMessage = "";
$successMessage = "";

// Get unassigned open complaints for the dropdown.
$complaintList = getUnassignedOpenComplaintsWithNames();

// Get technician list for the dropdown.
$technicianList = getAllTechnicians();

// If complaint_id is passed in the URL, we pre-select it.
$selectedComplaintIdNumber = 0;
if (isset($_GET["complaint_id"])) $selectedComplaintIdNumber = (int)$_GET["complaint_id"];

// Only assign when the form is submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $complaintIdNumber = 0;
    $employeeIdNumber = 0;

    // Read the dropdown selected values.
    if (isset($_POST["complaint_id"])) $complaintIdNumber = (int)$_POST["complaint_id"];
    if (isset($_POST["employee_id"])) $employeeIdNumber = (int)$_POST["employee_id"];

    // Validate both dropdowns.
    if ($complaintIdNumber == 0 || $employeeIdNumber == 0) {

        $errorMessage = "Please select a complaint and a technician.";

    } else {

        // Run update query to set complaints.employee_id.
        $assignWorked = assignComplaintToTechnician($complaintIdNumber, $employeeIdNumber);

        if ($assignWorked == true) {

            $successMessage = "Complaint assigned.";

            // Refresh dropdown list so the assigned complaint disappears.
            $complaintList = getUnassignedOpenComplaintsWithNames();

        } else {

            $errorMessage = "Assignment failed.";

        }
    }
}
?>

<h2>Admin Assign Complaint</h2>

<?php if ($errorMessage != "") { ?><p><?php echo $errorMessage; ?></p><?php } ?>
<?php if ($successMessage != "") { ?><p><?php echo $successMessage; ?></p><?php } ?>

<?php if (count($complaintList) == 0) { ?>

    <p>No unassigned open complaints.</p>

<?php } else { ?>

<form action="index.php?action=admin_complaint_assign" method="post">

    <label>Unassigned Open Complaint</label><br>
    <select name="complaint_id">
        <option value="0">Select</option>

        <?php foreach ($complaintList as $complaintRow) { ?>

            <?php
            // Pre-select complaint if complaint_id is passed in URL.
            $isSelectedText = "";
            if ($selectedComplaintIdNumber != 0 && $complaintRow["complaint_id"] == $selectedComplaintIdNumber) {
                $isSelectedText = "selected";
            }
            ?>

            <option value="<?php echo $complaintRow["complaint_id"]; ?>" <?php echo $isSelectedText; ?>>
                <?php echo $complaintRow["complaint_id"]; ?> - <?php echo $complaintRow["customer_last_name"]; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Technician</label><br>
    <select name="employee_id">
        <option value="0">Select</option>

        <?php foreach ($technicianList as $technicianRow) { ?>
            <option value="<?php echo $technicianRow["employee_id"]; ?>">
                <?php echo $technicianRow["last_name"]; ?>, <?php echo $technicianRow["first_name"]; ?> (<?php echo $technicianRow["user_id"]; ?>)
            </option>
        <?php } ?>
    </select>

    <br><br>

    <input type="submit" value="Assign Complaint">

</form>

<?php } ?>

<?php require_once("view/footer.php"); ?>
