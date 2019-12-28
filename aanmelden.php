<?php
	include 'header.php';
?>
<div class="container">
        <section>
            <aside id="zoekpaneel">
                <div>
                    <form method="post" action="verwerkAanmelden.php">
                        <p><label for="gebruikersnaam">Gebruikersnaam: </label>
                            <input type="text" name="gebruikersnaam" id="gebruikersnaam"></p>

                        <p><label for="wachtwoord">Wachtwoord: </label>
                            <input type="password" name="wachtwoord" id="wachtwoord"></p>
                    <input type="submit" value="Aanmelden" name="submit" class="knop">
                    </form>
                </div>
            </aside>
        </section>
	
</div>

<?php
	include 'footer.php';
?>



