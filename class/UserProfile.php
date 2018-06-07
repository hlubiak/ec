<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserProfile
 *
 * @author User
 */
class UserProfile {
    
    private $connection;

    //constructor
    function __construct(){

        //connect database
        $DBObject = new Database();
        $this->connection = $DBObject->dbConnect();

    }
    
    public function userProfile(){
        session_start();
        $get_profile=$this->connection->prepare("
            SELECT fullname, phonenumber, email, city, town, strnumber 
            FROM users
            WHERE user_id=?
                ");
        $get_profile->bind_param("i",$_SESSION['user_id']);
        $get_profile->execute();
        $get_profile->bind_result($fullname, $phonenumber, $email, $city, $town, $strnumber);
        while($get_profile->fetch()){
            
            echo 
                "<h3>"."Update Name and Contacts"."</h3>".
                "<div>"."Fullname"."</div>".
                "<input type='text' id='fullname' value='".$fullname."'/>".
                "<div>"."Phonenumber"."</div>".
                "<input type='text' id='phonenumber' value='".$phonenumber."'/>".
                "<div>"."Email"."</div>".
                "<input type='text' id='email' value='".$email."'/>".
                "<button id='update_name_contact_btn' onclick='update_name_contact()'>"."Update info"."</button>";
            echo 
                "<h3>"."Update Address"."</h3>".
                "<div>"."City"."</div>".
                "<input type='text' id='city' value='".$city."'/>".
                "<div>"."town"."</div>".
                "<input type='text' id='town' value='".$town."'/>".
                "<div>"."house number and street"."</div>".
                "<input type='text' id='strnumber' value='".$strnumber."'/>".
                "<button id='update_address_btn' onclick='update_address()'>"."Update address"."</button>";
            echo 
                "<h3>"."Update Password"."</h3>".
                "<div>"."Existing Password"."</div>".
                "<input type='text' id='current_password' />".
                "<div>"."New Password"."</div>".
                "<input type='text' id='new_password' />".
                "<button id='update_password_btn' onclick='update_password()'>"."Update password"."</button>";             
             
        }
        
        $this->connection->close();
    }
    
}
