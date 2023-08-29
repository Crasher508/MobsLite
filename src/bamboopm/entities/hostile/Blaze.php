<?php

declare(strict_types=1);

namespace bamboopm\entities\hostile;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Blaze extends AbstractMob
{
    const TYPE_ID = EntityIds::BLAZE;

    protected int $health = 20;
    protected float $speed = 0.23;

    protected float $entitySizeHeigth = 1.8;
    protected float $entitySizeWidth = 0.6;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::BLAZE_ROD()->setCount(mt_rand(0, 2))];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return 10;
    }
}
