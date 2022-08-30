<!DOCTYPE html>
<?php
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
<html>
<head>
	<meta charset="utf-8">
	<title>Znalostní web</title>
	<?php
	   $sql = "SELECT * FROM testy;";

	   $result = $conn->query($sql);
       if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
  				?><a href="test.php?ids=<?php echo $row['id_tes'] ?>"><?php echo $row['nazev']; ?></a> <?php

  }
}
	  ?>
</head>
<body>

</body>
</html>