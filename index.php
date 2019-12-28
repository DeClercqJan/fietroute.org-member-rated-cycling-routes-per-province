<?php
	include 'header.php';
?>
<div class="container">
			<?php
			$taal = "";
			if (isset($_COOKIE["taal"])) {
				$taal = $_COOKIE["taal"];
				if ($taal == "NL") {
					header("Location: welkom_NL.php");
				}
				elseif ($taal == "EN") {
					header ("Location: welcome_EN.php");
				}
				elseif ($taal == "FR") {
					header("Location: bienvenue_FR.php");
				}
			}
		?>
	<p><a href="welkom_NL.php">NL</a></p>
	<p><a href="bienvenue_FR.php">FR</a></p>
	<p><a href="welcome_EN.php">EN</a></p>
	
	
	
</div>

<?php
	include 'footer.php';
?>