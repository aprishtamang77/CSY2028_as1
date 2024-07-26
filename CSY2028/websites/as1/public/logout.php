<?php
session_start();

session_destroy();// this destroy all the data reqg to the session

header("Location: login.php");