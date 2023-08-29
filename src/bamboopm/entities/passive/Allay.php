<?php

declare(strict_types=1);

namespace bamboopm\entities\passive;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Allay extends AbstractMob
{
    const TYPE_ID = EntityIds::ALLAY;

    protected int $health = 14;
    protected float $speed = 0.5;

    protected float $entitySizeHeigth = 0.5;
    protected float $entitySizeWidth = 0.25;


}
