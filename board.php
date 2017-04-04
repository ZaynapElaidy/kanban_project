<?php 
    session_start();

    if (!isset($_SESSION['user_email'])) {
        header('Location: ./index.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>kanban</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    
    <!-- <link rel="stylesheet" type="text/css" href="font-awesome.css"> -->
    
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <p class="navbar-brand" href="#">KanBan Your Life</p>
        <!-- <a href="./api/logout.php">logout</a> -->
      </div>
      <div class="nav navbar-nav">
         
</div>
    <a class="btn btn-primary" href="./api/logout.php">SignOut</a>

  
     
    </div>
</nav>

    

    <div class="container-fluid">
        <div id="sortableKanbanBoards" class="row">
            <div class="col-sm-3">

                <div class="panel panel-primary kanban-col text-center ">
                    <div class="panel-heading">
                        <h3> TODO </h3>
                        <i class="fa fa-2x fa-plus-circle pull-right"></i>
                    </div>
                    <div class="panel-body">
                        <div id="TODO" class="kanban-centered"></div>
                    </div>
                    

                    
                     <div class="panel-footer">

                        <!-- <button class="btn btn-primary">Add Card...</button> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target=".modal-example3">Add Card</button>
                    </div>
                </div>
            </div> 
            <div class="col-sm-3">
                <div class="panel panel-primary kanban-col text-center ">
                    <div class="panel-heading">
                        <h3> In progress </h3>
                        <i class="fa fa-2x fa-plus-circle pull-right"></i>
                    </div>
                    <div class="panel-body">
                        <div id="DOING" class="kanban-centered">
                        </div>
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-primary kanban-col text-center ">
                    <div class="panel-heading">
                        <h3> Revision </h3>
                        <i class="fa fa-2x fa-plus-circle pull-right"></i>
                    </div>
                    <div class="panel-body">
                        <div id="REVISION" class="kanban-centered">
                        </div>
                    </div>
                    <div class="panel-footer">

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-primary kanban-col text-center ">
                    <div class="panel-heading">
                        <h3> Done </h3>
                        <i class="fa fa-2x fa-plus-circle pull-right"></i>
                    </div>
                    <div class="panel-body">
                        <div id="DONE" class="kanban-centered">

                        </div>
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-refresh fa-5x fa-spin"></i>
                        <h4>Processing...</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container1">
    <div id="warning" class="modal fade modal-example3">
      <div class="modal-dialog modal-md">
        <div class="modal-content">    
            <div class="modal-body">
               <form id="add" method ="post">
                   <div class="inputs">
                        <input id="title" name="title" type="text" placeholder="Card name" required >
                        <input  name="content" type="text"  placeholder="Description">
                        <button class="btn btn-primary">OK</button>
                        
                    </div>          
                </form>
           </div>   
        </div>
      </div>
    </div>
</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="kanban.js"></script>
<!-- <script type="text/javascript" src="kanban.js"></script> -->

    <script>

        jQuery(document).ready(function(){  

           

            allTasks();


            $("#add").on("submit", function(event){
                event.preventDefault();
                $.ajax({
                    url: "./api/addTask.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response){
                        $('#warning').modal('hide');

                        allTasks();
                    },
                    fail: function(err){
                        console.log(err);
                    }
                });
            });
        });

        </script>
</body>
</html>



