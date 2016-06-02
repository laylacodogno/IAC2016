<?php

function connect (){
 global $connect;
 $connect = mysqli_connect("localhost","root","","iac");
 // Check connection
 if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die;
  }
}
