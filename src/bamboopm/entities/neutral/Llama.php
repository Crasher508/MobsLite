<?php

declare(strict_types=1);

namespace bamboopm\entities\neutral;

use bamboopm\entities\AbstractMob;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Llama extends AbstractMob
{
    const TYPE_ID = EntityIds::LLAMA;

    protected int $health = 15;
    protected float $speed = 0.2;

    protected float $entitySizeHeigth = 1.87;
    protected float $entitySizeWidth = 0.9;
}
