<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Squid extends AbstractMob
{
    const TYPE_ID = EntityIds::SQUID;

    protected int $health = 10;
    protected float $speed = 0.1;

    protected float $entitySizeHeigth = 0.8;
    protected float $entitySizeWidth = 0.8;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::INK_SAC()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
