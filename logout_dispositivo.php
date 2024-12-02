<?php
session_start();
session_destroy(); 
header("Location: dispositivo.php"); 
exit;