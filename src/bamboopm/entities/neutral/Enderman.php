<?php

declare(strict_types=1);

namespace bamboopm\entities\neutral;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Enderman extends AbstractMob
{
    const TYPE_ID = EntityIds::ENDERMAN;

    protected int $health = 40;
    protected float $speed = 0.3;

    protected float $entitySizeHeigth = 2.9;
    protected float $entitySizeWidth = 0.6;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::ENDER_PEARL()->setCount(mt_rand(0, 1))];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return 5;
    }
}
