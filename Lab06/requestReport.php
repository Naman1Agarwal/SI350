<?php

session_start();

if (isset($_SESSION['username'])){
    echo "Logged in!";
}
else{
    echo "Go log in please!";
}

?>
