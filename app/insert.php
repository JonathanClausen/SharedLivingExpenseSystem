<?php

include_once 'dbconfig.php';


if ($stmt = $con->prepare('INSERT INTO expenses (amount, description, payee) VALUES (?, ?, ?)')) {
    $stmt->bind_param("sss", $_POST['amount'], $_POST['description'], $_SESSION['id']);
    $stmt->execute();
    header('Location: index.php');
    $con->close();
}