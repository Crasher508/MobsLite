<?php

declare(strict_types=1);

namespace bamboopm\entities\passive;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Ocelot extends AbstractMob
{
    const TYPE_ID = EntityIds::OCELOT;

    protected int $health = 10;
    protected float $speed = 0.8;

    protected float $entitySizeHeigth = 0.7;
    protected float $entitySizeWidth = 0.6;


}
