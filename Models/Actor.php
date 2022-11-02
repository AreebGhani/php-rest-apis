<?php

class Actor
{
    // DB Stuff
    private $connection;
    private $table = "actor";

    // Actor Properties
    public $actor_id;
    public $first_name;
    public $last_name;
    public $last_update;

    // Connection with DB
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // Get Actors
    public function read()
    {
        // Create Query
        $query = "SELECT * from $this->table";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Execute  Query
        $stmt->execute();

        return $stmt;
    }

    // Find Actor
    public function find()
    {
        // Create Query
        $query = "SELECT * from $this->table WHERE actor_id = ?";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->actor_id);

        // Execute  Query
        $stmt->execute();

        // Fetching
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set Properties
        $this->first_name = $row["first_name"];
        $this->last_name = $row["last_name"];
        $this->last_update = $row["last_update"];
    }

    // Create Actor
    public function create()
    {
        // Create Query
        $query = "INSERT INTO $this->table SET first_name = :first_name, last_name = :last_name";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->first_name = htmlspecialchars((strip_tags($this->first_name)));
        $this->last_name = htmlspecialchars((strip_tags($this->last_name)));

        // Bind Data
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    // Update Actor
    public function update()
    {
        // Update Query
        $query = "UPDATE $this->table SET first_name = :first_name, last_name = :last_name WHERE actor_id = :actor_id";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->actor_id = htmlspecialchars((strip_tags($this->actor_id)));
        $this->first_name = htmlspecialchars((strip_tags($this->first_name)));
        $this->last_name = htmlspecialchars((strip_tags($this->last_name)));

        // Bind Data
        $stmt->bindParam(":actor_id", $this->actor_id);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    // Delete Actor
    public function delete()
    {
        // Delete Query
        $query = "DELETE FROM $this->table WHERE actor_id = :actor_id";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->actor_id = htmlspecialchars((strip_tags($this->actor_id)));

        // Bind Data
        $stmt->bindParam(":actor_id", $this->actor_id);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }
}
