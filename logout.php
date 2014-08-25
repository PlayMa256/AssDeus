<?php
session_destroy();
unset($_SESSION['usuario']);
session_unset();
header("location: index.php");