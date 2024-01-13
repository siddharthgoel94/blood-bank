<?php
$login = false;
$showError = false;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/config.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    $type_of_login=$_POST["type_of_login"];
    // $sql=false;
     if($type_of_login=="user"){
        $sql = "Select * from users where username='$username'";
     }
     else{
        $sql = "Select * from hospitals where username='$username'";
     }
   
    
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password,$row['password'])){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['type_of_login'] = $type_of_login;
                $_SESSION['name'] = $row['name'];
                if($type_of_login=='user'){
                    $_SESSION['user_id'] = $row['user_id'];
                }
                else{
                    $_SESSION['hospital_id'] = $row['hospital_id'];
                }
                
                header("location:index.php");
            } 
            else{
                echo $row['username'].'.'.$row['password'].'<br>';
                echo $username.'.'.$password;
                $showError = "Invalid Credentials";
            }
        }
        
    } 
    else{
        echo "record not found";
        $showError = "Invalid Credentials";
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
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
  </head>
  <body>
    <main>
    <?php require 'partials/navbar.php' ?>
    <?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
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
    if(isset($_COOKIE['type_of_error']) && $_COOKIE['type_of_error']=="not-logged-in"){
        $showUserErrorText="You need to login first to be able to request a blood sample";
    
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showUserErrorText.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    
    }

    
    ?>

    <div class="container my-4">
     <h1 class="text-center">Login to our website</h1>
     <form action="/blood-bank/login.php" method="post" class="d-flex align-items-center justify-content-center flex-column">
     <div class="input-group w-25 mb-5 mt-3 ">
<div class="input-group-prepend">
    <label class="input-group-text" for="type_of_request">Login As</label>
  </div>
    <select name="type_of_login" class="custom-select" id="type_of_login">
        <option selected value="user">User</option>
            <option value="hospital">Hospital</option>
        
    </select>
    </div>
    
   
      
        <div class="form-group w-50">
            
            
             <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Username</div>
        </div>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username here">
      </div>
        </div>
        
        
        <div class="form-group w-50">
            <!--<label for="password">Password</label>-->
            <!--<input type="password" class="form-control" id="password" name="password">-->
            
             <label class="sr-only" for="password">Password</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Password</div>
        </div>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password here">
      </div>
      
      
        </div>
       
         
        <button type="submit" class="btn btn-primary">Login</button>
     </form>
    </div>
</main>
    <?php require 'partials/footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>