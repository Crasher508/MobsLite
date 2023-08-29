<?php

declare(strict_types=1);

namespace bamboopm\entities\neutral;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class PolarBear extends AbstractMob
{
    const TYPE_ID = EntityIds::POLAR_BEAR;

    protected int $health = 30;
    protected float $speed = 0.25;

    protected float $entitySizeHeigth = 1.4;
    protected float $entitySizeWidth = 1.3;
}
