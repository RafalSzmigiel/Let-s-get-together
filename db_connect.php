<?php
$dbserver = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'users';


$mysqli = new mysqli($dbserver,$dbuser,$dbpassword,$dbname);

$mysqli->set_charset('utf8');
if(mysqli_connect_errno() )
{
    echo 'błąd bazy danych';
}

?>