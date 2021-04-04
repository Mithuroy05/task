<?php
require_once('functionHead.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Tasks</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    
    
    <!-- <meta http-equiv="refresh" content="3"> -->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<!-- ==================================== -->

    <div class="container" id="main" >
        <h1>Tasks Manager</h1> 
        <p>This is sample project for managing our daily tasks</p>

        <?php
            if(mysqli_num_rows($resultCompleteTask)>0){ // if mysql row number is zero 
                ?>
                <h4>Complete Tasks</h4>
                <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($cdata = mysqli_fetch_assoc($resultCompleteTask)){
                            $timestamp = strtotime($cdata['date']);
                            $cdate = date("jS M, Y", $timestamp);
                            ?> 
                            <tr>
                                <td><?php echo $cdata['id'] ?></td>
                                <td><?php echo $cdata['task'] ?></td>
                                <td><?php echo $cdate ?></td>
                                <td><a class="delete myButton" data-taskid="<?php echo $cdata['id'] ?>" href="#">Delete</a> | <a class="incomplete myButton" data-taskid="<?php echo $cdata['id'] ?>" href="#">Incomplete</a></td>
                            </tr>
                            <?php
                        }
                             
                         ?> 
                           

                        </tbody>
                    </table>
                <?php
            }
        ?>
        <!-- End of complete task -->
        <?php
            if(mysqli_num_rows($result)==0){ // if mysql row number is zero
                ?> 
                    <p>NO TASK FOUND</p>
                <?php
            } // end if function
            
            else{
            ?> 
                 <h4>Upcoming Tasks</h4>

                <form action="tasks.php" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($data = mysqli_fetch_assoc($result)){
                            $timestamp = strtotime($data['date']);
                            $date = date("jS M, Y", $timestamp);
                            ?> 
                            <tr>
                                <td><input name="taskids[]" type="checkbox" class="label-inline" value="<?php echo $data['id'] ?>"></td>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['task'] ?></td>
                                <td><?php echo $date ?></td>
                                <td><a class="delete myButton" data-taskid="<?php echo $data['id'] ?>"  href="#">Delete</a> | <a class="myButton" href="#"> Edit</a> | <a  class="complete myButton" data-taskid="<?php echo $data['id'] ?>" href="#">Complete</a></td>
                            </tr>
                            <?php
                            }
                             mysqli_close($connection); // connection close
                         ?> 
                           

                        </tbody>
                    </table>

                    <select name="action" id="action" class="select_box">
                        <option value="0">With Selected</option>
                        <option value="bulkdelete">Delete</option>
                        <option value="bulkcomplete">Mark As Complite</option>
                    </select>
                    <input type="submit" id="bulksubmit" class="button-primary" value="submit">

                </form>    
            <?php
           }
        ?>

        <h4>Add task</h4>
        <?php
        $added = $_GET['added'] ?? ''; 
        if($added){
            echo '<p> Task Successfully Added</p>';
        }

        ?>
        <form action="tasks.php" method="POST" class="#">
            <fieldset>
                <label for="task">Task</label>
                <input type="text" placeholder="Task Details" name="task" id='task' value="">
                <!-- ---------------------------- -->
                <label for="date">Date</label>
                <input type="text" placeholder="Task Date" name="date" id='date' value="">
                <!-- ----------------------------- -->
                <input type="submit" class="button-primary" value="Add Task">                     
                <input type="hidden" name="action" value="add"> 
            </fieldset>
        </form>

        
</div>





<form action="tasks.php" method="post" id="completeform">
        <input type="hidden" id="" name="action" value= "complete">
        <input type="hidden" id="taskid" name="taskid">
 </form>

 <form action="tasks.php" method="post" id="deleteform">
        <input type="hidden" name="action" value= "delete">
        <input type="hidden" id="dtaskid" name="taskid">
 </form>

 <form action="tasks.php" method="post" id="incompleteform">
        <input type="hidden" name="action" value= "incomplete">
        <input type="hidden" id="itaskid" name="taskid">
 </form>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script>
    ;(function($){
        $(document).ready(function(){
            $(".complete").on('click', function(){
                var id = $(this).data("taskid");
                // alert(id);
                $("#taskid").val(id);
                $("#completeform").submit();
            });

            $(".delete").on('click', function(){
                if(confirm("Are you sure to delete this task?")){
                    var id = $(this).data("taskid");
                    // alert(id);
                    $("#dtaskid").val(id);
                    $("#deleteform").submit();
                }
            });
            $(".incomplete").on('click', function(){
                    var id = $(this).data("taskid");
                    // alert(id);
                    $("#itaskid").val(id);
                    $("#incompleteform").submit();
            });

            $("#bulksubmit").on("click", function(){
                if($("#action").val()=='bulkdelete'){
                    if(!confirm("Are you sure to delete?")){
                        return false;
                    }
                }
            })
            
        });
    })(jQuery);

</script>

</html>







