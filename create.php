<!DOCTYPE html>
<html>
<head>
    <title>Create a Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
        <?php
        if($_POST) {
            include './database.php';
            try {
                $query = "INSERT INTO product SET ProductID=:ProductID, Name=:Name, Description=:Description, Price=:Price, QuantityInStock=:QuantityInStock";
                $stmt = $conn->prepare($query);
                $ProductID=htmlspecialchars( strip_tags( $_POST['ProductID']));
                $Name=htmlspecialchars(strip_tags($_POST['Name']));
                $Description=htmlspecialchars(strip_tags($_POST['Description']));
                $Price=htmlspecialchars(strip_tags($_POST['Price']));
                $QuantityInStock=htmlspecialchars(strip_tags($_POST['QuantityInStock']));
                $stmt->bindParam(':ProductID', $ProductID);
                $stmt->bindParam(':Name', $Name);
                $stmt->bindParam(':Description', $Description);
                $stmt->bindParam(':Price', $Price);
                $stmt->bindParam(':QuantityInStock', $QuantityInStock);
                if($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
            }
            catch(PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>ProductID</td>
                    <td><input type='number' name='ProductID' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='Name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='Description' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='number' name='Price' class='form-control' /></td>
                </tr>
                <tr>
                    <td>No. of Stock</td>
                    <td><input type='number' name='QuantityInStock' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='index.php' class='btn btn-danger'>Back to read products</a>
                </td>
            </table>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>