<?php
    include 'helpers.php';
function write_log($action,$statement,$otheruser,$message){
    $date = date("Y-m-d H:i:s");
    $ip = $_SERVER["REMOTE_ADDR"];
    $user = current_user();


    if ($user) {
        $username = $user["username"];
    }
    else{
        $username = "[UNKNOWN]";
    }

    if (empty($action)){
        $action = "[ERROR NO ACTION]";
    }





    if (empty($statement)){
        $statement = "";
    }
    if (empty($otheruser)){
        $otheruser = "";
    }
    if (empty($message)){
        $message = "[EMPTY]";
    }


    $fp = fopen('app.log', 'a');
    fwrite($fp, $date." | ".$ip." | ".$username." | ".$action." | ".$statement." | ".$otheruser." | ".$message."\n");
    fclose($fp);
}

?>
