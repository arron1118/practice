<?php

session_start();


$_SESSION['name'] = 'arron';

if (isset($_SESSION['name'])) {
    echo 'Is Set';
} else {
    echo 'Is Not Set';
}

//echo $_SESSION['name'];

