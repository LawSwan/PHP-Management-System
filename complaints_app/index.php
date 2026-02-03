<?php
// VelocityNet complaints homepage.
// Acts as the main router for the site.
// Uses the action value in the URL to decide what page to load.
// Example: index.php?action=admin_employee_list

$action = "";

// If action is missing, treat it as homepage.
if (isset($_GET["action"])) $action = $_GET["action"];

// Homepage when there is no action.
if ($action == "") {

    // Header and footer keep the same look across pages.
    require_once("view/header.php");
    ?>

    <table width="100%" cellpadding="8">
        <tr>
            <td width="220" valign="top">
                <h3>Navigation</h3>

                <!-- Simple placeholder site map link -->
                <p><a href="index.php?action=sitemap">Site Map Placeholder</a></p>

                <p>
                    <!-- Customer pages -->
                    <a href="index.php?action=login">Login</a><br>
                    <a href="index.php?action=register">Register</a><br>
                    <a href="index.php?action=enter_complaint">Enter Complaint</a><br>
                    <a href="index.php?action=complaint_list">Complaint List</a>
                </p>

                <p>
                    <!-- Admin pages -->
                    <b>Admin</b><br>
                    <a href="index.php?action=admin_customer_list">Customers</a><br>
                    <a href="index.php?action=admin_employee_list">Employees</a><br>
                    <a href="index.php?action=admin_complaint_open_list">Open Complaints</a><br>
                    <a href="index.php?action=admin_complaint_unassigned_list">Unassigned Complaints</a><br>
                    <a href="index.php?action=admin_technician_counts">Technician Counts</a><br>
                    <a href="index.php?action=admin_complaint_assign">Assign Complaint</a>
                </p>

                <p>
                    <!-- Technician pages -->
                    <b>Technician</b><br>

                    <!-- Using employee_id in the URL since login is not built yet -->
                    <a href="index.php?action=technician_complaint_list&employee_id=1">My Complaints (id 1)</a>
                </p>
            </td>

            <td valign="top">
                <h2>Home</h2>
                <p>This is the homepage for VelocityNet complaints.</p>

                <p>
                    The links on the left are just a simple way to reach each page.
                    Later on, login decides which links show up.
                </p>
            </td>
        </tr>
    </table>

    <?php
    require_once("view/footer.php");
    exit;
}

// Site map page.
if ($action == "sitemap") { require_once("view/sitemap.php"); exit; }

// Public pages.
if ($action == "login") { require_once("view/login.php"); exit; }
if ($action == "register") { require_once("controller/register_controller.php"); exit; }

// Customer pages.
if ($action == "enter_complaint") { require_once("controller/customer_controller.php"); exit; }

if ($action == "complaint_list") {
    // Pull complaint rows and send them into the view.
    require_once("model/db_complaints.php");
    $complaintList = getAllComplaintsWithNames();
    require_once("view/complaint_list.php");
    exit;
}

// Technician pages.
if ($action == "technician_complaint_list") { require_once("view/technician_complaint_list.php"); exit; }
if ($action == "technician_complaint_update") { require_once("view/technician_complaint_update.php"); exit; }
if ($action == "technician_password_change") { require_once("view/technician_password_change.php"); exit; }

// Admin customer pages.
if ($action == "admin_customer_list") { require_once("view/admin_customer_list.php"); exit; }
if ($action == "admin_customer_edit") { require_once("view/admin_customer_edit.php"); exit; }

// Admin employee pages.
if ($action == "admin_employee_list") { require_once("view/admin_employee_list.php"); exit; }
if ($action == "admin_employee_add") { require_once("view/admin_employee_add.php"); exit; }
if ($action == "admin_employee_edit") { require_once("view/admin_employee_edit.php"); exit; }

// Admin complaint pages.
if ($action == "admin_complaint_open_list") { require_once("view/admin_complaint_open_list.php"); exit; }
if ($action == "admin_complaint_unassigned_list") { require_once("view/admin_complaint_unassigned_list.php"); exit; }
if ($action == "admin_technician_counts") { require_once("view/admin_technician_counts.php"); exit; }
if ($action == "admin_complaint_assign") { require_once("view/admin_complaint_assign.php"); exit; }

// Unknown action. Send back to homepage.
header("Location: index.php");
exit;
