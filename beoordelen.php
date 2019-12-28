<?php
	session_start();
?>

<?php
	include 'header.php';
?>

<div class="container">
	<section>
		<?php
			if(!isset($_SESSION["gebruikersid"])) {
				
				echo "U bent niet aangemeld. </br>";
				echo "<a href='aanmelden.php'>Terug naar de pagina aamelden</a>";
				return;
			}
			elseif(!isset ($_GET["routeid"]) && !isset($_SESSION["routeid"])){
				echo "Je moet eerst aangeven voor welke route je een beoordeling wil ingeven </br>";
				echo "<a href='zoeken.php'>Terug naar de pagina met routes</a>";
				return;
			}
			else {
				if (isset ($_GET["routeid"])) {
					$_SESSION["routeid"] = $_GET["routeid"];
				}
				// echo "in je sessionobject zit er een routeid met waarde " . $_SESSION["routeid"];
				try {
					include 'dbconnectie.php';
					$sql = "SELECT * FROM fietsroutes WHERE routeid =
					:routeid";
					$stmt = $db -> prepare($sql);
					$stmt -> bindParam(':routeid', $routeid, PDO::PARAM_STR);	
					$stmt -> execute();
					$result = $stmt -> fetch(PDO::FETCH_ASSOC);
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
		<!-- Het formulier tonen -->
		<form  method="post" action="verwerkBeoordelen.php">
			<p>Beoordeling</p>
			<div>
				<input type="radio" name="beoordeling" value="uitstekend" checked>
				<label>Uitstekend</label><br/>
				<input type="radio" name="beoordeling" value="zeergoed">
				<label>Zeergoed</label><br/>
				<input type="radio" name="beoordeling" value="goed">
				<label>Goed</label><br/>
				<input type="radio" name="beoordeling" value="matig">
				<label>Matig</label><br/>
				<input type="radio" name="beoordeling" value="slecht">
				<label>Slecht</label>	
			</div>
			<p><input type="submit" value="Verstuur" name="verzenden"/></p>
		</form>
		<?php
			
			
			
		?>
		
	</div>
</section>

</div>

<?php
	include 'footer.php';
?>
