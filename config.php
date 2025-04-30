<?php
$host = "sql12.freesqldatabase.com";
$db_user = "sql12776136";      // 회원가입 시 입력한 사용자 이름
$db_pass = "R2jJ6nh555";    // 회원가입 시 입력한 비밀번호
$db_name = "sql12776136";  // 회원가입 시 입력한 데이터베이스 이름

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("DB 연결 실패: " . $conn->connect_error);
}
?>
