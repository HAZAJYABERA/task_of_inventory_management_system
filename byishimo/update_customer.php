<?php
include('database.php');

// Check if customer_id is set
if (isset($_REQUEST['customer_id'])) {
    $customer_id = $_REQUEST['customer_id'];

    // Prepare and execute SELECT statement to retrieve customer details
    $stmt = $connection->prepare("SELECT * FROM customer WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row['customer_id'];
        $product_id = $row['product_id'];
        $name = $row['name'];
        $email = $row['email'];
        $phone_number = $row['phone_number'];
        $gender = $row['gender'];
    } else {
        echo "Customer not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="customer_id">Customer ID:</label>
        <input type="number" name="customer_id" value="<?php echo isset($customer_id) ? $customer_id : ''; ?>" readonly>
        <br><br>

        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>">
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>
       
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
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
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];

    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customer SET product_id=?, name=?, email=?, phone_number=?, gender=? WHERE customer_id=?");
    $stmt->bind_param("issssi", $product_id, $name, $email, $phone_number, $gender, $customer_id);

    if ($stmt->execute()) {
        // Redirect to customer.php after successful update
        header('Location: customer.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating customer: " . $stmt->error;
    }
}
?>
