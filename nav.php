<?php 
if (isset($_SESSION['CustomerID']))
{
?>
    <a class="dropdown-item" href="Customer_Home.php">Product Display</a>
    <a class="dropdown-item" href="Shopping_Cart.php">Shopping Cart</a>
    <a class="dropdown-item" href="help.pdf" target="_blank">Help</a>

    
    
<?php
}
elseif (isset($_SESSION['CustomerID'])) 
{
?>

    <a class="dropdown-item" href="Customer_Home.php">Product Display</a>
    <a class="dropdown-item" href="Shopping_Cart.php">Shopping Cart</a>
    <a class="dropdown-item" href="help.pdf" target="_blank">Help</a>
    
    
<?php
}
else
{
?>

	<a class="dropdown-item" href="Customer_Home.php">Product Display</a>
    <a class="dropdown-item" href="Login.php">Login</a>
    <a class="dropdown-item" href="Customer_Register.php">Customer Register</a>
    <a class="dropdown-item" href="help.pdf" target="_blank">Help</a>
<?php
}
 ?>