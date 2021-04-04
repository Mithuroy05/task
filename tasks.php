<?php
include_once ('config.php');
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if(!$connection){
    throw new Exception("Can not connect to Database");

}
else{
    //$action = isset($_POST['action']) ? $_POST['action'] : '';
    $action = $_POST['action'] ??  ''; // -Null close operator
    if(!$action){
        header('Location: index.php');
        die();
    }else{
        if('add' == $action){
            //insert record
            $task = $_POST['task'];
            $date = $_POST['date'];
            if($task && $date){
                $query = "INSERT INTO ".DB_TABLE."(task,date) VALUES('{$task}','{$date}')";
                    // echo $query;
                mysqli_query($connection, $query);
                header('Location: index.php?added=true');
            }
        }

        else if('complete' == $action ){
            $taskid= $_POST['taskid'];
            if($taskid){
                $query = "UPDATE tasks SET complete = 1 WHERE id= {$taskid} LIMIT 1";
                mysqli_query($connection, $query);
            }
            header('Location: index.php');

        }

        else if('delete' == $action ){
            $taskid= $_POST['taskid'];
            // for check
            // echo "deleting {$taskid} ";
            // die();
            if(dtaskid){
                $query = "DELETE FROM tasks WHERE id= {$taskid} LIMIT 1";
                mysqli_query($connection, $query);
            }
            header('Location: index.php');
        }

        else if('incomplete' == $action ){
            $taskid= $_POST['taskid'];
            if($taskid){
                $query = "UPDATE tasks SET complete = 0 WHERE id= {$taskid} LIMIT 1";
                mysqli_query($connection, $query);
            }
            header('Location: index.php');
        }
        // ================================================
        else if('bulkcomplete' == $action ){
            $taskids= $_POST['taskids'];
            //print_r($taskids);
             $_taskids = join(",",$taskids);
            if($taskids){
                $query = "UPDATE tasks SET complete = 1 WHERE id in ($_taskids) ";
                //print_r($query);
                mysqli_query($connection, $query);
            }
            header('Location: index.php');
       }
       // bulk option delete query
       else if('bulkdelete' == $action ){
        $taskids= $_POST['taskids'];
        //print_r($taskids);
         $_taskids = join(",",$taskids);
        if($taskids){
            $query = "DELETE FROM tasks WHERE id in ($_taskids) ";
            //print_r($query);
            mysqli_query($connection, $query);
        }
        header('Location: index.php');
   }
    }
}
mysqli_close($connection);