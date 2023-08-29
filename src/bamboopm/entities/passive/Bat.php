<?php

declare(strict_types=1);

namespace bamboopm\entities\passive;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Bat extends AbstractMob
{
    const TYPE_ID = EntityIds::BAT;

    protected int $health = 6;
    protected float $speed = 0.8;
    protected bool $gravityMob = false;

    protected float $entitySizeHeigth = 0.5;
    protected float $entitySizeWidth = 0.9;


}
