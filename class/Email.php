<?php
class Email {
    
    private $connection;

    //constructor
    function __construct(){
	
        //connect database
        $DBObject = new Database();
        $this->connection = $DBObject->dbConnect();
               
    }
    function email($email_from, $email_to, $subject, $message, $regards){
        $body ="<html>
                <head>
                <style>
                .send_booking_detail_div{
                        width:90%;
                        height:auto;
                        padding:2%;
                        border:1px solid #CCC;
                        border-radius:6px;
                        -moz-border-radius:6px;
                        -webkit-border-radius:6px;

                    }
                .email_notif_div{
                        width:100%;
                        height:40px;
                        padding-top:20px;
                        color:#000;
                        background:#FFF;
                        margin-bottom:10px;
                        text-align:left;
                    }
                .name_logo_email{   position:relative;
                        top:32%;
                        color:#000;
                        font-size:20px;
                        font-weight:bold;
                    }
                    .gig_logo{
                        position:relative;
                        width:55px;
                        height:55px;
                        top:-30px;
                        float:left;
                        margin-right:10px;
                    }
                    .img_fit{
                        max-width:100%;
                        max-height:100%;
                    }
                    .toggle_submit_btn{
                       width:98%;
                       height:45px;
                       background:#069;
                       color:#fff;
                       border:1px solid #069;
                       margin:8px;
                       border-radius:2px;
                       -webkit-border-radius:2px;
                       -moz-border-radius:20px;
                       font-weight:bold;
                       font-size:16px;
                    }
                </style>
                </head>
                <body>"
                ."<div class='send_booking_detail_div'>".
                "</div>".
                    $message.
                "<br/><br/> ".        
                "<div>".
                    "<h5>".
                        $regards.
                    "</h5>".
                "</div>".
                "<div>".
                    "<img src='http://www.aparahantle.com/upload/abclogo.png' />".
                "</div>".
                "</body>";

                //send a notification email to the users admin//
                $to = $email_to;
                $subject = $subject;
                $message = "";
                $message .= "";
                $header = "From:".$email_from."\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                $retval = mail ( $to,$subject,$body,$header );
                if( $retval == true ){
                }else{
                }
                //send a notification email to the users admin//
                $toAdmin = "support@abantucalendar.co.za";
                $subjectAdmin = " Someone registered : Abantu Calendar ";
                $messageAdmin = "<b>".$email_to." registered". " </h3></b>";
                $messageAdmin .= "<h5><b> Kind Regards</b><b> Abantu Calendar team</b> </h5>";
                $headerAdmin = "From:support@abantucalendar.co.za \r\n";
                $headerAdmin .= "MIME-Version: 1.0\r\n";
                $headerAdmin .= "Content-type: text/html\r\n";
                $retvalAdmin = mail ( $toAdmin,$subjectAdmin,$messageAdmin,$headerAdmin );
                if( $retvalAdmin == true ){
                }else{
                }
    }
    
}
