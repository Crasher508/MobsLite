<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\hostile;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Vex extends AbstractMob
{
    const TYPE_ID = EntityIds::VEX;

    protected int $health = 14;
    protected float $speed = 0.8;

    protected float $entitySizeHeigth = 0.4;
    protected float $entitySizeWidth = 0.2;

    public function getXpDropAmount(): int
    {
        return mt_rand(3, 5);
    }
}
