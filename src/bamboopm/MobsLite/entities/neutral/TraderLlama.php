<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\neutral;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class TraderLlama extends AbstractMob
{
    const TYPE_ID = EntityIds::TRADER_LLAMA;

    protected int $health = 30;
    protected float $speed = 0.2;

    protected float $entitySizeHeigth = 1.87;
    protected float $entitySizeWidth = 0.9;
}
