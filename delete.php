<?php
// Include the database connection
include './database.php';

// Check if 'id' parameter is present in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productID = $_GET['id'];

    try {
        // Prepare the DELETE statement
        $query = "DELETE FROM product WHERE ProductID = :id";
        $stmt = $conn->prepare($query);

        // Bind the ID parameter to the query
        $stmt->bindParam(':id', $productID, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect back to the main page with success message
            header("Location: index.php?");
            exit();
        } else {
            // Handle failure to delete
            echo "<div class='alert alert-danger'>Unable to delete record.</div>";
        }
    } catch (PDOException $exception) {
        // Catch and display error
        echo "<div class='alert alert-danger'>Error: " . $exception->getMessage() . "</div>";
    }
} else {
    // Redirect if ID is missing or invalid
    header("Location: index.php?message=Invalid ID provided.");
    exit();
}
?>