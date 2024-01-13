<?php
include('partials/error.php');
include('partials/config.php');
include('partials/utils.php');

if(!isset($_SESSION)){
    session_start();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){


$req_id=$_POST['req_id'];
$blood_group_req=$_POST['blood_group_req'];
$quantity_req=$_POST['quantity'];
$hospital_id=$_SESSION['hospital_id'];

$blood_fetch_sql="SELECT * from hospitals WHERE hospital_id='$hospital_id'";
$result_blood_fetch_sql=mysqli_query($conn,$blood_fetch_sql);
$row_blood_fetch_sql=mysqli_fetch_assoc($result_blood_fetch_sql);
$availableQuantity=$row_blood_fetch_sql[($blood_group_req)];

if($quantity_req > $availableQuantity){
    echo $quantity_req;
    echo $availableQuantity;
    setcookie("ERROR","You can't approve this request due to insufficient blood in your bank",time()+2);
    header("location:viewRequests.php");
    exit();
}
$new_quantity=$availableQuantity-$quantity_req;
$req_update_sql="UPDATE requests SET status_req=1 WHERE req_id='$req_id'";
$result=mysqli_query($conn,$req_update_sql);
if($result){
    $blood_update_sql="UPDATE hospitals SET $blood_group_req = '$new_quantity' WHERE hospitals.hospital_id='$hospital_id'";
    $result_blood_update_sql=mysqli_query($conn,$blood_update_sql);
    // $result_blood_update_sql=mysqli_fetch_assoc($result_blood_update_sql);
    if($result_blood_update_sql){
        echo "Both queries executed";
        mysqli_commit($conn);
    }
    else{
        echo "2nd query failed to execute";
        mysqli_rollback($conn);
    }
    header("location:viewRequests.php");
}
else{
    echo "Error Approving requests. Please try again";
}
}
?>