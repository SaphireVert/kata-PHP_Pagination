<?php
if (session_id() == '') {
  session_start();
}
// function flashMessage() {
//   $message = $_SESSION['message'] ?? null;
//   if ($message) {
//     echo $_SESSION['message'];
//     unset($_SESSION['message']);
//   }
// }
