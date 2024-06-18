<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Customers</title>
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

<body bgcolor="darkcyan">
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
<section style=" color: orange;">
  <marquee><h1 style="color: brown;">WELCOME TO INVENTORY MANAGEMENT SYSTEM </h1></marquee>
<section>

<h1><u> Customer Form </u></h1>
<form method="post" action="customer.php">

<label for="custid">Customer Id:</label>
<input type="number" id="custid" name="custid"><br><br>

<label for="pid">Product Id:</label>
<input type="number" id="pid" name="pid" required><br><br>

<label for="name">Name:</label>
<input type="text" id="pname" name="pname" required><br><br>

<label for="email">Email:</label>
<input type="email" id="email" name="email" required><br><br>

<label for="phone">Phone Number:</label>
<input type="text" id="phone" name="phone" required><br><br>

<label for="gend">Gender:</label>
            <select name="gend" id="gend">
                <option>Male</option>
                <option>Female</option>
            </select><br><br>

<input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: green;"> hazajyabera samuel</h1></marquee>

        <!-- PHP code starts here -->

       <?php
include('database.php');
// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO customer (customer_id, product_id, name, email, phone_number, gender) VALUES (?, ?, ?, ?, ?, ?)");
    // Initialize variables
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number']; // Corrected variable name
    $gender = $_POST['gender'];
    $stmt->bind_param("ssssis", $customer_id, $product_id, $name, $email, $phone_number, $gender); // Corrected parameter types
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='customer.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    $stmt->close();
}
// SQL query to fetch data from the  table
$sql = "SELECT * FROM customer";
$result = $connection->query($sql);
?>
<!-- Displaying fetched data in a table -->
<table>
    <tr>
        <th>Customer_ID</th>
        <th>Product Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Gender</th>
    </tr> 
    <?php 
    // Output data of each row
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["customer_id"] . "</td>
                  <td>" . $row["product_id"] . "</td>
                  <td>" . $row["name"] . "</td> 
                  <td>" . $row["email"] . "</td>
                  <td>" . $row["phone_number"] . "</td>
                  <td>" . $row["gender"] . "</td>
                  <td><a style='padding:4px' href='delete_customer.php?customer_id=" . $row["customer_id"] . "'>Delete</a></td>
                  <td><a style='padding:4px' href='update_customer.php?customer_id=" . $row["customer_id"] . "'>Update</a></td>
              </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    ?>        
</table>
<?php
// Close connection
$connection->close();
?>  
<footer>
    <center> 
        <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</b>
    </center>
</footer>
</body>
</html>
