<?php
header("Content-Type: application/json; charset=utf-8");

require_once("config.php");

$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

if (!$username || !$password) {
  echo json_encode(["success" => false, "message" => "입력 누락"]);
  exit;
}

$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($user_id, $hashed_pw);
if ($stmt->fetch()) {
  if (password_verify($password, $hashed_pw)) {
    echo json_encode(["success" => true, "user_id" => $user_id]);
  } else {
    echo json_encode(["success" => false, "message" => "비밀번호 불일치"]);
  }
} else {
  echo json_encode(["success" => false, "message" => "존재하지 않는 아이디"]);
}
$stmt->close();
$conn->close();
?>
