<?php

function generateOrderId()
{
    return time().rand(100000,999999);
}

function isMob($phone){
    if(preg_match("/^1[34578]{1}\d{9}$/" , $phone)){
        return true;
    }else{
        return false;
    }
}


?>