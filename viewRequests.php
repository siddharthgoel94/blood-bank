<?php
include('partials/error.php');
include('partials/config.php');
include('partials/utils.php');

if(!isset($_SESSION)){
    session_start();
}
$hospital_id=$_SESSION['hospital_id'];
if($_SERVER["REQUEST_METHOD"]=="GET"){
    if(isset($_GET['type_of_request'])){
        $type_of_request=$_GET['type_of_request'];
    }
    else{
        $type_of_request=0;
    }
    
}
$sql="SELECT users.name , users.phone_no , requests.quantity, requests.blood_group_req, requests.status_req, requests.time_req,requests.req_id FROM requests,users WHERE requests.user_id=users.user_id AND hospital_id='$hospital_id' AND status_req='$type_of_request'";
// 'users.name' , 'users.phone_no' , 'requests.quantity', 'requests.blood_group_req', 'requests.status_req'
$result=mysqli_query($conn,$sql);
$num_rows=mysqli_num_rows($result);
// echo $result;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <link rel="stylesheet" href="css/bootstrap.css">
	<!-- Bootstrap-Core-CSS -->
	<!-- <link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> -->
	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">

</head>
<body>
   

<?php include('partials/navbar.php');?>

<?php
if(isset($_COOKIE['ERROR'])){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $_COOKIE['ERROR'].'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
?>

<h1 class="text-center">View Blood Bank Requests</h1>
<form action="viewRequests.php" method="get" name="request_filter" class="d-flex justify-content-end mr-4">
    <div class="input-group w-25 mb-5 mt-3 ">
<div class="input-group-prepend">
    <label class="input-group-text" for="type_of_request">Select type of request</label>
  </div>
    <select name="type_of_request" class="custom-select" id="type_of_request" onchange="submitForm()">
        <!-- <option value="-2" <?php echo ($type_of_request!=1)?'selected':''?>Select a category</option> -->
        <option value="1" <?php echo ($type_of_request==1)?'selected':''?> >Approved</option>
        <option value="0" <?php echo ($type_of_request==0)?'selected':''?> >Pending</option>
        <option value="-1" <?php echo ($type_of_request==-1)?'selected':''?>>Rejected</option>
    </select>
    </div>
    <!-- <button type="submit" class="btn btn-primary mx-2">Apply Filter</button> -->
</form>

<script>
function submitForm(){
    const request_filter=document.request_filter.submit();
}
    </script>

<?php

if($num_rows==0){
    echo '<h4 class="text-center mt-2">No requests pending for your blood bank</h4>';
}
else{



   echo '<div class="d-flex align-items-center justify-content-center">


<table class="table table-bordered table-hover" style="width:80%;">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col" >Name</th>
      <th scope="col" >Blood Group Requested</th>
      <th scope="col">Quantity Requested</th>
      <th scope="col">Status</th>
      <th scope="col">Time of request</th>';
if($type_of_request==0){
    echo' <th scope="col">Action</th>';
}
     
     
   echo ' </tr>
  </thead>
  <tbody>
  ';
  $idx=1;
  while($row=mysqli_fetch_assoc($result)){
    $timestamp=$row['time_req'];
   echo ' <tr>
      <th scope="row">'.$idx.'</th>
      <td>'.$row['name'].'</td>
      <td>'.($blood_groups[($row['blood_group_req'])]).'</td>
      <td>'.$row['quantity'].'</td>
      <td>'.($row['status_req']==0?'Pending':($row['status_req']==1?'Approved':'Rejected')).'</td>
      <td>'.$timestamp.'</td>';
      if($type_of_request==0){
        echo'<td><form action="approveRequest.php" method="POST">
        <input type="hidden" name="req_id" value='.$row['req_id'].'>
        <input type="hidden" name="quantity" value='.$row['quantity'].'>
        <input type="hidden" name="blood_group_req" value='.$row['blood_group_req'].'>
         <button type="submit" class="btn btn-success">Approve</button>
        <button formaction="rejectRequest.php" class="btn btn-danger">Reject</button></td>
       
      </tr> ';
    }
    $idx++;

  }
 echo ' </tbody>
</table>
</div>';
}
?>



<?php include('partials/footer.php');?>
<script src="js/jquery-2.2.3.min.js"></script>
	<!-- Default-JavaScript-File -->

	<!-- banner slider -->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		$(function () {
			$("#slider4").responsiveSlides({
				auto: true,
				pager: true,
				nav: true,
				speed: 1000,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});
		});
	</script>
	<!-- //banner slider -->

	<!-- fixed navigation -->
	<script src="js/fixed-nav.js"></script>
	<!-- //fixed navigation -->

	<!-- smooth scrolling -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- move-top -->
	<script src="js/move-top.js"></script>
	<!-- easing -->
	<script src="js/easing.js"></script>
	<!--  necessary snippets for few javascript files -->
	<script src="js/medic.js"></script>

	<script src="js/bootstrap.js"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<!-- //Js files -->
</body>
</html>