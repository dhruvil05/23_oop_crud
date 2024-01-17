<?php 
    $inactive = 3;
    ini_set('session.gc_maxlifetime', $inactive);
    // session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">

    <title>Create</title>
  </head>
  <body>
    <?php 
        include "../class/database.php";
        include "../class/flashmessage.php";
        $flashMessage = new FlashMessage();

        $database = new database();
        function validate($field, $rules) {
            foreach ($rules as $rule) {
            switch ($rule['type']) {
                case 'required':
                    if (empty($field)) {
                        return $rule['message'];
                    }
                    break;
        
                default:
                    // Default case if no validation rule matches
                    break;
            }
            }
            return '';
        }
      
        $validationRules = [
            'first_name' => [
                ['type' => 'required', 'message' => 'Firstname is required'],
                // Add more rules as needed
            ],
            'last_name' => [
                ['type' => 'required', 'message' => 'Lastname is required'],
                // Add more rules as needed
            ],
            'gender' => [
            ['type' => 'required', 'message' => 'Gender is required'],
            // Add more rules as needed
            ],
            'age' => [
            ['type' => 'required', 'message' => 'Age is required'],
            // Add more rules as needed
            ]
        
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            
            foreach ($validationRules as $fieldName => $rules) {
            $fieldValue = $_POST[$fieldName];
            $error = validate($fieldValue, $rules);
        
            if (!empty($error)) {
                $errors[$fieldName] = $error;
            }
            }

            if (!empty($errors)) {
                // return $errors;
                // $_SESSION['createValidation'] = $errors;
                // $_SESSION['time'] = time();
                // header('location: /oop_crud/view/create.php');
            }else{
            // Perform form validation and database insertion here
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            
            $insertSuccess = $database->insert('students', ['first_name'=>$first_name, 'last_name'=>$last_name, 'age'=>$age, 'gender'=>$gender]);
            if ($insertSuccess) {
                echo '<p class="success-message">Record added successfully!</p>';
                header("Location: http://localhost/oop_crud/index.php");
            } else {
                echo '<p class="error-message">Error adding record. Please try again.</p>';
            }
            }

        }

    ?>
    <?php include "../includes/__header.php" ?>
    <?php if(!empty($errors)){

        // $errors = $_SESSION['createValidation'];

        foreach ($errors as $flash_message) {
            $flashMessage->flash('greeting', $flash_message, FLASH_ERROR);
        }
        
        $flashMessage->unset_flash_message_session('greeting');
        
    }
    
    // if (isset($_SESSION['createValidation']) && (time() - $_SESSION['time'] > $inactive)) {
    //     // unset($_SESSION['createValidation']);
    //     // unset($_SESSION[FLASH][$name]);     // unset particular $_SESSION variable for this page
    //     session_destroy();   // destroy (Delete) all the session data
    //     header('location: /oop_crud/view/create.php');

    // }
    ?>
    <div class="cursorPosition">
    <div class="container" style="width:100%;">
        <h2 class="mb-5 mt-3">Add Student Record</h2>
        <form action="<?php basename($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <div class="row g-3 mb-3">
            <div class="col">
                <label for="exampleInputEmail1" class="form-label">Student Firstname</label>
                <input type="text" class="form-control" name="first_name" placeholder="First name" aria-label="First name">
            </div>
            <div class="col">
                <label for="exampleInputEmail1" class="form-label">Student Lastname</label>
                <input type="text" class="form-control" name="last_name" placeholder="Last name" aria-label="Last name">
            </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Student Age</label>
                    <input type="number" class="form-control" name="age" placeholder="Age" aria-label="Age">
                </div>
                <div class="col">
                    <label class="form-label" for="gender">Gender</label>
                    <select class="form-control" name="gender" required>
                        <option value="">SELECT</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
                
            <button type="submit" style="width: 100%;" class="btn btn-primary">Submit</button>
        </form>   
    </div>
    </div>
    <?php include "../includes/__footer.php" ?>
    <script src="../includes/_mouseEffect.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>