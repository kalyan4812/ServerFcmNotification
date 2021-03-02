<?php

include 'myconnection.php';
$message=$_POST["message"];
$title=$_POST["title"];
$path_to_fcm="https://fcm.googleapis.com/fcm/send";
$server_key="AAAA1NEJ_kI:APA91bExwBN2jfEHTKQQ31_4gsTrsqEc-Nb2URYcNRc0iszTcE525Kctz4YSXxDZqAHWicBUHlia0-TfRKSnwyZ5-Ps6tDHU1RUmbO6fTAKdt14UXavCHaCBLZbaxOrnFRA9Oa0Q-cqG";

/*$sqlcmd="SELECT fcm_token FROM fcm_info";
$result=$mysqli_query($con,$sqlcmd);
$row=msqli_fetch_row($result);
$key=$row[0];*/
$key=$_POST["fcm_token"];
$headers=array('Authorization:key='.$server_key,'Content-Type:application/json');

$fields=array('to'=>$key,'notification'=>array('title'=>$title,'body'=>$message));

$payload=json_encode($fields);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL,$path_to_fcm);
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

echo $result;
mysqli_close($con);

 


?>
