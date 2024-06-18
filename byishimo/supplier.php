<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Our Suppliers</title>

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
    padding:33px;
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

<body bgcolor="skyyellow">
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

<h1><u> Supplier Form </u></h1>
<form method="post" action="supplier.php">

<label for="supid">Supplier Id:</label>
<input type="number" id="supid" name="supid"><br><br>

<label for="pid">Product Id:</label>
<input type="number" id="pid" name="pid" required><br><br>

<label for="name">Supplier Name:</label>
<input type="text" id="pname" name="pname" required><br><br>

<label for="address">Supplier Address:</label>
<input type="text" id="address" name="address" required><br><br>

<label for="phone">Supplier Contact:</label>
<input type="text" id="phone" name="phone" required><br><br>

<label for="gend">Gender:</label>
            <select name="gend" id="gend">
                <option>Male</option>
                <option>Female</option>
            </select><br><br>

<input type="submit" name="add" value="Insert"><br>
<?php
include('database.php');

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO supplier (supplier_id, product_id, supplier_name, supplier_adress, supplier_contact, gender) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $supplier_id, $product_id, $supplier_name, $supplier_adress, $supplier_contact, $gender);

    // Set parameters from POST and execute
    $supplier_id = $_POST['supplier_id'];
    $product_id = $_POST['product_id'];
    $supplier_name = $_POST['supplier_name'];
    $supplier_adress = $_POST['supplier_adress'];
    $supplier_contact = $_POST['supplier_contact'];
    $gender = $_POST['gender'];

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='supplier.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Update section
    $stmt = $connection->prepare("UPDATE supplier SET supplier_id=?, product_id=?, supplier_name=?, supplier_adress=?, supplier_contact=?, gender=? WHERE supplier_id=?");
    $stmt->bind_param("sssssss", $supplier_id, $product_id, $supplier_name, $supplier_adress, $supplier_contact, $gender, $supplier_id);

    // Set parameters from POST and execute
    $supplier_id = $_POST['supplier_id'];
    $product_id = $_POST['product_id'];
    $supplier_name = $_POST['supplier_name'];
    $supplier_adress = $_POST['supplier_adress'];
    $supplier_contact = $_POST['supplier_contact'];
    $gender = $_POST['gender'];

    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>
             <a href='supplier.html'>Back to Form</a>";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Delete section
    $stmt = $connection->prepare("DELETE FROM supplier WHERE supplier_id=?");
    $stmt->bind_param("s", $supplier_id);

    // Set parameter from POST and execute
    $supplier_id = $_POST['supplier_id'];

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='supplier.html'>Back to Form</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the supplier table
$sql = "SELECT * FROM supplier";
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
    <h2>Table of supplier</h2>
    
    <table id="dataTable">
        <tr>
            <th>Supplier Id</th>
            <th>Product Id</th>
            <th>Supplier Name</th>
            <th>Supplier Address</th>
            <th>Supplier Contact</th>
            <th>Gender</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["supplier_id"] . "</td>
                          <td>" . $row["product_id"] . "</td>
                          <td>" . $row["supplier_name"] . "</td> 
                          <td>" . $row["supplier_adress"] . "</td>
                          <td>" . $row["supplier_contact"] . "</td>
                          <td>" . $row["gender"] . "</td>
                          <td><a style='padding:4px' href='delete_supplier.php?supplier_id=" . $row["supplier_id"] . "'>Delete</a></td>
                          <td><a style='padding:4px' href='update_supplier.php?supplier_id=" . $row["supplier_id"] . "'>Update</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        ?>        
    </table>
    <footer>
      <center> 
        <b><h2>UR CBE BIT &copy, 2024 &reg, Designed by: Samuel HAZAJYABERA</h2></b>
      </center>
    </footer>
</body>
</html>

<?php
// Close connection
$connection->close();
?>
