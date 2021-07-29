<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <title>Exercise</title>

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
      <form action="" method="POST">
        <h3><strong>- Exercise -</strong></h3>
        <div class="mb-3">
          <label for="EPname" class="form-label"><strong>Exercise For Plan Name</strong></label>
          <input type="text" class="form-control" id="EPname" name="EPname" placeholder="Athlete">
        </div>
        <div class="mb-3">
          <label for="muscle" class="form-label"><strong>Muscle</strong></label>
          <input type="text" class="form-control" id="muscle" name="muscle" placeholder="Legs">
        </div>
        <div class="mb-3">
          <label for="equip" class="form-label"><strong>Equipment</strong></label>
          <input type="text" class="form-control" id="equip" name="equip" placeholder="Cycle">
        </div>
        <div class="mb-3">
          <label for="sets" class="form-label"><strong>Sets</strong></label>
          <input type="text" class="form-control" id="sets" name="sets" placeholder="6">
        </div>
        <div class="mb-3">
          <label for="reps" class="form-label"><strong>Reps</strong></label>
          <input type="text" class="form-control" id="reps" name="reps" placeholder="9">
        </div>
          <button type="submit" name="submit" class="btn btn-dark"><strong>Enter Exercise</strong></button>
      </form>
    </div>

    <?php
      if(isset($_POST['submit'])) {
        $EPname = $_POST['EPname'];
        $muscle = $_POST['muscle'];
        $equip = $_POST['equip'];
        $sets = $_POST['sets'];
        $reps = $_POST['reps'];       
        echo "$reps";
        $query = oci_parse($con, "INSERT INTO exercises(EXERCISES_PLANNAME, EXERCISES_BODY_MUSCLE_NAME, EXERCISES_EQUIPMENT_NAME, EXCERCISE_SETS, EXCERCISE_REPS)
        values ('$EPname','$muscle','$equip','$sets','$reps')");
        $result = oci_execute($query);
        echo "<br>";
        echo "<br>";
        if ($result) {
          echo "Exercise Insertion Successful.";
          $query = oci_parse($con, "commit");
          $r = oci_execute($query);
          header("Location: memberPlan.php");
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