<?php session_start(); ?>
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

    <title>Student Update</title>
  </head>
  <body>
    <?php 
      include "../class/database.php";
      $database = new database();
      // Handle form submission
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Perform form validation and database insertion here
        $id = $_GET['update'];
        $database->select('students', '*', null, "id=$id", null, null);
        // $allStudent = $database->getResult();
        $records = $database->getResult();
      
      }

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
            $_SESSION['updateValidation'] = $errors;
            header('location: /oop_crud/view/index.php');
        }else{
          
          $student_id = $_POST['update_id'];
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $gender = $_POST['gender'];
          $age = $_POST['age'];
          
          $updateSuccess = $database->update('students', ['first_name'=>$first_name, 'last_name'=>$last_name, 'age'=>$age, 'gender'=>$gender], "id = $student_id");
          
          if ($updateSuccess) {
            echo '<p class="success-message">Record updated successfully!</p>';
            header("Location: http://localhost/oop_crud/index.php");
          } else {
            echo '<p class="error-message">Error adding record. Please try again.</p>';
          }
        }

      }

    ?>
    <?php include "../includes/__header.php" ?>
    <div class="container cursorPosition" style="width:100%;">
      <h2 class="mb-5 mt-3">Update Student Record</h2>
      <form action="./update.php" method="POST" enctype="multipart/form-data">
        <div class="row g-3 mb-3">
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Student Firstname</label>
            <input type="text" class="form-control" name="first_name" placeholder="First name" aria-label="First name" value="<?php echo isset($records[0]['first_name'])? $records[0]['first_name']:""; ?>" >
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Student Lastname</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last name" aria-label="Last name" value="<?php echo isset($records[0]['last_name'])? $records[0]['last_name']:""; ?>">
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">Gender</label>
            <select class="form-control" name="gender" required>
            <option value="male" <?php if($records[0]['gender'] == 'male') echo 'selected';; ?>>Male</option>
            <option value="female" <?php if($records[0]['gender'] == 'female') echo 'selected'; ?>>Female</option>
            <option value="other" <?php if($records[0]['gender'] == 'other') echo 'selected'; ?>>Other</option>
            </select>
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Student Age</label>
            <input type="number" class="form-control" name="age" placeholder="date" aria-label="age" value="<?php echo isset($records[0]['age'])? $records[0]['age']:""; ?>">
          </div>
        </div>
               
        <button type="submit" class="btn btn-primary w-100" name="update_id" value="<?php echo $records[0]['id']; ?>">Update Record</button>
      </form>
    </div>
    <?php include "../includes/__footer.php" ?>
    <script src="../includes/_mouseEffect.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
