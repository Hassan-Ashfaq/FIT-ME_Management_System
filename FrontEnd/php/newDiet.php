<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <title>Diet</title>

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
        <h3><strong>- Diet -</strong></h3>
        <div class="mb-3">
          <label for="calories" class="form-label"><strong>Calories</strong></label>
          <input type="text" class="form-control" id="calories" name="calories" placeholder="10">
        </div>
        <div class="mb-3">
          <label for="protein" class="form-label"><strong>Protein</strong></label>
          <input type="text" class="form-control" id="protein" name="protein" placeholder="20">
        </div>
        <div class="mb-3">
          <label for="carbs" class="form-label"><strong>Carbohydrates</strong></label>
          <input type="text" class="form-control" id="carbs" name="carbs" placeholder="30">
        </div>
        <div class="mb-3">
          <label for="fat" class="form-label"><strong>Fat</strong></label>
          <input type="text" class="form-control" id="fat" name="fat" placeholder="40">
        </div>
        <div class="mb-3">
          <label for="Dname" class="form-label"><strong>Diet Name</strong></label>
          <input type="text" class="form-control" id="Dname" name="Dname" placeholder="Athlete">
        </div>
          <button type="submit" name="submit" class="btn btn-dark"><strong>Enter Plan Details</strong></button>
        </form>
    </div>

    <?php
      if(isset($_POST['submit'])) {
        $calories = $_POST['calories'];
        $protein = $_POST['protein'];
        $carbs = $_POST['carbs'];
        $fat = $_POST['fat'];
        $Dname = $_POST['Dname'];

        $query = oci_parse($con, "INSERT INTO gym_diet(calories, protein, carbohydrates, fat, gym_diet_name) 
        values ('$calories','$protein','$carbs','$fat','$Dname')");
        $result = oci_execute($query);
        echo "<br>";
        echo "<br>";
        if ($result) {
          echo "Diet Insertion Successful.";
          $query = oci_parse($con, "commit");
          $r = oci_execute($query);
          header("Location: newGymPlan.php");
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