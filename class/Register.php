<?php

class Register {
    
    private $connection;

    //constructor
    function __construct(){
	
        //connect database
        $DBObject = new Database();
        $this->connection = $DBObject->dbConnect();
               
    }
    
    function registerUser($input_fullname, $input_phonenumber, $input_email, $input_password){
        
        //check username and password from database
        if($statement = $this->connection->prepare("
                SELECT phonenumber, email
                FROM users 
                WHERE phonenumber = ? OR email = ?
            ")
        ){
            $statement->bind_param("ss", $input_phonenumber, $input_email);
            $statement->execute();
            $statement->bind_result($phonenumber, $email);
            $count=0;
            //check if rows exists
            while($statement->fetch()){
                $count += 1;
            }
            //check if user already eixsts or not
            if($count != 0){
                return "Registration failed...user exists";
            }else{
                //create salt
                $passwordKey  = base64_encode( mcrypt_create_iv( 44, MCRYPT_DEV_URANDOM ) );
                //encrypt password
                $encryptPasswordObject = new EncryptPassword();
                $encryptedPassword = $encryptPasswordObject->encryptInput( $passwordKey, $input_password );
                
               //insert user into database
                $insertUser = $this->connection->prepare("
                        INSERT INTO users ( fullname, email, phonenumber, password_key, password ) 
                        VALUES ( ?, ?, ?, ?, ? ) 
                        ");
                $insertUser->bind_param( "sssss", $input_fullname, $input_email, $input_phonenumber, 
                        $passwordKey, $encryptedPassword );
                if($insertUser->execute() == true){
                    return "Registration successful... ".$input_email." <a href='index.php'>OK</a>"; 
                    /*Send email*/
                    include 'Email.php';
                    $sendEmail = new Email();
                    $subject = "(Ecommerce Name)";
                    $message = "Welcome to (Ecommerce Name). Your account has been created successfully.";
                    $regards = "Regards <br/> (Ecommerce Name) Team";
                    $email_from = "support@ecommercename.co.za";
                    $email_to = $input_email;
                    $sendEmail->email($email_from, $email_to, $subject, $message, $regards);
                }else{
                    return "Registration failed...".$input_email." <a href='index.php'>OK</a>";
                }
            }
            //close conn
            $this->connection->close();
        }else{
            die("Error: Something went wrong");
        }
          
    }
}
