<?php
session_start();
require_once '../../vendor/autoload.php';

echo "<pre>";
print_r($_SESSION);
echo "<pre>";

echo "Download count: 5";
echo "<button>download</button>";
echo "<button>logout</button>";