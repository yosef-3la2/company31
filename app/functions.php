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