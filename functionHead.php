<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if(!$connection){
    throw new Exception("Error Processing Request");
}
//if complete is 0 it's Upcoming task
$query = "SELECT * FROM tasks WHERE complete = 0 ORDER BY date"; // sql for data display
$result = mysqli_query($connection, $query);

// if complete is 1 it's complete/ outgoing task
$completeTasksQuery = "SELECT * FROM tasks WHERE complete = 1 ORDER BY date"; // sql for data display
$resultCompleteTask = mysqli_query($connection, $completeTasksQuery);