<?php
session_start();
if (isset($_SESSION["sessaoConta"])) {
    header("Location: /");
    exit();
}
if (!isset($_SESSION["sessaoConta"])) {
    $page = "pages/login.php";
}
require_once($page);
?>