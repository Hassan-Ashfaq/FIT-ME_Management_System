<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <title>Log</title>

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
        <h1><strong>Great Job! Enter your today's activity log.</strong></h1>
        <form action="" method="POST">
          <div class="mb-3">
            <label for="memID" class="form-label"><strong>Member ID</strong></label>
            <input type="text" class="form-control" id="memID" name="memID" placeholder="1">
          </div>
          <div class="mb-3">
            <label for="plan" class="form-label"><strong>Plan Name</strong></label>
            <input type="text" class="form-control" id="plan" name="plan" placeholder="Boxing">
          </div>
          <div class="mb-3">
            <label for="hours" class="form-label"><strong>Hours Done</strong></label>
            <input type="text" class="form-control" id="hours" name="hours" placeholder="1">
          </div>
          <div class="mb-3">
            <label for="weight" class="form-label"><strong>Current Weight (kg)</strong></label>
            <input type="text" class="form-control" id="weight" name="weight" placeholder="78">
          </div>
          <div class="mb-3">
            <label for="protein" class="form-label"><strong>Protein Intake (g)</strong></label>
            <input type="text" class="form-control" id="protein" name="protein" placeholder="27">
          </div>
          <div class="mb-3">
            <label for="fat" class="form-label"><strong>Fat Intake (g)</strong></label>
            <input type="text" class="form-control" id="fat" name="fat" placeholder="14">
          </div>
          <div class="mb-3">
            <label for="carbo" class="form-label"><strong>Carbohydrates Intake (g)</strong></label>
            <input type="text" class="form-control" id="carbo" name="carbo" placeholder="2.6">
          </div>
          <div class="mb-3">
            <label for="calories" class="form-label"><strong>Calories Intake</strong></label>
            <input type="text" class="form-control" id="calories" name="calories" placeholder="80">
          </div>
          <div class="mb-3">
            <label for="bmi" class="form-label"><strong>Current BMI</strong></label>
            <input type="text" class="form-control" id="bmi" name="bmi" placeholder="80">
          </div>
    
          <button type="submit" name="submit" class="btn btn-dark"><strong>Submit</strong></button>
        </form>

        <h1><a href="home.php" style="font-size: 20px">Go Back</a></h1>
    </div>

    <?php
      if(isset($_POST['submit'])) {
        $memID = $_POST['memID'];
        $plan = $_POST['plan'];
        $hours = $_POST['hours'];
        $weight = $_POST['weight'];
        $protein = $_POST['protein'];
        $fat = $_POST['fat'];
        $carbo = $_POST['carbo'];
        $calories = $_POST['calories'];
        $bmi = $_POST['bmi'];

        $query = oci_parse($con, "INSERT INTO logs(LOG_MEMBER_ID, LOG_PLANNAME, HOURSDONE, CURRENTWEIGHT, PROTEININTAKE, FATINTAKE, CARBSINTAKE, CALORIESINTAKE, CURRENTBMI) 
        values ('$memID','$plan','$hours','$weight','$protein', '$fat', '$carbo', '$calories', '$bmi')");
        $result = oci_execute($query);
        echo "hello";
        echo "<br>";
        echo "<br>";
        if ($result) {
          echo "Log Insertion Successful.";
          $query = oci_parse($con, "commit");
          $r = oci_execute($query);
          header("Location: print_logs.php");
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