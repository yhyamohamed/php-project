<?php

const __dbOptions = array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'php-project',
    'username' => 'root',

);

  const BASE_PATH = "/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);