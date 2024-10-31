<?php

require "../vendor/autoload.php";

use Palmo\Controller\AuthController;

session_start();

$authController = new AuthController();
$authController->handleRequest();
