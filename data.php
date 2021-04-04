<?php
include_once "config.php";
//echo DB_HOST;
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if(!$connection){
    throw new Exception("Can not connect to Database");

}
else{
    echo "Connected <br>";

    //insert a record
    //INSERT INTO tasks (task, data) VALUES ('Do something','2021-03-21)
   //echo mysqli_query($connection, "INSERT INTO tasks (task, date) VALUES ('Do something extra more','2021-03-25')");
    //query show
    //SELECT* FROM tasks
   
    /* 
    $result =  mysqli_query($connection, "SELECT* FROM tasks");
    // How to show result
    //while($data = mysqli_fetch_array($result)){
    //while($data = mysqli_fetch_row($result)){
    //while($data = mysqli_fetch_object($result)){
     while($data = mysqli_fetch_assoc($result)){
        echo "<pre>";
            print_r($data);
        echo "</pre>";
    }
    */
    //Delete 
    //mysqli_query($connection,'DELETE FROM task');
    
    mysqli_close($connection);
}