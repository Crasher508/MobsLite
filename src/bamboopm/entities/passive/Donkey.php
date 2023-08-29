<?php

declare(strict_types=1);

namespace bamboopm\entities\passive;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Donkey extends AbstractMob
{
    const TYPE_ID = EntityIds::DONKEY;

    protected int $health = 15;
    protected float $speed = 1.1;

    protected float $entitySizeHeigth = 1.6;
    protected float $entitySizeWidth = 0.9;


    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
