<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Sniffer extends AbstractMob
{
    /**
     * @TODO
     */
    const TYPE_ID = EntityIds::SNIFFER;

    protected int $health = 30;
    protected float $speed = 0.2;

    protected float $entitySizeHeigth = 1.3;
    protected float $entitySizeWidth = 0.9;


    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
