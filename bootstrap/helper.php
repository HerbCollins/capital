<?php

function generateOrderId()
{
    return time().rand(100000,999999);
}

?>