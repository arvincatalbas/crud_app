<!DOCTYPE html>
<html>
<head>
    <title>Read Products Details - PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Product Item</h1>
        </div>
        <?php
        include './database.php';

        // Check if 'id' parameter is present in the URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $productID = $_GET['id'];

            try {
                // Prepare the SELECT statement
                $query = "SELECT * FROM product WHERE ProductID = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $productID, PDO::PARAM_INT);
                $stmt->execute();

                // Fetch the product details
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Check if a product was found
                if ($row) {
                    echo "<table class='table table-hover table-responsive table-bordered'>";
                    echo "<tr><td>ProductId</td><td>{$row['ProductID']}</td></tr>";
                    echo "<tr><td>Name</td><td>{$row['Name']}</td></tr>";
                    echo "<tr><td>Description</td><td>{$row['Description']}</td></tr>";
                    echo "<tr><td>Price</td><td>{$row['Price']}</td></tr>";
                    echo "<tr><td>QuantityInStock</td><td>{$row['QuantityInStock']}</td></tr>";
                    echo "</table>";
                } else {
                    echo "<div class='alert alert-danger'>Product not found.</div>";
                }
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid ID provided.</div>";
        }
        ?>
        <a href='index.php' class='btn btn-danger'>Back</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>