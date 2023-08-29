<?php

declare(strict_types=1);

namespace bamboopm\entities\hostile;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Ravager extends AbstractMob
{
    const TYPE_ID = EntityIds::RAVAGER;

    protected int $health = 100;
    protected float $speed = 0.4;

    protected float $entitySizeHeigth = 2.2;
    protected float $entitySizeWidth = 1.95;

    public function getXpDropAmount(): int
    {
        return 20;
    }
}
