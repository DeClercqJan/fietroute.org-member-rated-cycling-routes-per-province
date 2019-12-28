<?php
	include 'header.php';
?>
<div class="container">
	<section>
		<?php
			if(!isset($_POST["submit"])) {
			echo "U moet het formulier invullen </br> <a href='registreren.php'>Terug naar de registreerpagina</a>";
			return;
			}
			else {
				$error = "";
				if (empty($_POST["gebruikersnaam"])){
				$error = $error . "U moet de gebruikersnaam invullen </br>";}
				if (empty($_POST["emailadres"])){
				$error = $error . "U moet het e-mailadres invullen  </br>";}
				if (empty($_POST["wachtwoord"])){
				$error = $error . "U moet het wachtwoord invullen  </br>";}
				if (empty($_POST["voornaam"])){
				$error = $error . "U moet de voornaam invullen  </br>";}
				if (empty($_POST["familienaam"])){
				$error = $error . "U moet de familienaam invullen </br>";}
				if (!empty ($error)){
					echo "<p>U moet alle gegevens invullen:</p>";
					echo $error;
					echo "<a href='registreren.php'>Terug naar de registreerpagina</a>";
				}
			}
			if(!$error) {
						try {
				include 'dbconnectie.php';
				$sql = "SELECT count(gebruikersid) FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam";
				$stmt = $db -> prepare($sql);
				$stmt -> bindParam(':gebruikersnaam', $gebruikersnaam, PDO::PARAM_STR);
				$gebruikersnaam = $_POST["gebruikersnaam"];
				$stmt -> execute();
				$row = $stmt -> fetch(PDO::FETCH_NUM);
				if ($row[0] > 0) {
					echo "<p>Deze gebruikersnaam is al in gebruik </p>";
					echo "<a href='registreren.php'>Terug naar de registreerpagina!</a>";
				}
				else {
					$sql = "INSERT INTO gebruikers (gebruikersnaam, emailadres, wachtwoord, voornaam, familienaam) VALUES
					(:gebruikersnaam, :emailadres, :wachtwoord, :voornaam, :familienaam)";
					$stmt = $db -> prepare($sql);
					$stmt -> bindParam(':gebruikersnaam', $gebruikersnaam, PDO::PARAM_STR);
					$stmt -> bindParam(':emailadres', $emailadres, PDO::PARAM_STR);
					$stmt -> bindParam(':wachtwoord', $wachtwoord_hashed, PDO::PARAM_STR);
					$stmt -> bindParam(':voornaam', $voornaam, PDO::PARAM_STR);
					$stmt -> bindParam(':familienaam', $familienaam, PDO::PARAM_STR);
					
					$gebruikersnaam = $_POST["gebruikersnaam"];
					$emailadres = $_POST["emailadres"];
					// opgelet wachtwoord mag je niet zomaar opslaan (in geval je gehackt wordt), maar moet gebruik maken van een hashing functie (zullen we later zien)
					$wachtwoord = $_POST["wachtwoord"];
					$wachtwoord_hashed = password_hash($wachtwoord, PASSWORD_DEFAULT);
					$voornaam = $_POST["voornaam"];
					$familienaam = $_POST["familienaam"];
					$stmt -> execute();
				echo "<p>U bent geregistreerd</p>";
									echo "<a href='aanmelden.php'>Meldt u aan</a>";}
				
			}
			catch(PDOException $e) {
				echo '<pre>';
				echo 'Regel: ' . $e -> getLine() . '<br>';
				echo 'Bestand: ' . $e -> getFile() . '<br>';
				echo 'Foutmelding: ' . $e -> getMessage();
				echo '</pre>';
			}
				}
			// OPM: niet gedaan, want kzie niet in wanneer het nodig zou zijn: "Anders verschijnt een foutboodschap: Er is iets fout gegaan + een link naar de pagina om te registreren "

		?>	
	</section>
	
</div>

<?php
	include 'footer.php';
?>
