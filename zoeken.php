<?php
	session_start();
?>


<?php
	include 'header.php';
?>


<div class="container">
	<section>
		<aside id="zoekpaneel">
			<div>
				<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<span><label for="provincie">Kies een provincie:</label><br/>
						<select name="provincie" id="provincie">
							<?php															
								try {
									include 'dbconnectie.php';
									$sql = "SELECT DISTINCT provincie FROM fietsroutes ORDER BY provincie";
									$stmt = $db -> prepare($sql);
									$stmt -> execute();
									$result = $stmt -> fetchAll();
									foreach ($result as $row) {?>
									<option value="<?php echo $row["provincie"]; ?>"><?php echo $row["provincie"]; ?></option>	
									<?php 
									}
									} catch(PDOException $e) {
									echo '<pre>';
									echo 'Regel: ' . $e -> getLine() . '<br>';
									echo 'Bestand: ' . $e -> getFile() . '<br>';
									echo 'Foutmelding: ' . $e -> getMessage();
									echo '</pre>';
								}
							?>
							<input type="submit" value="Zoeken" name="zoeken" class="knop"/>
							<?php	
								/*
									4) Voor wie houdt van een extra uitdaging 
									Zorg ervoor op de pagina zoeken.php dat de gekozen provincie behouden blijft nadat op zoeken werd geklikt 
									OPM: 
									Mijn idee ging uit naar een if isset $_POST provincie die dan als true ook meteen een sessie object maakte, en ook een if_SESSION die dan heel dezelfde code zou uitvoeren. MAAR na het kopiëren en plakken van alle code die daarin stond, crashte het. 'k Was dan al mijn gerief kwijt en, na het herstel, heb ik niet verdergezocht. Maar kben wel geïnteresseerd
								*/
								if(isset($_POST["provincie"])) {
									try {
										include 'dbconnectie.php';
										$sql = "SELECT * FROM fietsroutes WHERE provincie =
										:provincie";
										$stmt = $db -> prepare($sql);
										$stmt -> bindParam(':provincie', $provincie, PDO::PARAM_STR);
										$provincie = $_POST["provincie"];
										$stmt -> execute();
										$result = $stmt -> fetchAll();
									?>
									<div>
										<h2>Fietsroutes in <?php echo $_POST["provincie"]; ?></h2>		
										<table class="table">
											<tbody>
												<tr>
													<th>Fietsroute</th>
													<th>Aantal km</th>
													<th>startplaats</th>
													<th>Omschrijving</th>
													<th>Beoordeling</th>
													<?php if(isset($_SESSION["gebruikersid"])) {?>
														<th>Beoordelen</th>
													<?php	} ?>
												</tr>										
												<?php
													foreach ($result as $row) {
													?>
													<tr>
														<td><?php echo $row["naam"];?></td>
														<td><?php echo $row["km"];?></td>
														<td><?php echo $row["start"];?></td>
														<td><?php echo $row["omschrijving"];?></td>
														<td><?php 
															$product = $row["uitstekend"] * 5 + $row["zeergoed"] * 4 + $row["goed"] * 3 + $row["matig"] * 2 +  $row["slecht"] * 1;
															$aantalEenheden = $row["uitstekend"] + $row["zeergoed"] + $row["goed"] + $row["matig"] + $row["slecht"];
															$gemiddelde = $product / $aantalEenheden;
															$afgerond = round($gemiddelde);
															echo "<img src='img/" . $afgerond . "_sterren.jpg'>";
														?>
														</td>
														<?php if(isset($_SESSION["gebruikersid"])) {
?>
<td><a href="beoordelen.php?routeid=<?php echo $row["routeid"];?>">Geef een score</a></td>
														<?php	} ?>

													</tr>
													<?php
													}
												?>
											</tbody>
										</table>								
									</div>										
									
									<?php
										
										} catch(PDOException $e) {
										echo '<pre>';
										echo 'Regel: ' . $e -> getLine() . '<br>';
										echo 'Bestand: ' . $e -> getFile() . '<br>';
										echo 'Foutmelding: ' . $e -> getMessage();
										echo '</pre>';
									}
								}
							?>                      
						</select>
					</span>
					<span>
						
					</span>
				</form>    
			</div>
			</aside>
			<div>
			
			
					
		</div>
	</section>
</div>

<?php
	include 'footer.php';
?>

