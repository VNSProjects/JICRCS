<?php
function component($position, $companyName, $location, $link)
{
    $elements = "
    <div class=\"col-md-6 col-sm-12 my-3\">
        <div class=\"card shadow h-100\" style=\"padding: 5%;\">

            <h2><strong class=\"mt-4\"> $position</strong></h2>
            <h5 style=\"color: grey;\">Company:<strong>$companyName</strong></h5>
            <h5 style=\"color: grey;\">Location:<strong>$location</strong></h5>
            <button class=\"btn btn-success my-4\"><a style=\"text-decoration:none;color:#fff;\"href=\"$link\" target=\"_blank\">View Job</a> </button>        
      </div>
    </div>
    
    ";
    echo $elements;
}
?>

