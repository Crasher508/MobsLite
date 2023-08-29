<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Axolotl extends AbstractMob
{
    const TYPE_ID = EntityIds::AXOLOTL;

    protected int $health = 14;
    protected float $speed = 1.0;

    protected float $entitySizeHeigth = 0.4;
    protected float $entitySizeWidth = 0.2;


}