<?php
// Admin Customer Edit.
// Page or helper used by the application.

/*
    Admin customer edit.

    Updates customer info.
*/
require_once("view/header.php");
require_once("model/db_customers.php");

$errorMessage = "";
$successMessage = "";

$customerIdNumber = 0;
if (isset($_GET["customer_id"])) $customerIdNumber = (int)$_GET["customer_id"];

$customerRow = null;

if ($customerIdNumber == 0) {
    $errorMessage = "Missing customer id.";
} else {
    $customerRow = getCustomerById($customerIdNumber);
    if ($customerRow == null) $errorMessage = "Customer not found.";
}

if ($errorMessage == "" && $_SERVER["REQUEST_METHOD"] == "POST") {

    $emailText = "";
    $firstNameText = "";
    $lastNameText = "";
    $streetAddressText = "";
    $cityText = "";
    $stateText = "";
    $zipCodeText = "";
    $phoneNumberText = "";

    if (isset($_POST["email"])) $emailText = $_POST["email"];
    if (isset($_POST["first_name"])) $firstNameText = $_POST["first_name"];
    if (isset($_POST["last_name"])) $lastNameText = $_POST["last_name"];
    if (isset($_POST["street_address"])) $streetAddressText = $_POST["street_address"];
    if (isset($_POST["city"])) $cityText = $_POST["city"];
    if (isset($_POST["state"])) $stateText = $_POST["state"];
    if (isset($_POST["zip_code"])) $zipCodeText = $_POST["zip_code"];
    if (isset($_POST["phone_number"])) $phoneNumberText = $_POST["phone_number"];

    if ($emailText == "" || $firstNameText == "" || $lastNameText == "") {
        $errorMessage = "Please complete the required fields.";
    } else {

        $updateWorked = updateCustomer($customerIdNumber, $emailText, $firstNameText, $lastNameText, $streetAddressText, $cityText, $stateText, $zipCodeText, $phoneNumberText);

        if ($updateWorked == true) {
            $successMessage = "Customer updated.";
            $customerRow = getCustomerById($customerIdNumber);
        } else {
            $errorMessage = "Update failed.";
        }
    }
}
?>

<h2>Admin Customer Edit</h2>

<?php if ($errorMessage != "") { ?><p><?php echo $errorMessage; ?></p><?php } ?>
<?php if ($successMessage != "") { ?><p><?php echo $successMessage; ?></p><?php } ?>

<?php if ($errorMessage == "" && $customerRow != null) { ?>

<form action="index.php?action=admin_customer_edit&customer_id=<?php echo $customerIdNumber; ?>" method="post">

    <label>Email</label><br>
    <input type="text" name="email" value="<?php echo $customerRow["email"]; ?>">

    <br><br>

    <label>First Name</label><br>
    <input type="text" name="first_name" value="<?php echo $customerRow["first_name"]; ?>">

    <br><br>

    <label>Last Name</label><br>
    <input type="text" name="last_name" value="<?php echo $customerRow["last_name"]; ?>">

    <br><br>

    <label>Street Address</label><br>
    <input type="text" name="street_address" value="<?php echo $customerRow["street_address"]; ?>">

    <br><br>

    <label>City</label><br>
    <input type="text" name="city" value="<?php echo $customerRow["city"]; ?>">

    <br><br>

    <label>State</label><br>
    <input type="text" name="state" value="<?php echo $customerRow["state"]; ?>">

    <br><br>

    <label>Zip Code</label><br>
    <input type="text" name="zip_code" value="<?php echo $customerRow["zip_code"]; ?>">

    <br><br>

    <label>Phone Number</label><br>
    <input type="text" name="phone_number" value="<?php echo $customerRow["phone_number"]; ?>">

    <br><br>

    <input type="submit" value="Update Customer">

</form>

<p><a href="index.php?action=admin_customer_list">Back to customer list</a></p>

<?php } ?>

<?php require_once("view/footer.php"); ?>
