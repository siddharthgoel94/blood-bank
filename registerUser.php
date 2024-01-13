<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/config.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $blood_group = $_POST["blood_group"];
    $user_id=uniqid("user");

    
    
    // $exists=false;
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
    if(($password == $cpassword)){
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` ( `user_id`, `name`, `blood_group`, `username`, `password`, `address`, `phone_no`) VALUES ('$user_id', '$name','$blood_group','$username','$hash','$address','$phone')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
            header("location:login.php");
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
     <h1 class="text-center">Signup As a User</h1>
     <form action="/blood-bank/registerUser.php" method="post">
     <div class="form-group w-50 mt-2">
             <label class="sr-only" for="name">Name</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Name</div>
        </div>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here">
      </div>
        </div>
        
        
        <div class="input-group w-25 mb-5 mt-3 ">
<div class="input-group-prepend">
    <label class="input-group-text" for="blood_group">Blood Group</label>
  </div>
    <select name="blood_group" class="custom-select" id="blood_group">
       <option selected value="Opos">O+</option>
            <option value="Oneg">O-</option>
            <option value="Apos">A+</option>
            <option value="Aneg">A-</option>
            <option value="Bpos">B+</option>
            <option value="Bneg">B-</option>
            <option value="ABpos">AB+</option>
            <option value="ABneg">AB-</option>
        
    </select>
    </div>
    
         <div class="form-group w-50">
             <label class="sr-only" for="address">Address</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Address</div>
        </div>
        
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address here">
      </div>
        </div>
        

        <!--<div class="form-group">-->
        <!--    <label for="phone">Phone</label>-->
        <!--    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp">-->
            
        <!--</div>-->
        
        <div class="form-group w-50">
             <label class="sr-only" for="phone">Phone No.</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Phone No.</div>
        </div>
        
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone No. here">
      </div>
        </div>
        
       
        <!--<div class="form-group">-->
        <!--    <label for="username">Username</label>-->
        <!--    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">-->
            
        <!--</div>-->
        
        <div class="form-group w-50">
             <label class="sr-only" for="username">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Username</div>
        </div>
        
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username here">
      </div>
        </div>
        
        
        <!--<div class="form-group">-->
        <!--    <label for="password">Password</label>-->
        <!--    <input type="password" class="form-control" id="password" name="password">-->
        <!--</div>-->
        
        <div class="form-group w-50">
             <label class="sr-only" for="password">Password</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Password</div>
        </div>
        
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password here">
      </div>
        </div>
        
        
        <!--<div class="form-group">-->
        <!--    <label for="cpassword">Confirm Password</label>-->
        <!--    <input type="password" class="form-control" id="cpassword" name="cpassword">-->
        <!--    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>-->
        <!--</div>-->
        
        <div class="form-group w-50">
             <label class="sr-only" for="cpassword">Confirm Password</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Confirm Password</div>
        </div>
        
        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Make sure both passwords match">
      </div>
        </div>
        
        
         
        <button type="submit" class="btn btn-primary">SignUp</button>
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
