<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Products Stock in</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:51px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkgray;
    }
  </style>
</head>

<header>

<body bgcolor="blue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./imeges/samuel.png" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./product.html">PRODUCT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./supplier.html">SUPPLIER</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./stock_transaction.html">STOCK_TRANSACTION</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.html">CUSTOMER</a>
  </li>
   
    <li style="display: inline; margin-right: 10px;"><a href="./stockin.html">STOCK_IN</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./stockout.html">STOCK_OUT</a>
  </li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
  </ul>

</header>
<section>

<h1><u> StockIn Form </u></h1>
<form method="post" action="stockin.php">

<label for="stockin_id">StockIn Id:</label>
<input type="number" id="stockin_id" name="stockin_id"><br><br>

<label for="transid">Stock Transaction Id:</label>
<input type="number" id="transid" name="transid" required><br><br>

<label for="pid">Product Id:</label>
<input type="number" id="pid" name="pid" required><br><br>

<label for="transdate">Transaction Date:</label>
<input type="date" id="transdate" name="transdate" required><br><br>

<label for="qty">Quantity:</label>
<input type="number" id="qty" name="qty" required><br><br>


<input type="submit" name="add" value="Insert"><br><br><?php
include('database.php');
            

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO stockin(stockin_id, stock_transaction_id, product_id, transaction_date, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $stockin_id, $stock_transaction_id, $product_id, $transaction_date, $quantity);

    // Set parameters from POST and execute
    $stockin_id = $_POST['stockin_id'];
    $stock_transaction_id = $_POST['stock_transaction_id'];
    $product_id = $_POST['product_id'];
    $transaction_date = $_POST['transaction_date'];
    $quantity = $_POST['quantity'];

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='stockin.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Update section
    $stmt = $connection->prepare("UPDATE stockin SET stockin_id=?, stock_transaction_id=?, product_id=?, transaction_date=?, quantity=? WHERE stockin_id=?");
    $stmt->bind_param("sssds", $stockin_id, $stock_transaction_id, $product_id, $transaction_date, $quantity);

    // Set parameters from POST and execute
    $stockin_id = $_POST['stockin_id'];
    $stock_transaction_id = $_POST['stock_transaction_id'];
    $product_id = $_POST['product_id'];
    $transaction_date = $_POST['transaction_date'];
    $quantity = $_POST['quantity'];

    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>
             <a href='stockin.html'>Back to Form</a>";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Delete section
    $stmt = $connection->prepare("DELETE FROM stockin WHERE stockin_id=?");
    $stmt->bind_param("s", $stockin_id);

    // Set parameter from POST and execute
    $stid = $_POST['stid'];

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='stockin.html'>Back to Form</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the Product table
$sql = "SELECT * FROM stockin";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Product</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Table of Product</h2>
    
    <table id="dataTable">
        <tr>
            <th>Stockin Id</th>
            <th>Stock_Transaction_Id</th>
            <th>Product Id</th>
            <th>Transaction_Date</th>
            <th>Quantity</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["stockin_id"] . "</td>
                          <td>" . $row["stock_transaction_id"] . "</td>
                          <td>" . $row["product_id"] . "</td> 
                          <td>" . $row["transaction_date"] . "</td>
                          <td>" . $row["quantity"] . "</td>
                          <td><a style='padding:4px' href='delete_stockin.php?stockin_id=" . $row["stockin_id"] . "'>Delete</a></td>
                  <td><a style='padding:4px' href='update_stockin.php?stockin_id=" . $row["stockin_id"] . "'>Update</a></td>
              </tr>";
        }
                    
        
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>        
    </table>
</body>


<?php
// Close connection
$connection->close();
?>
    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:Samuel HAZAJYABERA</h2></b>
  </center>
</footer>
</body>
</html>