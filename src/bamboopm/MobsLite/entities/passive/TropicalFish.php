<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class TropicalFish extends AbstractMob
{
    const TYPE_ID = EntityIds::TROPICALFISH;

    protected int $health = 3;
    protected float $speed = 0.8;

    protected float $entitySizeHeigth = 0.6;
    protected float $entitySizeWidth = 0.6;


}
