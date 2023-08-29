<?php

declare(strict_types=1);

namespace bamboopm\entities\passive;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Parrot extends AbstractMob
{
    const TYPE_ID = EntityIds::PARROT;

    protected int $health = 6;
    protected float $speed = 1.2;
    protected bool $gravityMob = false;

    protected float $entitySizeHeigth = 0.9;
    protected float $entitySizeWidth = 0.5;


}
