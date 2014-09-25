<?php
session_start();
session_destroy();
unset($_SESSION['user']);
echo '<script>location.href="index";</script>';
