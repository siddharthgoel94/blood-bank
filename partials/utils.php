<?php
$blood_groups=array(
    "Opos"=>"O+",
    "Oneg"=>"O-",
    "Apos"=>"A+",
    "Aneg"=>"A-",
    "Bpos"=>"B+",
    "Bneg"=>"B-",
    "ABpos"=>"AB+",
    "ABneg"=>"AB-"
);

function check_eligibility($grp_R,$grp_D)
{
    // grp_R is receivers blood_group and grp_D is donor's blood group
    if(str_contains($grp_R,"neg") && str_contains($grp_D,"pos")){
        return false;
    }
    $grp_R=substr($grp_R,0,-3);
    $grp_D=substr($grp_D,0,-3);
    if($grp_R=="O" && $grp_D=="O")return true;
    else if($grp_R=="A" && ($grp_D=="O" || $grp_D=="A")) return true;
    else if($grp_R=="B" && ($grp_D=="O" || $grp_D=="B")) return true;
    else if($grp_R=="AB" && ($grp_D=="O" || $grp_D=="B" || $grp_D=="A" || $grp_D=="AB")) return true;
    return false;
}

?>