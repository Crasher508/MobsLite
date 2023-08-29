<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Tadpole extends AbstractMob
{
    const TYPE_ID = EntityIds::TADPOLE;

    protected int $health = 1;
    protected float $speed = 1.0;

    protected float $entitySizeHeigth = 0.11;
    protected float $entitySizeWidth = 0.11;


}
