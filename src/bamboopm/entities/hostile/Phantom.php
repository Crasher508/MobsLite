<?php

declare(strict_types=1);

namespace bamboopm\entities\hostile;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Phantom extends AbstractMob
{
    const TYPE_ID = EntityIds::PHANTOM;

    protected int $health = 20;
    protected float $speed = 0.6;

    protected float $entitySizeHeigth = 0.5;
    protected float $entitySizeWidth = 0.9;

    public function getXpDropAmount(): int
    {
        return 5;
    }
}
