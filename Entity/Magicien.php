<?php

declare(strict_types=1);

require("../Service/Hydrator.php");

class Magicien extends Personnage
{
	use Hydrator;

	public $force = 10;

	public function __construct(array $array)
	{
		$this->hydrate($array);
	}

	public function seRegenerer()
	{
		$this->pointsDeVie = self::POINTS_DE_VIE_MAX;
	}
}
