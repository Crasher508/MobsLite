<?php

declare(strict_types=1);

namespace bamboopm\entities\hostile;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Warden extends AbstractMob
{
    const TYPE_ID = EntityIds::WARDEN;

    protected int $health = 500;
    protected float $speed = 0.3;

    protected float $entitySizeHeigth = 2.9;
    protected float $entitySizeWidth = 0.9;

    public function getXpDropAmount(): int
    {
        return 15;
    }
}
