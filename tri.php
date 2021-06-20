<?php ob_start();
session_start(); 
if(!isset($_SESSION['panier'])){
  $_SESSION['panier']=[];
}

$panier=$_SESSION['panier'];

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
  background-color: white;
  color: black;
  font-size: 8vw; 
  font-weight: bold;
  margin: 0 auto; 
  padding: 10px;
  width: 60%;
  text-align: center; 
  position: absolute; 
  transform: translate(-50%, -50%); 
  mix-blend-mode: screen; 
  left: 50%;
  top: 600px;
  
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
  .bg{
  background-color: #f2d9e6;
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
<div style=" background-image: url(image/montain.jpg);filter: blur(6px); height: 900px;z-index:-1; " ></div>
<div class="bg-text">
  <h1>Web Site</h1>
  <p>E-Commerce</p>
</div>
  <div class="bg">
<?php 

$a= mysqli_connect('localhost','root','','boutique2');
$sql="select * from products ORDER BY price";
$re=mysqli_query($a,$sql);
$row=mysqli_fetch_array($re);?>
<br><br><br><br>
<h1 align="center">Liste des Produits</h1><br>
<table align="center" style="width : 70%" class="table">
<tr class="table-dark">
    <td>#Ref</td>
    <td>Name</td>
    <td>Description</td>
    <form method="GET" action="tri.php">
    <td width="90px">Price <button style="width : 60px;" class="btn btn-light">Trier</button></td></form>
    <td>Image</td>
        <td>Action</td>
  </tr>
<?php $count=0 ;
while($row==true && $count<=100){ ?>
  <tr>
    <td id="id"><?php echo $row['ref'];?></td>
    <td><?php echo $row['name']?></td>
    <td><?php echo $row['description']?></td>
    <td><?php echo $row['price']?></td>
    <td><img width="100px" src="<?php echo $row[4];?>"></td>
    <td><form method="POST"><input type="text" name="idqte" id="idqte_<?php echo $row['ref'];?>" placeholder="Quntité"> </form><button class="btn btn-primary" id="add" onclick="myFunction(<?php echo $row['ref'];?>)">Ajouter au Panier</button></td>
  </tr>

<?php $count=$count+1 ; $row=mysqli_fetch_array($re);
}

?>
</table><br>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Votre Panier</h5>
       
      <form method="post" action=""></div>
      <div class="modal-body">
        <table class="table table-dark table-hover" >
          <?php $i=0; ?>
          <tr>
            <td>#</td>
            <td>Ref</td>
            <td>Quantité</td>
          </tr>
          <?php foreach($panier as $r=>$q){?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $r ?>  </td>
              <td><input type="text" value="<?=$q ?>">  </td>
            </tr>
  <?php  $i++;
} ?>
          

        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" name="valider">Valider</button>
      </div></form>
    </div>
  </div><?php if(isset ($_POST['valider'])){    

   header('location:inscrire.php');
  } ?>
</div>

</body>
<script Type="text/javascript" language="JavaScript">
  var counter = 0;
function myFunction(idp) { 
    counter++;
    document.getElementById("nbr").innerHTML = counter;
    var v=document.getElementById("nbr");
    v.setAttribute("style", "color:white");
 var qte= document.getElementById('idqte_'+idp).value; 
$.ajax({
      type: "GET",
      url: "panier.php",
      cache: false,
      async: false,
      data: "id=" + idp + "&qte=" + qte ,
       success : function(code_html, statut){
          // location.reload();
       },
                    
      
    });  
 
   
}
$(function() {
  $('#out').click(function() {    
 
  <?php session_destroy();?> 
  window.location = "ecommerce.php";  
  }); 
 
});


</script>
</html>