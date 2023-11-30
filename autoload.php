<?php
    function load($className){
        include "controller/$className.php";
    }
    
    spl_autoload_register("load");
?>