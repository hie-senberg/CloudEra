<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $stmt = $conn->prepare("INSERT INTO crime_reports (user_id, description, latitude, longitude) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $user_id, $description, $latitude, $longitude);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Crime report submitted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
