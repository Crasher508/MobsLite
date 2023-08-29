<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Cod extends AbstractMob
{
    const TYPE_ID = EntityIds::COD;

    protected int $health = 3;
    protected float $speed = 0.8;

    protected float $entitySizeHeigth = 0.3;
    protected float $entitySizeWidth = 0.2;


    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
