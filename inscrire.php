<?php session_start(); 

	$_SESSION['user']=[];

$user=$_SESSION['user'];

?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap2.js"></script>
	<title>E-commerce</title>
	<style type="text/css">

.bg-text {
  background-color: black;
  color: white;
  text-align: center; 
  position: absolute; 
  transform: translate(-50%, -50%); 
  
  left: 50%;
  top: 500px;
  
}
div.scrollmenu {
  position: fixed; /* Set the navbar to fixed position */
  width: 100%; /* Full width */
  background-color: #333;
  overflow: auto;
  white-space: nowrap;
  z-index: 1;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
}
div.scrollmenu input[type=text] {
  float: right;
  padding: 6px;
  border: none;
  margin-top: 8px;
  margin-right: 16px;
  font-size: 17px;
}
.im{
	float: right;
	padding: 6px;
	margin-top: 8px;
  margin-right: 16px;
	}
	</style>

</head>
<body>
	<div class="scrollmenu">
  <a href="ecommerce.php">Home</a>
  <a href="#news">Catégories</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  <abbr title="Votre panier"><a href="" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal"><img src="image/panier.png" width="25px"><div id="nbr"><input type="hidden" id="v2" value="0"></div></a></abbr>

   <img src="image/glass.png" width="40px" class="im">
   <input type="text" placeholder="Search..">
   <button type="button" class="btn btn-dark" name="out" id="out">Log Out</button>
</div>
<div style=" background-image: url(image/montain.jpg);filter: blur(6px); height: 800px;z-index:-1; " ></div>
<div class="bg-text">
  <form method="post" action="">
  
<h1 align="center" >S'inscrire</h1>
<table style="width : 50%" class="table table-striped table-dark" align="center">
  <tr>
    <td><strong>Login :</strong></td>
    <td align="center"> <input size=50 type="text" name="l" placeholder="Entrer Nom d'utilisateur" required=""> </td>
  </tr>
  <tr>
    <td><strong>Password :</strong></td>
    <td align="center"> <input id="motdepasse"  size=50 type="Password" name="p" placeholder="Entrer Mot de passe" required=""> <br><input type="checkbox" onclick="Afficher()"> Afficher le mot de passe</td>
  </tr>

</table>
<center><button name="adduser" class="btn btn-success">S'inscrire</button></center><br>
</form>
</div>
	
<?php 

$a= mysqli_connect('localhost','root','','boutique2');
$sql="select * from user";
$re=mysqli_query($a,$sql);
$row=mysqli_fetch_array($re);
 if(isset ($_POST['adduser'])){
  $log1 = $_POST['l'];
  $b="select * from user where login='".$log1."'";
  $resultat=mysqli_query($a,$b);
  if($row=mysqli_fetch_array($resultat))
         {
          echo "<script>alert(\"Nom d'utilisateur est déja existe!\")</script>";
          } 
       else{ 
        $n1=$_POST['l'];
       $m1=$_POST['p'];
       $bb="insert into user (login,password) VALUES ('".$n1."', '".$m1."')"; 
        mysqli_query($a,$bb);
        header('location:ecommerce.php');
        }
 }

?>
<br><br>




<script>
function Afficher()
{ 
var input = document.getElementById("motdepasse"); 
if (input.type === "password")
{ 
input.type = "text"; 
} 
else
{ 
input.type = "password"; 
} 
} 
$(function() {
  $('#out').click(function() {    
 
  <?php session_destroy();?>
  window.location = "ecommerce.php";   
  }); 
 
});
</script>
</body>

</html>