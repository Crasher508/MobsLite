<?php

declare(strict_types=1);

namespace bamboopm\entities\neutral;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class IronGolem extends AbstractMob
{
    const TYPE_ID = EntityIds::IRON_GOLEM;

    protected int $health = 100;
    protected float $speed = 0.25;

    protected float $entitySizeHeigth = 2.7;
    protected float $entitySizeWidth = 1.4;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::IRON_INGOT()->setCount(mt_rand(1, 5))];
            }
        }
        return [];
    }
}
