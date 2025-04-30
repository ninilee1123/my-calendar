<?php
header("Content-Type: application/json; charset=utf-8");

require_once("config.php");

$user_id = $_GET["user_id"] ?? '';
$year = $_GET["year"] ?? '';
$month = $_GET["month"] ?? '';

if (!$user_id || !$year || !$month) {
  echo json_encode([]);
  exit;
}

$start_date = sprintf("%04d-%02d-01", $year, $month);
$end_date = date("Y-m-t", strtotime($start_date));

$stmt = $conn->prepare("
  SELECT event_date, id, title, detail, type, color, order_no 
  FROM events 
  WHERE user_id = ? 
  AND event_date BETWEEN ? AND ?
  ORDER BY event_date ASC, order_no ASC
");
$stmt->bind_param("iss", $user_id, $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

$events = [];

while ($row = $result->fetch_assoc()) {
  $date = $row["event_date"];
  if (!isset($events[$date])) {
    $events[$date] = [];
  }
  $events[$date][] = $row;
}

echo json_encode($events, JSON_UNESCAPED_UNICODE);
$stmt->close();
$conn->close();
?>
