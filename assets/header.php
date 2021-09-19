<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">


    <title>House</title>
  </head>
  <body>
<?php if ($_SERVER['REQUEST_URI'] <> "/login.php"): ?>

<div class="nav navbar-light bg-light">
    <div class="container"> 
        <div class="row">
            <div class="col-6">
                <a class="btn btn-secondary btn-md p-3" style="width:100%;" href="index.php" role="button">Register expense</a>
            </div>
            <div class="col-6">
                <a class="btn btn-secondary btn-md p-3" style="width:100%;" href="expenses.php" role="button">All expenses</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
