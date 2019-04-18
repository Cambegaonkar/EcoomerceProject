<?php

session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["description"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		products is removed from your cart!</div>";
		} //removes products form cart
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['description'] === $_POST["description"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the products
    }
}
  	
}
?>
<html lang="en">
	<head>
        <title>Delta BookStore</title>
        <link href="CSS/main.css"  rel="stylesheet" type="text/css" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
               
           
           <div id="logo"><img src="IMAGES/delta-logo.png" width="200px" height="70px" alt="Logo">
               <div class="firstHeader">Apply&nbsp;&nbsp; Visit &nbsp;&nbsp; Give &nbsp;&nbsp;
           </div>
            </div> 
           <div class="topnav">
               <div id="navlinks">
           <a href="index.html">Home</a>
           <a href="products.php">Products</a>
		   <a href="cart.php">Cart</a>
           </div>
           </div>
        </header>
        
        <nav>
        <div class="hero-image">
        <div class="hero-text">
        <h1>Find Your Book</h1>
        <p>Looking for amazing books?</p>
        </div>
        </div>
        </nav>
        <main>
            
            <h2> Shopping Cart</h2>   

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php">
<img class='img-responsive' src="Images/cart-icon.png" /> Cart
<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>
<div style="width:700px; margin:50 auto;">
<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>
    
<table class="table">
<tbody>
<tr>
<td></td>
<td>NAME</td>
<td>QUANTITY</td>
<td>UNIT PRICE</td>
<td>ITEMS TOTAL</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $products){
?>
<tr>
<td><img src='<?php echo $products["img"]; ?>' width="50" height="40" /></td>
<td><?php echo $products["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='description' value="<?php echo $products["description"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='description' value="<?php echo $products["description"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($products["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($products["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($products["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($products["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($products["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$products["price"]; ?></td>
<td><?php echo "$".$products["price"]*$products["quantity"]; ?></td>
</tr>
<?php
$total_price += ($products["price"]*$products["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
  //if cart is empty
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>
            </div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; 

?>
            </div>
        </main>
        <br /><br />
<button type='index' class="btn btn-primary" onClick="location.href='products.php'">Inventory</button>
<button type='Checkout' class="btn btn-success" onClick="location.href='checkout.php'">Checkout</button>
            <footer>
                Copyright &copy; Delta Bookstore Since 1950
       </footer>
    </body>
</html>