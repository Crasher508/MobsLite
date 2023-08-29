<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Frog extends AbstractMob
{
    const TYPE_ID = EntityIds::FROG;

    protected int $health = 10;
    protected float $speed = 1.0;

    protected float $entitySizeHeigth = 0.4;
    protected float $entitySizeWidth = 0.3;


}
