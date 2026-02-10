<?php
/**
 * Database Connection Test
 * Run this file to verify the OOP classes work with your database.
 *
 * Usage: php test_connection.php
 */

require_once __DIR__ . '/classes/Customer.php';
require_once __DIR__ . '/classes/Employee.php';
require_once __DIR__ . '/classes/Complaint.php';

echo "=== DATABASE CONNECTION TEST ===\n\n";

// Test 1: Database Connection
echo "1. Testing Database Connection... ";
try {
    $db = new Database();
    echo "OK\n";
} catch (Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    exit(1);
}

// Test 2: Read Customers
echo "2. Reading Customers... ";
$customers = Customer::findAll();
echo "Found " . count($customers) . " customers\n";

if (count($customers) > 0) {
    echo "   First customer: " . $customers[0]->getFullName() . "\n";
}

// Test 3: Read Employees
echo "3. Reading Employees... ";
$employees = Employee::findAll();
echo "Found " . count($employees) . " employees\n";

if (count($employees) > 0) {
    echo "   First employee: " . $employees[0]->getFullName() . " (" . $employees[0]->level . ")\n";
}

// Test 4: Read Complaints
echo "4. Reading Complaints... ";
$complaints = Complaint::findAllWithNames();
echo "Found " . count($complaints) . " complaints\n";

if (count($complaints) > 0) {
    $c = $complaints[0];
    echo "   Latest: " . $c->complaintTypeName . " - " . $c->getCustomerFullName() . "\n";
}

// Test 5: Read Technicians
echo "5. Reading Technicians... ";
$technicians = Employee::findAllTechnicians();
echo "Found " . count($technicians) . " technicians\n";

echo "\n=== ALL TESTS PASSED ===\n";
