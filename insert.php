<?php

include_once 'dbconfig.php';

if ( !isset($_POST['amount'], $_POST['description']) ) {
	header('Location: index.php');
}
$dayOfMonth = intval(date("d"));

// ---- BUSINESS LOGIC ----
// if day of month is after the 25th, then add expense to next month.
// Makes it possible to transfer money on the first

if ($dayOfMonth < 25){
    if ($stmt = $con->prepare('INSERT INTO expenses (amount, description, payee) VALUES (?, ?, ?)')) {
        $stmt->bind_param("sss", $_POST['amount'], $_POST['description'], $_SESSION['id']);
        $stmt->execute();
        header('Location: index.php');
        $con->close();
    }
} else {
    $date = new DateTime('now');
    $date->modify('first day of next month');
    $timestamp = $date->format('Y-m-d H:i:s');

    if ($stmt = $con->prepare('INSERT INTO expenses (amount, description, payee, created_at) VALUES (?, ?, ?, ?)')) {
        $stmt->bind_param("ssss", $_POST['amount'], $_POST['description'], $_SESSION['id'], $timestamp);
        $stmt->execute();
        header('Location: index.php');
        $con->close();
    }
}