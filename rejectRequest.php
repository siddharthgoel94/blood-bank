<?php
include('partials/error.php');
include('partials/config.php');
include('partials/utils.php');

if(!isset($_SESSION)){
    session_start();
}
echo "You have linked the php file";
if($_SERVER["REQUEST_METHOD"] == "POST"){

$req_id=$_POST['req_id'];
$sql="UPDATE requests SET status_req=-1 WHERE req_id='$req_id'";
$result=mysqli_query($conn,$sql);
if($result){
    header("location:viewRequests.php");
}
}
?>