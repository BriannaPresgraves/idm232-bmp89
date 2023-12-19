<?php
consoleMsg("fun.php file LOADED!");

//Define All Global Vars Here
global $APP_CONFIG;

function consoleMsg($msg) {
    echo '<script type="text/javascript">console.log("'. $msg .'");</script>';
}

function echoSearchValue() {
    if(isset($_POST['search'])) {
        echo $_POST['search'];
    }
}
?>