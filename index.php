<?php
session_start();
error_reporting(~E_WARNING & ~E_NOTICE);
require_once 'bootstrap.php';
$app = new App();