<?php
	include 'header.php';
?>
<div class="container">
				<?php
			setcookie("taal", "NL", time () + 24*60*60);
		?>
            <p>Welkom op de webpagina</p>
            <p><a href="registreren.php">Registreren</a></p>
            <p><a href="aanmelden.php">Aanmelden</a></p>   
	
</div>

<?php
	include 'footer.php';
?>
