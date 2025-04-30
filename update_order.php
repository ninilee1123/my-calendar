<?php
require_once("config.php");
// $conn = new mysqli("localhost", "calendar_user", "Aa123456!", "calendar_db");
// $conn->set_charset("utf8");

$data = json_decode(file_get_contents("php://input"), true);
if (!is_array($data)) {
  echo "invalid";
  exit;
}

foreach ($data as $item) {
  $stmt = $conn->prepare("UPDATE events SET order_no = ? WHERE id = ?");
  $stmt->bind_param("ii", $item["order"], $item["id"]);
  $stmt->execute();
  $stmt->close();
}

echo "order_updated";
$conn->close();
?>
