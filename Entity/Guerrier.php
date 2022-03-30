<?php

declare(strict_types=1);

require("../Service/Hydrator.php");

class Guerrier extends Personnage
{
	use Hydrator;

	public const NB_ATTAQUE_SPACIALE = 2;

	public $force = 20;

	public function __construct(array $array)
	{
		$this->hydrate($array);
	}

	public function attaqueSpeciale($personnage)
	{
		for ($i=0; $i < self::NB_ATTAQUE_SPACIALE; $i++) { 
			$this->attaqueUnEnnemi($personnage);
		}
	}
}
