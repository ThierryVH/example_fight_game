<?php

include('includes/header.php');

?>

<div class="container">

	<header class="flex">
		<p class="margin-right">Fight Game</p>
	</header>


	<?php
	if (isset($error_message)) {
	?>
		<p class="error-message"> <?php echo $error_message; ?></p>
	<?php
	}
	?>

	<h1>Mon application Fight Game</h1>

	<form class="newPersonnage" action="../Controller/FightController.php" method="post">
		<label>Nom:</label>
		<input type="text" name="nom">
		<input type="submit" name="new_personnage" value="Créer un nouveau personnage">
	</form>

	<hr>

	<div class="main-content flex">

		<?php
		foreach ($personnages as $personnage) {
		?>

			<div class="card-container">

				<div class="card">
					<h3><strong><?php echo $personnage->getNom(); ?></strong></h3>
					<div class="card-content">

						<p>Points de vie : <?php echo $personnage->getVie(); ?></p>

						<?php
						if (count($personnages) > 1) {
						?>

							<form action="../Controller/FightController.php" method="post">

								<h4>Attaque</h4>
								<input type="hidden" name="personnage_1" value="<?php echo $personnage->getId(); ?>" required>
								<select name="personnage_2" required>
									<option value="" disabled>Choisir un personnage à attaquer</option>
									<?php
									$idPersonnage = $personnage->getId();
									foreach ($personnages as $personnageSelect) {
										if ($idPersonnage != $personnageSelect->getId()) {
									?>
											<option value="<?php echo $personnageSelect->getId(); ?>"><?php echo $personnageSelect->getNom(); ?></option>
									<?php
										}
									}
									?>
								</select>
								<input type="submit" name="attaque" value="Attaquer l'ennemi">
							</form>

						<?php
						}
						?>

						<form class="delete" action="../Controller/FightController.php" method="post">
							<input type="hidden" name="id" value="<?php echo $personnage->getId(); ?>" required>
							<input type="submit" name="delete" value="Supprimer le personnage">
						</form>

					</div>
				</div>
			</div>

		<?php
		}
		?>
	</div>

</div>

<?php

include('includes/footer.php');

?>