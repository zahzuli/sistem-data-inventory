<?php
if (isset($_SESSION['log'])) {
    # code...
} else {
    header('location:login.php');
}
?>