<?php
require_once('../../config.php');
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>
            body{
                font-size: 12px;
                }
            h1{
              font-size: 14px;
              }

        </style>
    </head>
    <body>
        <h1>Error reporting to CBS Learn</h1>
        Please enter the following in the form below and click submit.
        <br /><br />
        <form id="mail" name="mail" method="POST" action="<?php print($_SERVER['PHP_SELF']);?>">
            <b><label>What were you trying to do?</label></b><br /><textarea rows="10" cols="25" name="report" id="report" style="font-size: 11.5px;">
            <?php
            if (isset($_POST['report'])) {
                    echo stripslashes($_POST['report']);
            }
            ?>
            </textarea><br />

            <input type="hidden" name ="url" id="url" value="<?php
if (isset($_GET['url'])) {
	print $_GET['url'];
} elseif (isset($_POST['url'])) {
	print $_POST['url'];
} else {
	echo "none";
}

?>" />

            <b><label>What was the result?</label></b><br /><textarea rows="10" cols="25" name="error" id="error" style="font-size: 11.5px;"></textarea><br />
            <b><label>Your Name</label></b><br /><input type="text" name="name" id="name" /><br />

            <input type="submit" name="submit" id="submit" value="Submit" /><br />
        </form>
        <?php

        if(isset($_POST['report'])){

include_once($CFG->libdir.'/phpmailer/class.phpmailer.php');

$mailer = new phpmailer();

$mailer->Host = "130.226.47.178";
$mailer->From = "learn@cbs.dk";
$mailer->FromName = "Learn script";
$mailer->Subject = "CBS Learn error report";
$mailer->CharSet = "UTF-8";
$mailer->AddAddress("learn@cbs.dk");


if (isset($USER->username)) {
	$username = $USER->username;
} else {
	$username = "";
}

$report = stripslashes($_POST['report']);
$error = $_POST['error'];
$name = $_POST['name'];
$url = "http://".$_SERVER['HTTP_HOST'].$_POST['url'];
/*
                 require_once 'Mail.php';
                    $settings = array();
                    $settings['host'] = "130.226.47.178";
                    $report = $_POST['report'];
                    $url = $_POST['url'];
                    $mail = Mail::factory("smtp", $settings);

                    $headers = array("From"=>"learn@cbs.dk", "Subject"=>"CBS Learn Error Report");
*/
$mailer->Body = "Hej!

Der er blevet indrapporteret en fejl i Learn.
-------------
The user was trying to: $report
-------------
The user got the error: $error
-------------
Username: $username
-------------
Name: $name
-------------

Fejlen er fundet på denne side:
Link:  $url
Relativt link: ".$_POST['url'] ."

CBS Learn
";

$mailer->IsSMTP();

                    $return_value = $mailer->Send();

                  if ($return_value) {
                   echo("<p>Report successfully sent!</p>");
                  } else {
                   echo("<p>Error reporting unsuccessful, please send your report via email to learn@cbs.dk</p>");
                  }
            
        }
        ?>
    </body>
</html>
