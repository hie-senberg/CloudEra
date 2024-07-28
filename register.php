<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];

    $stmt = $conn->prepare("INSERT INTO users (email, password, full_name, phone_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $password, $full_name, $phone_number);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "User registered successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
