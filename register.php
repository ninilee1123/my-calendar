<?php
require_once("config.php");

$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';
$nickname = $_POST["nickname"] ?? '';

if (!$username || !$password || !$nickname) {
  echo "모든 항목 필요";
  exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
  echo "이미 사용 중인 아이디입니다.";
  exit;
}
$stmt->close();

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password, nickname) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed, $nickname);

if ($stmt->execute()) {
  echo "success";
} else {
  echo "실패: " . $conn->error;
}
$stmt->close();
$conn->close();
?>
