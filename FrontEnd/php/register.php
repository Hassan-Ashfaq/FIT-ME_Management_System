<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- CSS file -->
    <link rel="stylesheet" href="styles.css">
    
    <title>Register</title>

    <style>
      .box {
          position: absolute;
          top: 50%;
          left: 50%;
          margin-right: -50%;
          transform: translate(-50%, -50%);
          border: 3px solid salmon;
          padding: 50px;
      };
    </style>
  </head>
  <body>
    <?php  // creating a database connection 
          $db_sid = 
          "(DESCRIPTION =
              (ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-FM3MNF7)(PORT = 1521))
              (CONNECT_DATA =
              (SERVER = DEDICATED)
              (SERVICE_NAME = XE)
              )
          )";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
          
          $db_user = "system";   // Oracle username e.g "scott"
          $db_pass = "1234";    // Password for user e.g "1234"
          $con = oci_connect($db_user,$db_pass,$db_sid); 
          if($con) 
              { echo "Oracle Connection Successful."; } 
          else 
              { die('Could not connect to Oracle: '); }
      ?>

    <div class="box">
      <h1><strong>Register yourself and join FIT-ME!</strong></h1>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="fname" class="form-label"><strong>First Name</strong></label>
          <input type="text" class="form-control" id="fname" name="fname" placeholder="Ahmed">
        </div>
        <div class="mb-3">
          <label for="lname" class="form-label"><strong>Last Name</strong></label>
          <input type="text" class="form-control" id="lname" name="lname" placeholder="Ali">
        </div>
        <div class="mb-3">
          <label for="gender" class="form-label"><strong>Gender</strong></label>
          <input type="text" class="form-control" id="gender" name="gender" placeholder="Male">
        </div>
        <div class="mb-3">
          <label for="age" class="form-label"><strong>Age</strong></label>
          <input type="text" class="form-control" id="age" name="age" placeholder="21">
        </div>
        <div class="mb-3">
          <label for="weight" class="form-label"><strong>Weight (kg)</strong></label>
          <input type="text" class="form-control" id="weight" name="weight" placeholder="83">
        </div>
        <div class="mb-3">
          <label for="bmi" class="form-label"><strong>BMI</strong></label>
          <input type="text" class="form-control" id="bmi" name="bmi" placeholder="95">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label"><strong>Password</strong></label>
          <input type="text" class="form-control" id="password" name="password" placeholder="TYS532GKLJE">
        </div>
  
        <button type="submit" name="submit" class="btn btn-dark"><strong>Register</strong></button>
        <h1><a href="index.php" style="font-size: 20px">Go Back</a></h1>
      </form>
    </div>

    <?php
      if(isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $bmi = $_POST['bmi'];
        $weight = $_POST['weight'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];

        $query = oci_parse($con, "INSERT INTO gym_member(first_name, last_name, age, bmi, weight, gender, member_password) 
        values ('$fname','$lname','$age','$bmi','$weight','$gender','$password')");
        $result = oci_execute($query);
        echo "<br>";
        echo "<br>";
        if ($result) {
          echo "Insertion Successful.";
          $query = oci_parse($con, "commit");
          $r = oci_execute($query);
          header("Location: choosePlan.php");
        }
        else {
          echo "Insertion NOT Successful.";
        }
    }
    ?>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>