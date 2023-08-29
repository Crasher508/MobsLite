<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\neutral;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Bee extends AbstractMob
{
    const TYPE_ID = EntityIds::BEE;

    protected int $health = 10;
    protected float $speed = 0.6;

    protected float $entitySizeHeigth = 0.7;
    protected float $entitySizeWidth = 0.6;

    protected bool $canClimb_WALLS = true;
    protected bool $gravityMob = false;
}