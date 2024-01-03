<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Home</title>
    </head>
    <body>
        <?php include "./includes/__header.php" ?>
        <?php 
        
            include "class/database.php"; 
            $limit= 5;
            $database  = new database();
            // $database->insert('students', ['first_name'=>'rupa', 'last_name'=>'kikani', 'age'=>35, 'gender'=>'female']);

            // $database->update('students', ['first_name'=>'rupa', 'last_name'=>'kikani', 'age'=>35, 'gender'=>'female'], 'id = "5"');
            if(isset($_POST['delete'])){
                $deleteId = $_POST['delete'];
                $database->delete('students', "id=$deleteId");
            }

            // $database->sql("SELECT * FROM students");
            
            $database->select('students', '*', null, null, null, $limit);
            $allStudent = $database->getResult();

            $database->pagination('students', null, null, $limit);
            $totalPage = $database->getResult();
        ?>
        <h1>Students</h1>

        <div class="table-responsive">
            
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>  
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Admission Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allStudent as $student) : ?>
                    <tr>
                        <td><?php echo $student['id'] ?></td>
                        <td><?php echo $student['first_name'] ?></td>
                        <td><?php echo $student['last_name'] ?></td>
                        <td><?php echo $student['age'] ?></td>
                        <td><?php echo $student['gender'] ?></td>
                        <td><?php echo $student['created_at'] ?></td>
                        <td class="btn_grp">
                            <form class="w-50" action="<?php basename($_SERVER['PHP_SELF'])?>" method="post" onsubmit="return confirmDelete()">
                            <input type="hidden" name="delete" value="<?php echo $student['id'] ?>">
                            <button type="submit" class="btn btn-danger w-100 m-1">Delete</button>
                            </form>
                            <form class="w-50" action="./view/update.php" method="GET">
                            <button class="btn btn-primary w-100 m-1" name="update" value="<?php echo $student['id'] ?>">Update</button>
                            </form>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php  
                        if(isset($_GET['page'])) {
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $previous = $page-1;
                        $next = $page+1;

                        if($page > 1){
                            echo "<li class='page-item'><a class='page-link' href='?page=$previous'>Previous</a></li>";
                        }
                    
                        for ($i=1; $i <= $totalPage ; $i++) {
                            $active = $page ==$i? 'active': '' ;                    
                            echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                        }   
                        if($next <= $totalPage){    
                            echo "<li class='page-item'><a class='page-link' href='?page=$next'>Next</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>

        <?php include "./includes/__footer.php" ?>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>