<?php

function get_email($username, $password, $hostname){

$conn = mysqli_connect('localhost', 'root', '', 'db');

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect : ' . imap_last_error());
$emails = imap_search($inbox,'ALL');
/* useful only if the above search is set to 'ALL' */
if($emails){

  /* put the newest emails on top */
  rsort($emails);

  /* for every email... */
    $read = 0;
    $unread = 0;
  foreach($emails as $email_number) {
    //$email_number=$emails[0];
//print_r($emails);
    /* get information specific to this email */
    $overview = imap_fetch_overview($inbox,$email_number,0);
    $message = imap_fetchbody($inbox,$email_number,1);


    if(!$overview[0]->seen){  
        $unread++;
        mysqli_query($conn, "INSERT INTO message (title, author, message) VALUES ('". $overview[0]->subject ."', '". $overview[0]->from ."', '". $message ."')");
        
    } else {
    $read++;

    }
  }


if($unread == 0){
  echo "no new emails";
} else {
    echo $read .' old emails<br>';
    echo $unread .' inserted into database<br>';
  }
  
/* close the connection */
imap_close($inbox);
 }
}
