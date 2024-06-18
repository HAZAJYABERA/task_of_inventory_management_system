<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our stock_transaction</title>
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
  <title>stock_transaction</title>


          <h1><u>stock_transaction Form </u></h1>
    <form method="post" action="stock_transaction.php">
            
        <label for="stock_transaction_id">stock_transaction_id:</label>
        <input type="number" id="stock_transaction_id" name="stock_transaction_id"><br><br>

        <label for="product_id">product_id:</label>
        <input type="number" id="product_id" name="product_id" required><br><br>

        <label for="transaction_type">transaction_type:</label>
        <input type="number" id="transaction_type" name="transaction_type" required><br><br>

        <label for="quantity">quantity:</label>
        <input type="text" id="quantity" name="quantity" required><br><br>
        <label for="transaction_date">transaction_date:</label>
        <input type="date" id="transaction_date" name="transaction_date" required><br><br>


        <input type="submit" name="add" value="Insert"><?php
include('database.php');
            

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO stock_transaction(stock_transaction_id, Product_id, stock_transaction_type, quantity, transaction_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $stock_transaction_id, $product_id, $stock_transaction_type, $quantity, $transaction_date);

    // Set parameters from POST and execute
    $stock_transaction_id = $_POST['stock_transaction_id'];
    $product_id = $_POST['product_id'];
    $stock_transaction_type = $_POST['stock_transaction_type'];
    $quantity = $_POST['quantity'];
    $transaction_date = $_POST['transaction_date'];

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='stock_transaction.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Update section
    $stmt = $connection->prepare("UPDATE stock_transaction SET stock_transaction_id=?, product_id=?, stock_transaction_type=?, quantity=?, transaction_date=? WHERE stock_transaction_id=?");
    $stmt->bind_param("sssds", $stock_transaction_id, $product_id, $stock_transaction_type, $quantity, $transaction_date);

    // Set parameters from POST and execute
    $stock_transaction_id = $_POST['stock_transaction_id'];
    $product_id = $_POST['product_id'];
    $stock_transaction_type= $_POST['stock_transaction_type'];
    $quantity = $_POST['quantity'];
     $transaction_date = $_POST['transaction_date'];


    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>
             <a href='stock_transaction.html'>Back to Form</a>";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Delete section
    $stmt = $connection->prepare("DELETE FROM stock_transaction WHERE stock_transaction_id=?");
    $stmt->bind_param("s", $stock_transaction_id);

    // Set parameter from POST and execute
    $stock_transaction_id = $_POST['stock_transaction_id'];

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='stock_transaction.html'>Back to Form</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the stock_transaction table
$sql = "SELECT * FROM stock_transaction";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of stock_transaction</title>
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
            <th>Stock_transaction Id</th>
            <th>Product Id</th>
            <th>Transaction Type</th>
            <th>Quantity</th>
            <th>Transaction Date</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["stock_transaction_id"] . "</td>
                          <td>" . $row["product_id"] . "</td>
                          <td>" . $row["transaction_type"] . "</td> 
                          <td>" . $row["quantity"] . "</td>
                          <td>" . $row["transaction_date"] . "</td>
                          <td><a style='padding:4px' href='delete_stock_transaction.php?stock_transaction_id=" . $row["stock_transaction_id"] . "'>Delete</a></td>
                  <td><a style='padding:4px' href='update_stock_transaction.php?stock_transaction_id=" . $row["stock_transaction_id"] . "'>Update</a></td>
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