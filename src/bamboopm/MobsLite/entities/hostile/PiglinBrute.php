<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\hostile;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class PiglinBrute extends AbstractMob
{
    const TYPE_ID = EntityIds::PIGLIN_BRUTE;

    protected int $health = 50;
    protected float $speed = 0.25;

    protected float $entitySizeHeigth = 1.95;
    protected float $entitySizeWidth = 0.6;
}
