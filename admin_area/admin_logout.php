<?php
session_start();
session_unset();
session_destroy();
echo "<script>window.open('indax.php','_self')</script>";
?>