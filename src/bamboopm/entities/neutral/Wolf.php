<?php

declare(strict_types=1);

namespace bamboopm\entities\neutral;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Wolf extends AbstractMob
{
    const TYPE_ID = EntityIds::WOLF;

    protected int $health = 8;
    protected float $speed = 0.3;

    protected float $entitySizeHeigth = 0.85;
    protected float $entitySizeWidth = 0.6;

    public function getXpDropAmount(): int
    {
        return mt_rand(0, 2);
    }
}
