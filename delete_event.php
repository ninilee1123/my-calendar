<?php
require_once("config.php");

$event_id = $_POST["event_id"] ?? '';

if (!$event_id) {
  echo "no_id";
  exit;
}

$stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);

if ($stmt->execute()) {
  echo "deleted";
} else {
  echo "error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
