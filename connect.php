<?php
$conn=new mysqli("localhost","root","","bank_system");
if($conn==true){
    // echo"db is connected";
}
else{
     die(mysqli_error($conn));
}

?>