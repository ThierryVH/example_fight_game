<?php

declare(strict_types=1);

require("DatabaseManager.php");

/**
 *  Classe permettant de gérer les opérations en base de données concernant les objets Personnage
 */
class PersonnageManager
{
	/** @var PDO */
	private $db;

	public function __construct()
	{
		$this->setDb(DatabaseManager::DB());
	}

	public function setDb(PDO $database): void
	{
		$this->db = $database;
	}

	public function addPersonnage(Personnage $personnage): void
	{
		$query = $this->db->prepare('INSERT INTO personnage(nom, vie) VALUES (:nom, :vie)');
		$query->execute([
			"nom" => $personnage->getNom(),
			"vie" => $personnage->getVie(),
		]);
	}

	public function getPersonnages(): array
	{
		$personnages = [];
		$query = $this->db->prepare('SELECT * FROM personnage');
		$query->execute();

		$data = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $result) {
			$personnages[] = new Personnage($result);
		}

		return $personnages;
	}

	public function getPersonnage(int $idPersonnage): Personnage
	{
		$query = $this->db->prepare('SELECT * FROM personnage WHERE id = :idPersonnage');
		$query->execute([
			"idPersonnage" => $idPersonnage
		]);

		$data = $query->fetch(PDO::FETCH_ASSOC);

		return new Personnage($data);
	}

	public function updatePersonnage(Personnage $personnage): void
	{
		$query = $this->db->prepare('UPDATE personnage SET vie = :vie WHERE id = :idPersonnage');
		$query->execute([
			'vie' => $personnage->getVie(),
			'idPersonnage' => $personnage->getId()
		]);
	}

	public function deletePersonnage(Personnage $personnage): void
	{
		$query = $this->db->prepare('DELETE FROM personnage WHERE id = :idPersonnage');
		$query->execute([
			"idPersonnage" => $personnage->getId()
		]);
	}
}
