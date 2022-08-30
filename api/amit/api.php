<?php 

$otp = '3210';
$senderid = 'MOSFTY';
$message  = "Dear User Your Txn Validation OTP Is $otp , Thanks Team MOSFTY";
$template = '1707164930183344222';
$phone = 7697588851;

        echo $link = "https://securesmpp.com/api/sendmessage.php?usr=HARSH&apikey=E3E92ECD84DD01F0E647&sndr=".urlencode($senderid)."&ph=".urlencode($phone)."&Template_ID=".urlencode($template)."&message=".urlencode($message)."";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$link);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
       echo  $result=curl_exec($ch);
        curl_close($ch);



// https://securesmpp.com/api/sendmessage.php?usr=HARSH&apikey=E3E92ECD84DD01F0E647&sndr=MOSFTY&ph=7697588851&Template_ID=1707164930166195486&message=Dear,%20User%20Your%20Txn%20Validation%20OTP%20Is%20123456%20,Thanks%20Team%20Moonex%20Software
                // echo $link = "https://securesmpp.com/api/sendmessage.php?usr=HARSH&apikey=E3E92ECD84DD01F0E647&sndr=".urlencode($senderid)."&ph=".urlencode($result->mobile)."&Template_ID=".urlencode($template)."&message=".urlencode($message)."";

                      // file_get_contents($url);
                                          // $ch = curl_init();
                    // curl_setopt($ch,CURLOPT_URL,$link);
?>