<?php
include_once ("_using/php/config.php");
include_once ("_using/php/database.php");
$config = new Config();
$db = new Database();
$error_url = $config->get("protocol") . "://" . $config->get("domain") . $config->get("path");

if (!isset($_GET["code"]) || empty($_GET["code"])) {
    header("Location: $error_url");
}

$table = $config->get("db_urls_table");
$code = mysqli_real_escape_string($db->get_connection(), $_GET["code"]);
if (mysqli_num_rows(mysqli_query($db->get_connection(), "SELECT id FROM $table WHERE code='$code'")) >= 1) {
    $result = mysqli_query($db->get_connection(), "SELECT url FROM $table WHERE code='$code'");
    $url = $error_url;
    while ($row = mysqli_fetch_assoc($result)) {
        $url = $row["url"];
    }
    header("Location: $url");
}
else {
    header("Location: $error_url");
}