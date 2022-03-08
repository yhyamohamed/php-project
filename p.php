<?php
$db = new UserController();
$db->connect();
$users = $db->login("m", "n");
echo "<pre>";
echo $users;
echo "<pre>";
