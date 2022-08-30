<?php
include_once "index.php";
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "7znalostniweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
  
<?php
$_SESSION['ids'] = $_GET['ids'];
$ids = $_SESSION['ids'];
?>
<form method="POST" action="test.php?ids=<?php echo $ids; ?>">
    <div style="margin: auto;width: 20%;border:3px solid black;">
<?php
$countSQL = "SELECT COUNT(id_ota) AS pocet, nazev, id_ota, id_tes FROM otazky WHERE id_tes = $ids;";
$resultT = $conn->query($countSQL);
  while($row = $resultT->fetch_assoc()) {
    $pocet = $row['pocet'];
     }

       for ($i=1; $i <$pocet ; $i++) { 

 $sql = "SELECT * from otazky   WHERE id_tes =  $ids  LIMIT 1 OFFSET $i ";   
$result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    echo "<br>";
   
 ?><h4><?php echo $i; echo $row['nazev']; ?></h4><?php
    echo "<br>";

 $idss = $row['id_ota'];
}
$sqlB = "SELECT odpovedi.jeSpravne AS jeSpravne, odpovedi.nazev AS odpoved from odpovedi JOIN otazky on odpovedi.id_ota = otazky.id_ota WHERE otazky.id_ota = $idss ;";
$result = $conn->query($sqlB);
  while($row = $result->fetch_assoc()) {




    ?><a><input type="radio" id="test<?php echo $i;?>" value="<?php echo $row['jeSpravne']; ?>" name="test<?php echo $i;?>" value="<?php echo $row['jeSpravne']; ?>"></a><?php
  	echo "".$row['odpoved'];
  	}
    
       }

  	
  ?>
  <div>
    <input type="submit" name="vyhodnot">
  </div>
</div>
  </form>



<?php 
if (isset($_POST['vyhodnot'])) {

if (empty($_POST['test1']||$_POST['test2']||$_POST['test3'])) {
 $_POST["test1"] = "N";
 $_POST["test2"] = "N";
 $_POST["test3"] = "N";


}
else{
  $test1 = $_POST['test1'];
$test2 = $_POST['test2'];
$test3 = $_POST['test3'];
//$test4 = $_POST['test4'];
//$test5 = $_POST['test5'];
$counter = 0;
if($test1=='ANO'){
 $counter ++;
}
else{
}
if($test2=='ANO'){
 $counter ++;
}else{
}
if($test3=='ANO'){
 $counter ++;
}
else
{

}

?>
<div style="width: 20%;border: 1px solid orange;" class="container"><h5>Výsledek</h5>
<div style="color:yellow;">Úspěšnost <?php echo round($counter/$pocet*100) ;echo "%"; ?></div>
<div style="color:red;">Počet špatných : <?php echo $pocet/$counter ; ?></div>
<div style="color:green;"><?php echo "Počet správných ";echo $counter;   ?></div>
</div>

<?php
}
}
 ?>
 <script type="text/javascript">
   
   function spatne() {
   }

 </script>
</body>
</html>