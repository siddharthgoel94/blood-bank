<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$showError=false;
$update=false;
include 'partials/config.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(!isset($_SESSION['type_of_login']) || $_SESSION['type_of_login']!='hospital'){
    header("location:login.php");
}
// storing username stored in session data
$username=$_SESSION['username'];

// fetch the current details of blood samples
$sql="SELECT * from `hospitals` WHERE `username`='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$prevOpos=$row['Opos'];
$prevOneg=$row['Oneg'];
$prevApos=$row['Apos'];
$prevAneg=$row['Aneg'];
$prevBpos=$row['Bpos'];
$prevBneg=$row['Bneg'];
$prevABpos=$row['ABpos'];
$prevABneg=$row['ABneg'];
// echo $row['Opos'];


if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "Method was post";
    // $result=false;
   
    $Opos = isset($_POST["Opos"])?$_POST["Opos"]:$prevOpos;
    $Oneg = isset($_POST["Oneg"])?$_POST["Oneg"]:$prevOneg;
    $Apos = isset($_POST["Apos"])?$_POST["Apos"]:$prevApos;
    $Aneg = isset($_POST["Aneg"])?$_POST["Aneg"]:$prevAneg;
    $Bpos = isset($_POST["Bpos"])?$_POST["Bpos"]:$prevBpos;
    $Bneg = isset($_POST["Bneg"])?$_POST["Bneg"]:$prevBneg;
    $ABpos = isset($_POST["ABpos"])?$_POST["ABpos"]:$prevABpos;
    $ABneg = isset($_POST["ABneg"])?$_POST["ABneg"]:$prevABneg;
  
    // $num = mysqli_num_rows($result);
    $sql="UPDATE `hospitals` SET `Apos`='$Apos' , `Aneg`='$Aneg', `Opos`='$Opos',`Oneg`='$Oneg', `Bpos`='$Bpos', `Bneg`='$Bneg', `ABpos`='$ABpos', `ABneg`='$ABneg' WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);

     $showError=false;
     
     
     setcookie("message", "Details Updated successfully",time()+1);
     header("location:index.php");
     if(!$result){
        $showError=true;
     }
}
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <?php require 'partials/navbar.php' ?>
    <?php
    if(!$showError && $update){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> The Details are Updated Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    ?>



<div class="container my-4">
<h1 class="text-center">Welcome <?php echo $_SESSION['name'];?>
 </h1>
<p class="text-center text-muted">Here you can  add blood information of your hospital</p>
<form action="/blood-bank/addBloodInfo.php" method="post">
<div class="form-group">
       Update the quantity of blood available in your hospital (in ml)
       <div class="row">
       <div class="col-3">
        <label for="phone">O+</label>
 <input type="number" class="form-control mb-2" id="Opos" name="Opos" aria-describedby="emailHelp" placeholder="O+" value="<?php echo $prevOpos;?>"> 

</div>



    
            
           
            

            <div class="col-3">
            <label for="phone">O-</label>
            <input type="number" class="form-control mb-2 " id="Oneg" name="Oneg" aria-describedby="emailHelp" placeholder="O-" value="<?php echo $prevOneg;?>">
            </div>

            <div class="col-3">
            <label for="phone">A+</label>
            <input type="number" class="form-control mb-2 " id="Apos" name="Apos" aria-describedby="emailHelp" placeholder="A+" value="<?php echo $prevApos;?>">
            </div>

            <div class="col-3">
            <label for="phone">A-</label>
            <input type="number" class="form-control mb-2 " id="Aneg" name="Aneg" aria-describedby="emailHelp" placeholder="A-" value="<?php echo $prevAneg;?>">
            </div>

            </div>

            <div class="row">
            <div class="col-3">
            <label for="phone">B+</label>
            <input type="number" class="form-control mb-2 " id="Bpos" name="Bpos" aria-describedby="emailHelp" placeholder="B+" value="<?php echo $prevBpos;?>">
            </div>

            <div class="col-3">
            <label for="phone">B-</label>
            <input type="number" class="form-control mb-2 " id="Bneg" name="Bneg" aria-describedby="emailHelp" placeholder="B-" value="<?php echo $prevBneg;?>">
            </div>

            <div class="col-3">
            <label for="phone">AB+</label>
            <input type="number" class="form-control mb-2 " id="ABpos" name="ABpos" aria-describedby="emailHelp" placeholder="AB+" value="<?php echo $prevABpos;?>">
            </div>

            <div class="col-3">
            <label for="phone">AB-</label>
            <input type="number" class="form-control mb-2 " id="ABneg" name="ABneg" aria-describedby="emailHelp" placeholder="AB-" value="<?php echo $prevABneg;?>">
            </div>

            </div>



           
            
        </div>
       
         
        <button type="submit" class="btn btn-primary">Update details</button>
     </form>
    </div>
    <?php require 'partials/footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>