<?php

declare(strict_types=1);

namespace bamboopm\entities\neutral;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Dolphin extends AbstractMob
{
    const TYPE_ID = EntityIds::DOLPHIN;

    protected int $health = 10;
    protected float $speed = 1.2;

    protected float $entitySizeHeigth = 0.9;
    protected float $entitySizeWidth = 0.6;
}
