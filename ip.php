<?php 

if (!empty($_SERVER["HTTP_CLIENT_IP"])){
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif (!empty($_SERVER["HTTP_X_FORMARDED_FOR"])){
    $ip = $_SERVER["HTTP_X_FORMARDED_FOR"];
}
else {
    $ip = $_SERVER["REMOTE_ADDR"];
}

echo "su id parece ser: ".$ip;
?>