<?php
	include 'header.php';
?>
<div class="container">
	<section>
		<aside id="zoekpaneel">
			<div>
				<form method="post" action="verwerkRegistratie.php">
					<p>
						<label for="gebruikersnaam">Gebruikersnaam: </label>
						<input type="text" name="gebruikersnaam">
					</p>
					<p>
						<label for="emailadres">Emailadres: </label>
						<input type="email" name="emailadres">
					</p>
					<p>
						<label for="wachtwoord">Wachtwoord: </label>
						<input type="password" name="wachtwoord">
					</p>
					<p>
						<label for="voornaam">Voornaam: </label>
						<input type="text" name="voornaam">
					</p>
					<p>
						<label for="familienaam">Familienaam: </label>
						<input type="text" name="familienaam">
					</p>
					<input type="submit" value="Registreren" name="submit" class="knop">
					<br>
				</form>
			</div>
		</aside>
	</section>
</div>

<?php
	include 'footer.php';
?>
