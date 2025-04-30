<?php
require_once("config.php");

$user_id = $_POST["user_id"] ?? '';
$event_date = $_POST["event_date"] ?? '';
$title = $_POST["title"] ?? '';
$detail = $_POST["detail"] ?? '';
$type = $_POST["type"] ?? '일정';

if (!$user_id || !$event_date || !$title || !$type) {
  echo "입력값 부족";
  exit;
}

// 색상은 타입에 따라 자동 지정
$color = $type === "완료" ? "#9e9e9e" : "#4CAF50";

// 현재 해당 날짜에 몇 개 있는지 확인해서 번호 부여
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM events WHERE user_id = ? AND event_date = ?");
$stmt->bind_param("is", $user_id, $event_date);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$next_order = $row["count"] + 1;

$stmt->close();

$stmt = $conn->prepare("INSERT INTO events (user_id, event_date, title, detail, type, color, order_no) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssi", $user_id, $event_date, $title, $detail, $type, $color, $next_order);

if ($stmt->execute()) {
  echo "success";
} else {
  echo "오류: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
