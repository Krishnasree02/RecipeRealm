<?php
$localhost="127.0.0.1";
$username="root";
$password="";
$dbname="reciperealm";
$connect=new mysqli($localhost,$username,$password,$dbname);
if($connect->connect_error)
{
    die("connection failed");
}
?>