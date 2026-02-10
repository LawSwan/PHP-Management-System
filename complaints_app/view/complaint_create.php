<?php
// Complaint entry page.
// Customer uses this form to create a new complaint.
// Dropdown data comes from $productServiceList and $complaintTypeList.
// Messages come from $errorMessage and $successMessage.

require_once("view/header.php");
?>

<h2>Enter a Complaint</h2>

<?php if ($errorMessage != "") { ?>
    <!-- Show validation error if something was left blank -->
    <p><?php echo $errorMessage; ?></p>
<?php } ?>

<?php if ($successMessage != "") { ?>
    <!-- Show success message after insert -->
    <p><?php echo $successMessage; ?></p>
<?php } ?>

<form action="index.php?action=enter_complaint" method="post">

    <label>Product/Service</label><br>

    <!-- value is product_service_id so the controller can insert the correct id -->
    <select name="product_service_id">
        <option value="0">Select</option>

        <?php foreach ($productServiceList as $productServiceRow) { ?>
            <option value="<?php echo $productServiceRow["product_service_id"]; ?>">
                <?php echo $productServiceRow["product_service_name"]; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Complaint Type</label><br>

    <select name="complaint_type_id">
        <option value="0">Select</option>

        <?php foreach ($complaintTypeList as $complaintTypeRow) { ?>
            <option value="<?php echo $complaintTypeRow["complaint_type_id"]; ?>">
                <?php echo $complaintTypeRow["complaint_type_name"]; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Description</label><br>

    <!-- typed description is stored in complaints.description -->
    <textarea name="description" rows="6" cols="50"></textarea>

    <br><br>

    <input type="submit" value="Submit Complaint">

</form>

<?php require_once("view/footer.php"); ?>
