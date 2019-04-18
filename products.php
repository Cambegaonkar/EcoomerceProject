<?php

session_start();
include('db.php');
$status="";
if (isset($_POST['description']) && $_POST['description']!=""){
$id = $_POST['description'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `description`='$description'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$description = $row['description'];
$price = $row['price'];
$img = $row['img'];

    //array for cart
$cartArray = array(
	$id=>array(
	'name'=>$name,
    'description'=>$description,
	'price'=>$price,
	'quantity'=>1,
	'img'=>$img)
);

    //shows msg when item is added to cart
if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
    
    //shows msg if item is already in cart
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($id,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}

?>
<!DOCTPE html>
<html lang="en">
	<head>
        <title>Delta BookStore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link href="CSS/main.css"  rel="stylesheet" type="text/css" >
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
        <br>
        
        <?php 
        
			require('mysqli_connect.php');
	$q ="SELECT * FROM products"; 
	 $r = mysqli_query($dbc, $q);
	$count = mysqli_num_rows($r);
	if($count == "0"){
		$output = '<h2>No result found!</h2>';
	}else{
       
		while($row = mysqli_fetch_array($r))
{
		 $id= $row['id'];
		$name = $row['name'];
		$img= $row['img'];
		$price = $row['price'];
		$description = $row['description'];
		
          echo "<div class='col-sm-4'>";
		  echo "<div class='imgGallary'>";
          echo "<div class='imagesDesc'>";
            echo "<b>$name</b><br>";
		  echo '<img src="data:Image/jpeg;base64,'.base64_encode( $img ).'"/>';
		   echo "<b>Description:</b>$description<br>";
		   echo "<b>Price:</b>$price<br>";
           echo "<button class='btn btn-danger btn-s' type='submit' name='submit'>Add To Cart</button>";
           echo "</div>";
           echo "</div>";
           echo "</div>";

}
	}
        mysqli_close($con);
		?>
        <div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>

<br /><br />
        <br>
        
           <footer>
               <div>Copyright &copy; Delta Bookstore Since 1950</div>
                
       </footer>
    </body>
</html>