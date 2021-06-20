
<?php 
$a= mysqli_connect('localhost','root','','boutique2');
 $json = file_get_contents('./products.json');
 $obj = json_decode($json);
 //$products=array_map('map', $obj)
foreach ($obj as $product) {
	$ref=$product->sku;
	$name=$product->name;
	$description=$product->description;
	$price=$product->price;
	$image=$product->image;
	$sql="insert into products values ('$ref','$name','$description',$price,'$image')";
	 mysqli_query($a,$sql);
} 
   ?>
