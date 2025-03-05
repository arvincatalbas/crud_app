<!DOCTYPE html>
<html>

<head>
  <title>Read Records</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .m-r-1em {
      margin-right: 1em;
    }

    .m-b-1em {
      margin-bottom: 1em;
    }

    .m-l-1em {
      margin-left: 1em;
    }

    .mt0 {
      margin-top: 0;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Helvetica, sans-serif;
      color: #000;
    }

    .container {
      margin-top: 50px;
      position: relative;
      /* text-align: center; */
      border: 1px solid black;
      border-radius: 10px;
    }

    .page-header {
      margin-top: 0;
      margin-right: 0;
      margin-left: 0;
      display: flex;
      /* justify-content: center; */
      /* background: red; */
      width: 100%;
      padding-top: 5px;

    }

    .page-header i {
      font-size: 45px;
      margin-right: 10px;
    }

    .page-header h1 {
      font-weight: bold;
      font-size: 40px;
      margin: 0;
    }

    .container a {
      font-size: 18px;
      cursor: pointer;
    }

    .container a:hover {
      transform: scale(1.1);
      transition: 0.2s ease;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    if (isset($_GET['message'])) {
      echo "<div class='alert alert-success'>{$_GET['message']}</div>";
    }
    ?>
    <div class="page-header">
      <i class='bx bxs-server'></i>
      <h1>Stored Products</h1>
    </div>
    <?php
    include './database.php';
    $query = "SELECT * FROM product ORDER BY ProductID DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
    echo "<a href='create.php' class='btn btn-primary m-b-1em'><i class='bx bx-plus'></i>Add new</a>";
    if ($num > 0) {
      echo "<table class='table table-hover table-responsive table-bordered'>";
      echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>No. of Stock</th>
                <th>Actions</th>
              </tr>";
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<tr>
                    <td>{$ProductID}</td>
                    <td>{$Name}</td>
                    <td>{$Description}</td>
                    <td>{$Price}</td>
                    <td>{$QuantityInStock}</td>
                    <td>";
        echo "<a href='read_one.php?id={$ProductID}' class='btn btn-info m-r-1em'><i class='bx bxs-spreadsheet' ></i></a>";
        echo "<a href='update.php?id={$ProductID}' class='btn btn-primary m-r-1em'><i class='bx bxs-edit' ></i></a>";
        echo "<a href='delete.php?id={$ProductID}' class='btn btn-danger'><i class='bx bxs-trash'></i></a>";
        echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "<div class='alert alert-danger'>No records found.</div>";
    }
    ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>