<?php

declare(strict_types=1);

require("../Service/Hydrator.php");

class Personnage
{
	use Hydrator;

	public const POINTS_DE_VIE_MAX = 100;

	public $id;
	public $nom;
	public $vie = self::POINTS_DE_VIE_MAX;
	public $force = 15;

	public function __construct(array $array)
	{
		$this->hydrate($array);
	}

	public function setId($id)
	{
		$this->id = (int) $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNom($nom)
	{
		$this->nom = $nom;
	}

	public function getNom()
	{
		return $this->nom;
	}

	public function setVie($vie)
	{
		$this->vie = $vie;
	}

	public function getVie()
	{
		return $this->vie;
	}

	public function perdDeLaVie(int $vie)
	{
		$this->vie -= $vie;
	}

	public function setForce($force)
	{
		$this->force = $force;
	}

	public function getForce()
	{
		return $this->force;
	}

	public function attaqueUnEnnemi($personnage)
	{
		$personnage->perdDeLaVie($this->force);
		$this->vie += 5;

		if ($this->vie > 100) {
			$this->vie = 100;
		}
	}
}
