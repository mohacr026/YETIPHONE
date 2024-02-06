<?php 

require_once './model/database.php';

class CanvasController {
    public function signature(){
        include("./view/adminSignature/adminSignature.php");
    }
}

?>