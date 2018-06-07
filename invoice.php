<?php
    require 'Database.php';
?>
<html>
    
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title> Ecommerce </title>
        <link href="/style/style.css" rel="stylesheet" type="text/css" />
        <script src="/javascript/ajax.js"></script>
        <script src="/javascript/action.js"></script>
        <script src="/javascript/autoaction.js"></script>
    </head>
    
<body>
        
        <div id="header" class="header" >
            <a href="#menu" onclick="toggle_one('menu')"> 
                <div class="menu container" onclick="menu_roll(this)">
                  <div class="bar1"></div>
                  <div class="bar2"></div>
                  <div class="bar3"></div>
                </div> 
            </a>
            <a href='index.php'>
            <div class="logo">
                L.O.G.O
            </div>
            </a>
            </button>
            <a href="checkout.php" > 
                <button class="checkout round_border" >
                    <?php
                        include 'ProductNumberInCart.php';
                        $productNumberInCartObject = new ProductNumberInCart();
                        $productNumberInCartObject->productNumberInCart();
                    ?>
                </button> 
            </a>
            <a href="#myaccount" onclick="get_todo('all')"> 
                <div class="myaccount" > 
                    <?php
                        include 'UserAccount.php';
                        $userAccountObject = new UserAccount();
                        $userAccountObject->userAccount();
                    ?>
                </div> 
            </a>
        </div>
        
        <a href='index.php'>
            <button class='go_shopping_btn'>
                Go Shopping
            </button>
        </a>
    
        <div id='menu' class='header_menu' style='display:none;'>
            <?php 
                require 'Menu.php';
                $menuObject = new Menu();
                $menuObject->menu();
            ?>
        </div>
        <div class="content holder" style="top:55px;">
            <?php 
                require 'UserInvoice.php';
                $userInvoiceObject = new UserInvoice();
                $userInvoiceObject->userInvoice();
            ?>
        </div>
        
    </body>
</html>
