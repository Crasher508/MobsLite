<?php

declare(strict_types=1);

namespace bamboopm\entities\neutral;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Panda extends AbstractMob
{
    const TYPE_ID = EntityIds::PANDA;

    protected int $health = 20;
    protected float $speed = 0.15;

    protected float $entitySizeHeigth = 1.25;
    protected float $entitySizeWidth = 1.3;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::BAMBOO()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
