<?php
include('database.php');

// Check if supplier_id is set
if (isset($_REQUEST['supplier_id'])) {
    $supplier_id = $_REQUEST['supplier_id'];

    // Prepare and execute SELECT statement to retrieve supplier details
    $stmt = $connection->prepare("SELECT * FROM supplier WHERE supplier_id = ?");
    
    // Check for prepare error
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connection->error));
    }
    
    $stmt->bind_param("i", $supplier_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_id = $row['product_id'];
        $supplier_name = $row['supplier_name'];
        $supplier_address = $row['supplier_address'];
        $supplier_contact = $row['supplier_contact'];
        $gender = $row['gender'];
    } else {
        echo "Supplier not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="supplier_id">Supplier ID:</label>
        <input type="number" name="supplier_id" value="<?php echo isset($supplier_id) ? $supplier_id : ''; ?>" readonly>
        <br><br>

        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>">
        <br><br>

        <label for="supplier_name">Supplier Name:</label>
        <input type="text" name="supplier_name" value="<?php echo isset($supplier_name) ? $supplier_name : ''; ?>">
        <br><br>

        <label for="supplier_address">Supplier Address:</label>
        <input type="text" name="supplier_address" value="<?php echo isset($supplier_address) ? $supplier_address : ''; ?>">
        <br><br>

        <label for="supplier_contact">Supplier Contact:</label>
        <input type="text" name="supplier_contact" value="<?php echo isset($supplier_contact) ? $supplier_contact : ''; ?>">
        <br><br>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>">
        <br><br>
       
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $product_id = $_POST['product_id'];
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_contact = $_POST['supplier_contact'];
    $gender = $_POST['gender'];

    // Update the supplier in the database
    $stmt = $connection->prepare("UPDATE supplier SET product_id=?, supplier_name=?, supplier_address=?, supplier_contact=?, gender=? WHERE supplier_id=?");
    
    // Check for prepare error
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connection->error));
    }
    
    $stmt->bind_param("issssi", $product_id, $supplier_name, $supplier_address, $supplier_contact, $gender, $supplier_id);

    if ($stmt->execute()) {
        // Redirect to suppliers.php after successful update
        header('Location: suppliers.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating supplier: " . $stmt->error;
    }
    $stmt->close();
}

$connection->close();
?>
