<?php 
    include("common.php");
    getTargetHTML($_POST['url'] ?? $_GET['url'], $_POST['useragent_type'] ?? $_GET['useragent_type']);