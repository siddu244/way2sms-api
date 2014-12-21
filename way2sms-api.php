<?php

function sendmsg($username,$password,$to,$message){
    $url="http://site24.way2sms.com/Login1.action";
    $data='username='.$username.'&password='.$password;

    $fp = fopen("cookie.txt", "w");
    fclose($fp);
    $login = curl_init();
    curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($login, CURLOPT_TIMEOUT, 40000);
    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($login, CURLOPT_URL, $url);
    curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($login, CURLOPT_POST, TRUE);
    curl_setopt($login, CURLOPT_POSTFIELDS, $data);
    ob_start();
    curl_exec ($login);
    ob_end_clean();
    curl_close ($login);

    unset($login);    

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 40000);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_URL, $url);
    ob_start();
    $re= curl_exec ($ch);

    $file = fopen("cookie.txt", "r");
    $line = "";
    $cond = TRUE;
    while ($cond == TRUE) {
        $line = fgets($file);
        if ($line === FALSE) { // EOF
            $cond = FALSE;
        } else {
            $pos = strpos($line, "JSESSIONID");
            if ($pos === FALSE) {
                $line = "";
            } else { // SESSION ID FOUND
                $cond = FALSE;
                $id   = substr($line, $pos + 15);
            }
        }
    }

    fclose($file);

     $url        = "http://site24.way2sms.com/smstoss.action?Token=" . $id;
    $parameters = array(
        "button" => "Send SMS",
        "mobile" => $to,
        "message" => $message
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($parameters));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);

}