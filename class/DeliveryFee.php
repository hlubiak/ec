<?php
class DeliveryFee {
 
    private $connection;

    //constructor
    function __construct(){
	
        //connect database
        $DBObject = new Database();
        $this->connection = $DBObject->dbConnect();
               
    }
    
    /*get delivery fee based on the city of the user*/
    function deliveryFee($address_city){
        
        if($address_city != ""){
            /*get fee for the city*/
            $get_fee = $this->connection->prepare("
                SELECT fee 
                FROM delivery
                WHERE city=?
                ");
            $get_fee->bind_param("s",$address_city);
            $get_fee->execute();
            $get_fee->bind_result($fee);
            $fetched = 0;
            while($get_fee->fetch()){
                $fetched++;
                echo 
                    "Delivery fee: ".
                    $delivery_fee = "R ".number_format($fee).
                    "<input type='hidden' id='deliveryfee' value='$fee'/>";
            }
            if($fetched==0){
                echo
                    "Delivery fee: ".
                    $delivery_fee = "R ".number_format(150).
                    "<input type='hidden' id='deliveryfee' value='150'/>";
            }
        }else{
            echo "Please enter your address for delivery";
        }
        
    }//close deliveryfee function
}
?>