<?php
session_start();
$_SESSION = null;
var_dump($_SESSION);
session_destroy();
