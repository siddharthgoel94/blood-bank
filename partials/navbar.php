<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $type_of_login=$_SESSION['type_of_login'];
  // session_start();
}
else{
  $loggedin = false;
}
echo '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/blood-bank/index.php">Blood-Bank</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="/blood-bank/index.php">Home </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/blood-bank/availableBloodSamples.php">Available Blood Samples </a>
      </li>
      ';

      if(!$loggedin){
      echo '<li class="nav-item">
        <a class="nav-link" href="/blood-bank/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/blood-bank/registerUser.php">Signup as a user</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/blood-bank/registerHospital.php">Signup as a Hospital</a>
      </li>
      ';
      }
      if($loggedin){

      if($type_of_login=="hospital"){
        echo '<li class="nav-item">
        <a class="nav-link" href="/blood-bank/addBloodInfo.php">Add blood info</a>
      </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="/blood-bank/viewRequests.php">View Requests</a>
      </li>
      
      ';
     
      }
      echo '<li class="nav-item">
        <a class="nav-link" href="/blood-bank/logout.php">Logout</a>
      </li>
      ';
      
    
       
      
// echo $_SESSION['loggedin'];
     
    echo'</ul><span class="mr-sm-2 text-white"> Welcome '.$_SESSION['name'].'</span>';
      }
      
 echo' </div>
</nav>';
      // }
?>