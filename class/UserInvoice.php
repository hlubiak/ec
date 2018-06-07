<?php

class UserInvoice {
    
    private $connection;

    //constructor
    function __construct(){

        //connect database
        $DBObject = new Database();
        $this->connection = $DBObject->dbConnect();

    }
    
    /*get user invoices*/
    public function userInvoice(){
        session_start();
        $get_user_id = $this->connection->prepare("
        SELECT phonenumber, email 
        FROM users
        WHERE user_id = ?
            ");
        $get_user_id->bind_param("i",$l_SESSION['user_id']);
        $get_user_id->execute();
        $get_user_id->bind_result( $phonenumber, $email  );
        while($get_user_id->fetch()){}
        /*get invoices*/
        $get_invoice = $this->con->prepare("
        SELECT invoice_number, amount, timestamp 
        FROM sales
        WHERE user_id = ? OR user_id = ? OR user_id = ?
            ");
        $get_invoice->bind_param("iss",$loggedin_user_id, $phonenumber, $email);
        $get_invoice->execute();
        $get_invoice->bind_result( $invoice_number, $amount, $timestamp  );
        while($get_invoice->fetch()){
           echo "<div  class='feed_holder_middle' style='left:0%;'>".
                "<div>".
                    "Invoice NO: ".
                $invoice_number.
                "</div>".
                " ".
                "<div>".
                    "Cost: R".
                $amount.
                "</div>".
                "<div>".
                    "Date generated: ".
                $timestamp.
                "</div>".
            "</div>";
        }
                    
    }
    
}