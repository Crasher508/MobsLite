<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Villager extends AbstractMob
{
    const TYPE_ID = EntityIds::VILLAGER_V2;

    protected int $health = 20;
    protected float $speed = 0.5;

    protected float $entitySizeHeigth = 1.95;
    protected float $entitySizeWidth = 0.6;
}
