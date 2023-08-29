<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Fox extends AbstractMob
{
    const TYPE_ID = EntityIds::FOX;

    protected int $health = 10;
    protected float $speed = 0.8;

    protected float $entitySizeHeigth = 0.6;
    protected float $entitySizeWidth = 0.7;


    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
