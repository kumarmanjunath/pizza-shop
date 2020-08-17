<?php 
//connect to db
$conn=mysqli_connect('localhost','manju','manju123','manja_pizza');

//check db connected or not
if(!$conn) {
    echo 'Connection Error: ' .mysqli_connect_error();
}

?>