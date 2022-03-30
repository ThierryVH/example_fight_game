<?php

require("../Entity/Personnage.php");
require("../Manager/PersonnageManager.php");

// On instancie notre manager
$personnageManager = new PersonnageManager();

// Si un formulaire a été envoyé
if ($_POST) {
	// Si le formulaire de création de compte est soumis
	if (isset($_POST['new_personnage']) && !empty($_POST['new_personnage'])) {

		// Si le champ nom est bien rempli, et n'est pas vide
		if (isset($_POST['nom']) && !empty($_POST['nom'])) {

			$nom = htmlspecialchars($_POST['nom']);

			// On instancie un objet $personnage
			$personnage = new Personnage([
					'nom' => $nom
				]);

			// On ajoute l'instance à la base de données
			$personnageManager->addPersonnage($personnage);

			// Si le champ nom est vide ou n'existe pas, on déclare un message d'erreur
		} else {
			$error_message = "Veuillez renseigner le champ";
		}
	}

	// Si c'est le formulaire attaquer un ennemi qui est soumis
	elseif ((isset($_POST['attaque']) && !empty($_POST['attaque']))) {

		// On récupère l'ID du persoonage1 qui attaque et le personnage2 qui est attaqué
		$idPersonnage1 = (int) $_POST['personnage_1'];
		$idPersonnage2 = (int) $_POST['personnage_2'];

		$personnage1 = $personnageManager->getPersonnage($idPersonnage1);
		$personnage2 = $personnageManager->getPersonnage($idPersonnage2);

		$personnage1->attaqueUnEnnemi($personnage2);

		// On met à jour notre base de données
		$personnageManager->updatePersonnage($personnage1);
		$personnageManager->updatePersonnage($personnage2);
	}

	// Si c'est le formulaire de suppression qui est soumis
	elseif (isset($_POST['delete']) && !empty($_POST['delete'])) {
		$idAccount = (int) $_POST['id'];

		// On instancie un objet $personnage en fonction de l'ID
		$personnage = $personnageManager->getPersonnage($idAccount);
		// On le supprime en BDD
		$personnageManager->deletePersonnage($personnage);
	}
}

$personnages = $personnageManager->getPersonnages();

// Enfin, on inclut la vue
include "../Views/index.php";
