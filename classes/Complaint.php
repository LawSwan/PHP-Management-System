<?php
require_once __DIR__ . '/Database.php';

/**
 * Complaint Class - Represents ONE row from the 'complaints' table
 *
 * This is the main transaction table - customers submit complaints,
 * admins assign them to technicians, technicians resolve them.
 */

class Complaint {
    // Core properties
    public ?int $complaintId = null;
    public ?int $customerId = null;
    public ?int $employeeId = null;         // Assigned technician (null = unassigned)
    public ?int $productServiceId = null;
    public ?int $complaintTypeId = null;
    public string $description = "";
    public string $status = "open";          // "open" or "closed"
    public string $technicianNotes = "";
    public string $resolutionDate = "";
    public string $resolutionNotes = "";
    public ?string $createdAt = null;

    // Joined data (populated by findAllWithNames, etc.)
    public string $customerFirstName = "";
    public string $customerLastName = "";
    public string $employeeFirstName = "";
    public string $employeeLastName = "";
    public string $productServiceName = "";
    public string $complaintTypeName = "";

    private static ?Database $db = null;

    private static function getDb(): mysqli {
        if (self::$db === null) {
            self::$db = new Database();
        }
        return self::$db->getConnection();
    }

    // ==================== CRUD OPERATIONS ====================

    /**
     * CREATE - Submit a new complaint
     */
    public function save(): bool {
        $conn = self::getDb();

        $sql = "INSERT INTO complaints
                (customer_id, product_service_id, complaint_type_id, description, status)
                VALUES (?, ?, ?, ?, 'open')";

        $statement = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "iiis",
            $this->customerId,
            $this->productServiceId,
            $this->complaintTypeId,
            $this->description
        );

        $result = mysqli_stmt_execute($statement);

        if ($result) {
            $this->complaintId = mysqli_insert_id($conn);
            $this->status = "open";
        }

