<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\hostile;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Endermite extends AbstractMob
{
    const TYPE_ID = EntityIds::ENDERMITE;

    protected int $health = 8;
    protected float $speed = 0.25;

    protected float $entitySizeHeigth = 0.3;
    protected float $entitySizeWidth = 0.4;

    public function getXpDropAmount(): int
    {
        return mt_rand(3, 5);
    }
}
