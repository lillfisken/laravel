<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    echo 'POST';
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    echo 'GET';
}
else
{
    echo 'ERROR';
}