        return $result;
    }

    /**
     * READ (one) - Find complaint by ID
     */
    public static function findById(int $id): ?Complaint {
        $conn = self::getDb();

        $sql = "SELECT complaint_id, customer_id, employee_id, product_service_id,
                       complaint_type_id, description, status, technician_notes,
                       resolution_notes, resolution_date, created_at
                FROM complaints
                WHERE complaint_id = ?";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_assoc($result);

        if ($row === null) {
            return null;
        }

        return self::fromArray($row);
    }

    /**
     * READ (all) - Get all complaints with joined names
     */
    public static function findAllWithNames(): array {
        $conn = self::getDb();

        $sql = "SELECT c.complaint_id, c.status, c.description, c.created_at,
                       c.customer_id, c.employee_id, c.product_service_id, c.complaint_type_id,
                       c.technician_notes, c.resolution_notes, c.resolution_date,
                       cu.first_name as customer_first_name,
                       cu.last_name as customer_last_name,
                       e.first_name as employee_first_name,
                       e.last_name as employee_last_name,
                       ps.product_service_name,
                       ct.complaint_type_name
                FROM complaints c
                LEFT JOIN customer cu ON c.customer_id = cu.customer_id
                LEFT JOIN employees e ON c.employee_id = e.employee_id
                LEFT JOIN products_services ps ON c.product_service_id = ps.product_service_id
                LEFT JOIN complaint_types ct ON c.complaint_type_id = ct.complaint_type_id
                ORDER BY c.created_at DESC";

        $result = mysqli_query($conn, $sql);

        $complaints = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $complaints[] = self::fromArrayWithNames($row);
        }

        return $complaints;
    }

    /**
     * Get only open complaints
     */
    public static function findOpenWithNames(): array {
        $conn = self::getDb();

        $sql = "SELECT c.complaint_id, c.status, c.description, c.created_at,
                       c.customer_id, c.employee_id, c.product_service_id, c.complaint_type_id,
                       cu.first_name as customer_first_name,
                       cu.last_name as customer_last_name,
                       e.first_name as employee_first_name,
                       e.last_name as employee_last_name,
                       ps.product_service_name,
                       ct.complaint_type_name
                FROM complaints c
                LEFT JOIN customer cu ON c.customer_id = cu.customer_id
                LEFT JOIN employees e ON c.employee_id = e.employee_id
                LEFT JOIN products_services ps ON c.product_service_id = ps.product_service_id
                LEFT JOIN complaint_types ct ON c.complaint_type_id = ct.complaint_type_id
                WHERE c.status = 'open'
                ORDER BY c.created_at DESC";

        $result = mysqli_query($conn, $sql);

        $complaints = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $complaints[] = self::fromArrayWithNames($row);
        }

        return $complaints;
    }

    /**
     * Get unassigned open complaints (for admin to assign)
     */
    public static function findUnassignedOpen(): array {
        $conn = self::getDb();

        $sql = "SELECT c.complaint_id, c.status, c.description, c.created_at,
                       c.customer_id, c.product_service_id, c.complaint_type_id,
                       cu.first_name as customer_first_name,
                       cu.last_name as customer_last_name,
                       ps.product_service_name,
                       ct.complaint_type_name
                FROM complaints c
                LEFT JOIN customer cu ON c.customer_id = cu.customer_id
                LEFT JOIN products_services ps ON c.product_service_id = ps.product_service_id
                LEFT JOIN complaint_types ct ON c.complaint_type_id = ct.complaint_type_id
                WHERE c.status = 'open' AND c.employee_id IS NULL
                ORDER BY c.created_at DESC";

        $result = mysqli_query($conn, $sql);

        $complaints = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $complaints[] = self::fromArrayWithNames($row);
        }

        return $complaints;
    }

    /**
     * Get complaints assigned to a specific technician
     */
    public static function findByEmployeeId(int $employeeId): array {
        $conn = self::getDb();

        $sql = "SELECT c.complaint_id, c.status, c.description, c.created_at,
                       c.customer_id, c.employee_id, c.product_service_id, c.complaint_type_id,
                       cu.first_name as customer_first_name,
                       cu.last_name as customer_last_name,
                       ps.product_service_name,
                       ct.complaint_type_name
                FROM complaints c
                LEFT JOIN customer cu ON c.customer_id = cu.customer_id
                LEFT JOIN products_services ps ON c.product_service_id = ps.product_service_id
                LEFT JOIN complaint_types ct ON c.complaint_type_id = ct.complaint_type_id
                WHERE c.employee_id = ?
                ORDER BY c.created_at DESC";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "i", $employeeId);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $complaints = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $complaints[] = self::fromArrayWithNames($row);
        }

        return $complaints;
    }

    /**
     * UPDATE - Assign complaint to a technician
     */
    public function assignTo(int $employeeId): bool {
        $conn = self::getDb();

        $sql = "UPDATE complaints SET employee_id = ? WHERE complaint_id = ?";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "ii", $employeeId, $this->complaintId);

        $result = mysqli_stmt_execute($statement);

        if ($result) {
            $this->employeeId = $employeeId;
        }

        return $result;
    }

    /**
     * UPDATE - Technician updates their fields
     */
    public function updateTechnicianFields(): bool {
        $conn = self::getDb();

        $sql = "UPDATE complaints
                SET technician_notes = ?, status = ?,
                    resolution_date = ?, resolution_notes = ?
                WHERE complaint_id = ?";

        $statement = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "ssssi",
            $this->technicianNotes,
            $this->status,
            $this->resolutionDate,
            $this->resolutionNotes,
            $this->complaintId
        );

        return mysqli_stmt_execute($statement);
    }

    /**
     * DELETE - Remove complaint
     */
    public function delete(): bool {
        $conn = self::getDb();

        $sql = "DELETE FROM complaints WHERE complaint_id = ?";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "i", $this->complaintId);

        return mysqli_stmt_execute($statement);
    }

    // ==================== REPORTS ====================

    /**
     * Get open complaint counts per technician (admin report)
     */
    public static function getTechnicianOpenCounts(): array {
        $conn = self::getDb();

        $sql = "SELECT e.employee_id, e.user_id, e.first_name, e.last_name,
                       COUNT(c.complaint_id) as open_count
                FROM employees e
                LEFT JOIN complaints c ON e.employee_id = c.employee_id AND c.status = 'open'
                WHERE e.level = 'technician'
                GROUP BY e.employee_id, e.user_id, e.first_name, e.last_name
                ORDER BY e.last_name, e.first_name";

        $result = mysqli_query($conn, $sql);

        $counts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $counts[] = $row;  // Return as array since it's a report, not complaint objects
        }

        return $counts;
    }

    // ==================== HELPER METHODS ====================

    public function getCustomerFullName(): string {
        return $this->customerFirstName . " " . $this->customerLastName;
    }

    public function getTechnicianFullName(): string {
        if (empty($this->employeeFirstName)) {
            return "Unassigned";
        }
        return $this->employeeFirstName . " " . $this->employeeLastName;
    }

    public function isOpen(): bool {
        return $this->status === "open";
    }

    public function isClosed(): bool {
        return $this->status === "closed";
    }

    public function isAssigned(): bool {
        return $this->employeeId !== null;
    }

    private static function fromArray(array $row): Complaint {
        $complaint = new Complaint();
        $complaint->complaintId = (int) $row["complaint_id"];
        $complaint->customerId = isset($row["customer_id"]) ? (int) $row["customer_id"] : null;
        $complaint->employeeId = isset($row["employee_id"]) ? (int) $row["employee_id"] : null;
        $complaint->productServiceId = isset($row["product_service_id"]) ? (int) $row["product_service_id"] : null;
        $complaint->complaintTypeId = isset($row["complaint_type_id"]) ? (int) $row["complaint_type_id"] : null;
        $complaint->description = $row["description"] ?? "";
        $complaint->status = $row["status"] ?? "open";
        $complaint->technicianNotes = $row["technician_notes"] ?? "";
        $complaint->resolutionDate = $row["resolution_date"] ?? "";
        $complaint->resolutionNotes = $row["resolution_notes"] ?? "";
        $complaint->createdAt = $row["created_at"] ?? null;
        return $complaint;
    }

    private static function fromArrayWithNames(array $row): Complaint {
        $complaint = self::fromArray($row);
        $complaint->customerFirstName = $row["customer_first_name"] ?? "";
        $complaint->customerLastName = $row["customer_last_name"] ?? "";
        $complaint->employeeFirstName = $row["employee_first_name"] ?? "";
        $complaint->employeeLastName = $row["employee_last_name"] ?? "";
        $complaint->productServiceName = $row["product_service_name"] ?? "";
        $complaint->complaintTypeName = $row["complaint_type_name"] ?? "";
        return $complaint;
    }
}
