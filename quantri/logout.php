<?php

session_start();
unset($_SESSION["admin"]);  //xoa session user
header("Location: dang-nhap-admin");

?>