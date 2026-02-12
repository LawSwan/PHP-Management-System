<?php
/**
 * Database Connection Class
 *
 * WHY A CLASS INSTEAD OF A GLOBAL VARIABLE?
 *
 * BEFORE (Procedural):
 *   $databaseConnection = mysqli_connect(...);  // Global variable floating around
 *
 *   function someFunction() {
 *       global $databaseConnection;  // Must grab it in every function
 *       mysqli_query($databaseConnection, $sql);
 *   }
 *
 * AFTER (OOP):
 *   $db = new Database();        // Create ONE object
 *   $db->getConnection();        // Connection is INSIDE the object, protected
 *
 * BENEFITS:
 * 1. Connection details are PRIVATE - other code can't accidentally change them
 * 2. One place to change settings (not scattered across files)
 * 3. Can add features like connection pooling, logging, etc. in ONE place
 * 4. Testable - can swap in a test database easily
 */

class Database {
    // These are PRIVATE - only this class can see them
    private string $host = "localhost";
    private string $username = "root";
    private string $password = "velocity2026";
    private string $database = "velocitynet_db";

    // The actual connection - also private (protected from outside code)
    private ?mysqli $connection = null;

    /**
     * Constructor - runs automatically when you do: new Database()
     */
    public function __construct() {
        $this->connect();
    }

    /**
     * Create the database connection
     */
    private function connect(): void {
        $this->connection = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($this->connection === false) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    /**
     * Get the connection (for running queries)
     * This is the ONLY way outside code can access the connection
     */
    public function getConnection(): mysqli {
        return $this->connection;
    }

    /**
     * Close the connection when we're done
     * Called automatically when the object is destroyed
     */
    public function __destruct() {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}

/*
 * USAGE EXAMPLE:
 *
 * // Create the database object
 * $db = new Database();
 *
 * // Get the connection to run queries
 * $conn = $db->getConnection();
 *
 * // Now use it
 * $result = mysqli_query($conn, "SELECT * FROM customer");
 */
