<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\neutral;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Piglin extends AbstractMob
{
    const TYPE_ID = EntityIds::PIGLIN;

    protected int $health = 16;
    protected float $speed = 0.35;

    protected float $entitySizeHeigth = 1.95;
    protected float $entitySizeWidth = 0.6;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::GOLD_NUGGET()->setCount(mt_rand(0, 3)), VanillaItems::GOLD_INGOT()->setCount(mt_rand(0, 3))];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return 5;
    }
}
