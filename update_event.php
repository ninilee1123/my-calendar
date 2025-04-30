<?php
require_once("config.php");

$event_id = $_POST["event_id"] ?? '';
$title = $_POST["title"] ?? '';
$detail = $_POST["detail"] ?? '';
$type = $_POST["type"] ?? '';

if (!$event_id || !$title || !$type) {
  echo "invalid";
  exit;
}

$color = $type === "완료" ? "#9e9e9e" : "#4CAF50";

$stmt = $conn->prepare("UPDATE events SET title = ?, detail = ?, type = ?, color = ? WHERE id = ?");
$stmt->bind_param("ssssi", $title, $detail, $type, $color, $event_id);

if ($stmt->execute()) {
  echo "updated";
} else {
  echo "error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
