<?php
$showAlert = false;
$showError = false;
include 'partials/error.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/config.php';
    $name = $_POST["name"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];

// All the blood groups quantity

    $Opos = ($_POST["Opos"]!="")?$_POST["Opos"]:0;
    $Oneg = ($_POST["Oneg"]!="")?$_POST["Oneg"]:0;
    $Apos = ($_POST["Apos"]!="")?$_POST["Apos"]:0;
    $Aneg = ($_POST["Aneg"]!="")?$_POST["Aneg"]:0;
    $Bpos = ($_POST["Bpos"]!="")?$_POST["Bpos"]:0;
    $Bneg = ($_POST["Bneg"]!="")?$_POST["Bneg"]:0;
    $ABpos = ($_POST["ABpos"]!="")?$_POST["ABpos"]:0;
    $ABneg = ($_POST["ABneg"]!="")?$_POST["ABneg"]:0;

    

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
   
   
   
    // $blood_group = $_POST["blood_group"];
    $hospital_id=uniqid("hospital");
    
    
    // $exists=false;
    $existSql = "SELECT * FROM `hospitals` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
    if(($password == $cpassword)){
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `hospitals` (`hospital_id`, `name`, `username`, `password`, `contact`, `address`, `Apos`, `Aneg`, `Opos`, `Oneg`, `Bpos`, `Bneg`, `ABpos`, `ABneg`, `timestamp`) VALUES ('$hospital_id', '$name', '$username', '$hash', '$contact', '$address', '$Apos', '$Aneg', '$Opos', '$Oneg', '$Bpos', '$Bneg', '$ABpos', '$ABneg', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
        }
    }
    else{
        $showError = "Passwords do not match";
    }
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

    <title>SignUp</title>
  </head>
  <body>
    <?php require 'partials/navbar.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>

    <div class="container my-4">
     <h1 class="text-center">Signup As a Hospital</h1>
     <form action="/blood-bank/registerHospital.php" method="post">
        <p class="text-muted mt-5">Enter the following details to register your hospital</p>
        <div class="input-group">
        <div class="input-group-prepend w-50">
    <span class="input-group-text">Name Of Hospital</span>
  <!-- </div>
            <span><label for="name"> Name Of Hospital</label> -->
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name here"required>
            <!-- </span> -->
        </div>
</div>

       
       
        <div class="input-group mt-5">
        <div class="input-group-prepend w-50">
    <span class="input-group-text">Enter Address</span>
            <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp" placeholder="Please enter full address"required>
            
        </div>
        </div>


        <div class="input-group mt-5">
        <div class="input-group-prepend w-50">
        <span class="input-group-text">Enter Contact No</span>
           
            <input type="text" class="form-control" id="contact" name="contact" aria-describedby="emailHelp" placeholder="0000000000" required>
            
        </div>
        </div>

        <div class="form-group">
            <p class="text-muted">Please enter the quantity of the following blood groups your hospital is having <b>at the time of registration (in ml) </b> </p>
            <div class="row">
            <div class="col-3">
            <!-- <label for="phone">O+</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="Opos" name="Opos" aria-describedby="emailHelp" placeholder="O+">
            
            </div>

            <div class="col-3">
            <!-- <label for="phone">O-</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="Oneg" name="Oneg" aria-describedby="emailHelp" placeholder="O-">
            </div>

            <div class="col-3">
            <!-- <label for="phone">A+</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="Apos" name="Apos" aria-describedby="emailHelp" placeholder="A+">
            </div>

            <div class="col-3">
            <!-- <label for="phone">A-</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="Aneg" name="Aneg" aria-describedby="emailHelp" placeholder="A-">
            </div>

            </div>

            <div class="row">
            <div class="col-3">
            <!-- <label for="phone">B+</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="Bpos" name="Bpos" aria-describedby="emailHelp" placeholder="B+">
            </div>

            <div class="col-3">
            <!-- <label for="phone">B-</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="Bneg" name="Bneg" aria-describedby="emailHelp" placeholder="B-">
            </div>

            <div class="col-3">
            <!-- <label for="phone">AB+</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="ABpos" name="ABpos" aria-describedby="emailHelp" placeholder="AB+">
            </div>

            <div class="col-3">
            <!-- <label for="phone">AB-</label> -->
            <input type="number" class="form-control mb-2 mt-2" id="ABneg" name="ABneg" aria-describedby="emailHelp" placeholder="AB-">
            </div>

            </div>



           
            
        </div>

       <p class="text-muted">Create your login details</p>

       <div class="input-group mt-2 ">
        <div class="input-group-prepend w-50">
    <span class="input-group-text">Enter username</span>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Your username here" required>
            
        </div>
        </div>

       <div class="input-group mt-5">
        <div class="input-group-prepend w-50">
    <span class="input-group-text">Enter password</span>
            <input type="password" class="form-control" id="password" name="password"  placeholder="Your password here" required>
        </div>
        </div>
        
        <div class="input-group mt-5">
        <div class="input-group-prepend w-50">
    <span class="input-group-text">Confirm Password</span>
            <input type="password" class="form-control" id="cpassword" name="cpassword"  placeholder="Please make sure to enter same password" required>
            <br>
            <!-- <id="emailHelp" class="form-text text-muted">Make sure to type the same password</p> -->
        </div>
        </div>
        
         
        <button type="submit" class="btn btn-primary mt-4">SignUp</button>
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
