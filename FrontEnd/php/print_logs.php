<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Logs Report</title>

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

    <center>
        <br>
        <br>
        <br>
        <form action="" method="POST">
            <label for="id">Enter Member ID: </label>
            <input type="text" name="id" />
            <input type="submit" name="search" value="Search The Record">

            <h1><a href="reports.php" style="font-size: 20px">Go Back</a></h1>
        </form>
        <br>
        <?php
        if(isset($_POST['search'])) {
            echo "<h3><strong> Logs </strong></h3>";
            $id = $_POST['id'];
            $q = "select * from logs where LOG_MEMBER_ID = '$id'";
            $query = oci_parse($con, $q);
            $r = oci_execute($query);
            while($row = oci_fetch_array($query, OCI_BOTH+OCI_RETURN_NULLS)) {
                echo "<strong> Plan Name: </strong>";
                echo $row['LOG_PLANNAME'];
                echo "<br>";
                echo "<strong> Hours Done: </strong>";
                echo $row['HOURSDONE'];
                echo "<br>";
                echo "<strong> Current Weight: </strong>";
                echo $row['CURRENTWEIGHT'];
                echo "<br>";
                echo "<strong> Current BMI: </strong>";
                echo $row['CURRENTBMI'];
                echo "<br>";
                echo "<strong> Protein Intake: </strong>";
                echo $row['PROTEININTAKE'];
                echo "<br>";
                echo "<strong> Fat Intake: </strong>";
                echo $row['FATINTAKE'];
                echo "<br>";
                echo "<strong> Carbohydrates Intake: </strong>";
                echo $row['CARBSINTAKE'];
                echo "<br>";
                echo "<strong> Calories Intake: </strong>";
                echo $row['CALORIESINTAKE'];
                echo "<br>-----<br>";
            }
        }
        ?>
        <br>
        <?php
        if(isset($_POST['search'])) {
            echo "<h3><strong> Targets </strong></h3>";
            $id = $_POST['id'];
            $q = "select * from member_plan where MEMBER_PLAN_ID = '$id'";
            $query = oci_parse($con, $q);
            $r = oci_execute($query);
            while($row = oci_fetch_array($query, OCI_BOTH+OCI_RETURN_NULLS)) {
                echo "<strong> Plan Name: </strong>";
                echo $row['MEMBER_PLAN_NAME'];
                echo "<br>";
                echo "<strong> Target Hours: </strong>";
                echo $row['TARGETHOURS'];
                echo "<br>";
                echo "<strong> Target Weight: </strong>";
                echo $row['TARGETWEIGHT'];
                echo "<br>";
                echo "<strong> Target BMI: </strong>";
                echo $row['TARGETBMI'];
                echo "<br>";
                echo "<strong> Target Protein: </strong>";
                echo $row['TARGETPROTEIN'];
                echo "<br>";
                echo "<strong> Target Fat: </strong>";
                echo $row['TARGETFAT'];
                echo "<br>";
                echo "<strong> Target Carbohydrates: </strong>";
                echo $row['TARGETCARBOHYDRATES'];
                echo "<br>";
                echo "<strong> Target Calories: </strong>";
                echo $row['TARGETCALORIES'];
            }
        }
        ?>
    </center>
    
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