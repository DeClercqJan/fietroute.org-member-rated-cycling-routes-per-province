<?php
	session_start();
?>

<?php
	include 'header.php';
?>

<div class="container">
	<section>
		<?php
		// echo $_SESSION["routeid"] . "</br>";
		// echo $_SESSION["gebruikersid"];
			if(!isset($_POST["verzenden"])) {
				echo "nog aan te passen"; 
				return;
			}
			else {
				 try {
				 include 'dbconnectie.php';
				 $sql = "UPDATE fietsroutes SET " . $_POST["beoordeling"] . " = " . $_POST["beoordeling"] . " + 1 WHERE routeid = :routeid";
				 $stmt = $db -> prepare($sql);
				$stmt -> bindParam(':routeid', $routeid, PDO::PARAM_STR);
				$routeid = $_SESSION["routeid"];
				$stmt -> execute();
				echo "<p>De beoordeling werd toegevoegd</p>";
				echo "<a href='zoeken.php'>Terug naar overzicht</a>";
				}
				catch(PDOException $e) {
					echo '<pre>';
					echo 'Regel: ' . $e -> getLine() . '<br>';
					echo 'Bestand: ' . $e -> getFile() . '<br>';
					echo 'Foutmelding: ' . $e -> getMessage();
					echo '</pre>';
					
				}
			}

			
			
			?>	
		
	</section>
	
</div>

<?php
	include 'footer.php';
?>
