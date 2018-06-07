<?php

class RetireProduct {
    
    private $connection;

    //constructor
    function __construct(){
	
        //connect database
        $DBObject = new Database();
        $this->connection = $DBObject->dbConnect();
               
    }
    
    /*retire product*/
    function retireProduct($product_id){
        
        //check if the product is retired or not
        $check=("
            SELECT retire_id
            FROM product
            WHERE product_id='".$product_id."'
                ");
        $result_check = $this->connection->query($check);
        if($result_check->num_rows > 0){
           while($row = $result_check->fetch_assoc()){
               
                   $update_product = $this->connection->prepare("
                    UPDATE product 
                    SET retire_id=? 
                    WHERE product_id=? 
                    ");
                if($row['retire_id']==0){
                    //retire product
                    $retire_id = 1;
                    $output = "RETIRED";
                }else{
                    //unretire product
                    $retire_id = 0;
                    $output = "RETIRE";
                }
                $update_product->bind_param( "ii", $retire_id, $product_id );
                if( $update_product->execute() == true){
                    echo $output;
                }else{
                    echo "ERROR";
                }
               
           } 
        }
        
        /*close database*/
        $this->connection->close();
    }/*close retire function*/
    
}
