<?php
	session_start();
?>

<?php
	include 'header.php';
?>
<div class="container">
	<section>
		<?php
			if(!isset($_POST["submit"])) {
				echo "U moet het formulier invullen </br> <a href='aanmelden.php'>Terug naar de pagina aanmelden</a>";
				return;
			}
			else {
				$error = "";
				if (empty($_POST["gebruikersnaam"])){
				$error = $error . "U moet de gebruikersnaam invullen </br>";}
				if (empty($_POST["wachtwoord"])){
				$error = $error . "U moet het wachtwoord invullen  </br>";}
				if (!empty ($error)){
					echo $error;
					echo "<a href='aanmelden.php'>Terug naar de pagina aamelden</a>";
				}
			}
			if(!$error) {
				try {
					include 'dbconnectie.php';
// hier had ik eerst fout gemaakt: invalid number of tokens ofzo: kwam doordat ik enkel gebruikersnaam ophaalde in sql en moest ook wachtwoord
					// $sql = "SELECT gebruikersid FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam and wachtwoord = :wachtwoord";
					$sql = "SELECT wachtwoord, gebruikersid FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam";
					$stmt = $db -> prepare($sql);
					$stmt -> bindParam(':gebruikersnaam', $gebruikersnaam, PDO::PARAM_STR);
					// $stmt -> bindParam(':wachtwoord', $wachtwoord, PDO::PARAM_STR);
					$gebruikersnaam = $_POST["gebruikersnaam"];
					// $wachtwoord = $_POST["wachtwoord"];
					$stmt -> execute();
					// $row = $stmt -> fetch(PDO::FETCH_NUM);
					$row = $stmt -> fetch(PDO::FETCH_ASSOC);
					// print_r($row);
					// print_r($row["wachtwoord"]);
					$wachtwoord_hashed = $row["wachtwoord"];
					$gebruikersid = $row["gebruikersid"];
					// echo $wachtwoord_hashed;
					if(password_verify($_POST["wachtwoord"],$wachtwoord_hashed)) {
						// echo "Welcome";
						$_SESSION["gebruikersid"] = $row["gebruikersid"];
						header("Location: zoeken.php");
					}
					// if ($row[0] >	 0) {
					// 	print_r($row);
					// }
						// $_SESSION["gebruikersid"] = $row[0];
					// header("Location: zoeken.php");
					// }
					else {
					echo "<p>er is een fout bij het aanmelden</p>";
					echo "<a href='aanmelden.php'>Terug naar de pagina aanmelden</a>";
						
					}
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
