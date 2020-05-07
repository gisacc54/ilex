<?php

require_once 'route/web.php';
$action = $_SERVER['REQUEST_URI'];
  dispatch($action);
