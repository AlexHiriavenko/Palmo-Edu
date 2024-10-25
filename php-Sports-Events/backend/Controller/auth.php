<?php

use Palmo\controller\AuthController;

require "../vendor/autoload.php";
session_start();



$authController = new AuthController();
$authController->handleRequest();