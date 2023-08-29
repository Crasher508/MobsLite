<?php

declare(strict_types=1);

namespace bamboopm\entities\passive;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class PufferFish extends AbstractMob
{
    const TYPE_ID = EntityIds::PUFFERFISH;

    protected int $health = 3;
    protected float $speed = 1.0;

    protected float $entitySizeHeigth = 0.7;
    protected float $entitySizeWidth = 0.7;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::PUFFERFISH()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
