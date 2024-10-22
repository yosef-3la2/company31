<?php

define('BASE_URL','http://localhost/company/');

function URL($var=NULL)
{
    return BASE_URL.$var;
}

function path($var=null)
{
    $location=BASE_URL.$var;
    echo"
    <script>
    window.location.replace('$location')
    </script>
    ";
}

function filterstring($input_value){

    $input_value=trim($input_value);
    $input_value=strip_tags($input_value);
    $input_value=htmlspecialchars($input_value);
    $input_value=stripslashes($input_value);
    return $input_value;
}

function stringvalidation($input_value,$min){
    $empty=empty($input_value);
    $length=strlen($input_value)<$min;
    if($empty||$length){
        return true;
    }
    else{
        return false;
    }
}

function imagevalidation($imagename,$imagesize,$limitsize)
{
    $size=($imagesize/1024)/1024;
    $isbigger=$size>$limitsize;
    $empty=empty($imagename);
    if($empty||$isbigger){
        return true;
    }
    else
    {
        return false;
    }
}
?>

