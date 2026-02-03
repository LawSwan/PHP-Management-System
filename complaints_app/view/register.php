<?php
// Registration page.
// Customer can create a row in the customer table.
// Required fields are email, first name, last name, and password.

require_once("view/header.php");
?>

<h2>Register</h2>

<?php if (isset($errorMessage) && $errorMessage != "") { ?>
    <!-- Show validation or insert errors -->
    <p><?php echo $errorMessage; ?></p>
<?php } ?>

<?php if (isset($successMessage) && $successMessage != "") { ?>
    <!-- Show success message after insert -->
    <p><?php echo $successMessage; ?></p>
<?php } ?>

<form action="index.php?action=register" method="post">

    <!-- Email is used later for customer login -->
    <label>Email Address *</label><br>
    <input type="text" name="email">

    <br><br>

    <label>First Name *</label><br>
    <input type="text" name="first_name">

    <br><br>

    <label>Last Name *</label><br>
    <input type="text" name="last_name">

    <br><br>

    <label>Street Address</label><br>
    <input type="text" name="street_address">

    <br><br>

    <label>City</label><br>
    <input type="text" name="city">

    <br><br>

    <label>State</label><br>
    <input type="text" name="state">

    <br><br>

    <label>Zip Code</label><br>
    <input type="text" name="zip_code">

    <br><br>

    <label>Phone Number</label><br>
    <input type="text" name="phone_number">

    <br><br>

    <!-- Stored plain text for now since hashing is not covered yet -->
    <label>Password *</label><br>
    <input type="text" name="customer_password">

    <br><br>

    <input type="submit" value="Create Account">

</form>

<?php require_once("view/footer.php"); ?>
