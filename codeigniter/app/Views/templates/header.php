<!doctype html>
<html>
<head>
    <title>CodeIgniter Tutorial</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid">
    <div class="row p-4 bg-light">
        <div class="col text-center">
            <a href="<?php echo site_url('users'); ?>">Users</a>
        </div>
        <div class="col text-center">
            <a href="/">All expenses</a>
        </div>
    </div>
</div>
<div class="container">
<h1><?= esc($title) ?></h1>
</div>