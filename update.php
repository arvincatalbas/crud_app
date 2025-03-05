<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Update Product</h1>
        </div>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "crud_app";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ProductId = filter_input(INPUT_POST, 'ProductID', FILTER_SANITIZE_NUMBER_INT);
            $Name = htmlspecialchars($_POST['Name'], ENT_QUOTES, 'UTF-8');
            $Description = htmlspecialchars($_POST['Description'], ENT_QUOTES, 'UTF-8');
            $Price = filter_input(INPUT_POST, 'Price', FILTER_VALIDATE_FLOAT);
            $QuantityInStock = filter_input(INPUT_POST, 'QuantityInStock', FILTER_VALIDATE_INT);

            if ($ProductId && $Name && $Description && $Price >= 0 && $QuantityInStock >= 0) {
                try {
                    $query = "UPDATE product SET Name = ?, Description = ?, Price = ?, QuantityInStock = ? WHERE ProductID = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$Name, $Description, $Price, $QuantityInStock, $ProductId]);

                    echo "<div class='alert alert-success'>Product updated successfully!</div>";
                } catch (PDOException $e) {
                    error_log("Database Error: " . $e->getMessage(), 3, '/var/log/php_errors.log');
                    echo "<div class='alert alert-danger'>An error occurred. Please try again.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Invalid input. Please check your entries.</div>";
            }
        }
        ?>
        <form method="POST" action="update.php">
            <input type="hidden" name="ProductID" value="1">
            <div class="mb-3">
                <label for="Name" class="form-label">ProductID:</label>
                <input type="text" id="ProductID" name="ProductID" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="Name" class="form-label">Name:</label>
                <input type="text" id="Name" name="Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description:</label>
                <textarea id="Description" name="Description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Price" class="form-label">Price:</label>
                <input type="number" id="Price" name="Price" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="QuantityInStock" class="form-label">QuantityInStock:</label>
                <input type="number" id="QuantityInStock" name="QuantityInStock" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Product</button>
            <a href='index.php' class='btn btn-danger'>Back to read products</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>