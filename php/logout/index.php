<?php
session_start();
session_unset(); 
session_destroy();
echo"<script languaje='javascript'>window.location='../../login.php';</script>";
?>