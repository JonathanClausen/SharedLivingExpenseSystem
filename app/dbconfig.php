<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'mysql70.unoeuro.com';
$DATABASE_USER = 'concensur_dk';
$DATABASE_PASS = 'Pilatus001';
$DATABASE_NAME = 'concensur_dk_db3';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}