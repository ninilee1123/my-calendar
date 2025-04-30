<?php
// adminer.php - 웹에서 DB 관리 도구
// 원본 출처: https://www.adminer.org/latest.php

function adminer_object() {
  include_once "./editor-plugins/plugin.php";

  class AdminerSoftware extends Adminer {
    function name() {
      return '일정관리 DB';
    }
  }

  return new AdminerSoftware;
}

include "./editor-plugins/adminer.php";
?>
