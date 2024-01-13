<?php
include('partials/error.php');
include('partials/config.php');
include('partials/utils.php');

// different kinds of errors


// session_start();
$sql="SELECT * from hospitals";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

if(!isset($_SESSION)){
    session_start();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Handling the case when user is not logged in
    if(isset($_SESSION) && !isset($_SESSION['username'])){
        // $showUserError=true;
        setcookie("type_of_error", "not-logged-in", time()+1);
        // $_COOKIE['type_of_error']="not-logged-in";
        header("location:login.php");
        exit();
    }
    // handling the case to avoid hospitals from clicking the request button
    if(isset($_SESSION) && ($_SESSION['type_of_login']=="hospital")){
        // setcookie("type_of_error", "not-user-logged-in", time()+1);
        setcookie("ERROR", "You need to login as a user to request blood samples", time()+1);
        header("location:availableBloodSamples.php");
        exit();
    }
    

    // start handling the user's request and add an entry in the request's table
   $hospital_id = $_POST['hospital_id']; // the hospital id from which blood is requested
   $blood_group = $_POST[$hospital_id];  // the requested blood group
   $quantity = $_POST['quantity'];      // the requested quantity
   $user_id=$_SESSION['user_id'];       // the user id of user currently logged in
   $req_id=uniqid("req");              // a unique id for request
  

   $blood_grp_sql="SELECT * FROM users WHERE user_id='$user_id'";
   $blood_group_result = mysqli_query($conn, $blood_grp_sql);
   while($record=mysqli_fetch_assoc($blood_group_result)){
    $user_blood_group=$record['blood_group'];
   }
   

if(!check_eligibility($user_blood_group,$blood_group)){
    //    echo $hospital_id;
    setcookie("ERROR", "You are not eligible to request this blood sample due to a biological mismatch", time()+1);
    header("location:availableBloodSamples.php");
    exit();
}
else{
    if(!isset($_POST[$hospital_id])){
        setcookie("ERROR", "No blood group selected to be requested", time()+1);
        header("location:availableBloodSamples.php");
        exit();
       }
    
       else{
        // first get all req and check whether the same request is made before and is pending or not
        $get_all_req_sql="SELECT * from requests WHERE user_id='$user_id' AND blood_group_req='$blood_group' AND hospital_id='$hospital_id' AND status_req='0'";
        $get_all_req_result=mysqli_query($conn,$get_all_req_sql);
        $num_req = mysqli_num_rows($get_all_req_result);
        


        if($num_req!=0){
        setcookie("ERROR", "Your request for this particular blood group in this hospital is already submitted", time()+1);
        header("location:availableBloodSamples.php");
        exit();
        }
        else if(!isset($quantity) || $quantity=="" || $quantity<='0'){
            setcookie("ERROR", "Please enter a valid quantity of blood group to be requested", time()+1);
            header("location:availableBloodSamples.php");
            exit();
            
        }
        else{
            $insert_req_sql="INSERT INTO `requests` (`req_id`, `hospital_id`, `user_id`, `blood_group_req`, `quantity`, `status_req`) VALUES ('$req_id', '$hospital_id', '$user_id', '$blood_group', '$quantity', '0')";
            $insert_req_result=mysqli_query($conn, $insert_req_sql);
            if($insert_req_result){
                // echo "Record inserted successfully";
                header("location:success.php");
                exit();
            }
        }
       }
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

// if(isset($_COOKIE['type_of_error']) && $_COOKIE['type_of_error']=="not-user-logged-in"){
    
    
//     $showHospitalErrorText="You need to login as a User to be able to request a blood sample";
//     echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
//     <strong>Error!</strong> '. $showHospitalErrorText.'
//     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//         <span aria-hidden="true">&times;</span>
//     </button>
// </div> ';

// }
if(isset($_COOKIE['ERROR'])){
    
    
    // $showHospitalErrorText="You need to login as a User to be able to request a blood sample";
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error! the request can not be processed due to </strong> '. $_COOKIE['ERROR'].'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> ';

}
// if(isset($biological_error)){
    
    
//     $biological_error="There is a biological mismatch due to which you cant request this blood sample";
//     echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
//     <strong>Error!</strong> '. $biological_error.'
//     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//         <span aria-hidden="true">&times;</span>
//     </button>
// </div> ';
// $biological_error=false;

// }
?>

<h1 class="text-center mt-4">Blood group Availability</h1>
<p class="text-muted text-center">Here you can find the availability of all the blood groups in all hospitals</p>
<table class="table table-hover mt-2 ">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name Of Hospital</th>
      <!-- <th scope="col">Contact</th> -->
      <th scope="col">O+</th>
      <th scope="col">O-</th>
      <th scope="col">A+</th>
      <th scope="col">A-</th>
      <th scope="col">B+</th>
      <th scope="col">B-</th>
      <th scope="col">AB+</th>
      <th scope="col">AB-</th>
      <th style="width:10%;" scope="col">Quantity</th>
      <th scope="col">Request?</th>
      <!-- <th scope="col">O+</th> -->
    </tr>
  </thead>
  <tbody>
    <?php
    // echo $result[0]['name'];
    if($num>=1){
        $idx=1;
        while($row=mysqli_fetch_assoc($result)){
            // echo $row['name'];
           
            echo '<tr>';
            echo '<form action="availableBloodSamples.php" method="POST">';
            // adding some hidden inputs for data processing at server
            echo '<input type="hidden" value='.$row['hospital_id'].' name="hospital_id" />';
            echo '<th scope="col">'.$idx.'</th>';
            echo '<td scope="col">'.$row['name'].'</td>';
            // echo '<td scope="col">'.$row['contact'].'</td>';
            echo '<td scope="col">'.$row['Opos'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="Opos" value="Opos"> </td>';
            echo '<td scope="col">'.$row['Oneg'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="Oneg" value="Oneg" checked></td>';
            echo '<td scope="col">'.$row['Apos'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="Apos" value="Apos"></td>';
            echo '<td scope="col">'.$row['Aneg'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="Aneg" value="Aneg"></td>';
            echo '<td scope="col">'.$row['Bpos'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="Bpos" value="Bpos"></td>';
            echo '<td scope="col">'.$row['Bneg'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="Bneg" value="Bneg"></td>';
            echo '<td scope="col">'.$row['ABpos'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="ABpos" value="ABpos"></td>';
            echo '<td scope="col">'.$row['ABneg'].' ml <input class="form-check-input mx-auto" type="radio" name="'.$row['hospital_id'].'" id="ABneg" value="ABneg"></td>';
            echo '<td scope="col"> <input style="width:70%;" class="form-control mx-auto" type="number" name="quantity" id="quantity" placeholder="ml"></td>';
            echo '<td><button type="submit" class="btn btn-warning">Request Sample</button></td>';
            echo '</form>';
            
          echo '</tr>';
        //   idx++;
        $idx++;
    }
    }
    ?>
    
    
    
  </tbody>
</table>


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
	<!-- <script src="js/SmoothScroll.min.js"></script> -->
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