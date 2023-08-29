<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\hostile;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class ElderGuardian extends AbstractMob
{
    const TYPE_ID = EntityIds::ELDER_GUARDIAN;

    protected int $health = 80;
    protected float $speed = 0.3;

    protected float $entitySizeHeigth = 1.99;
    protected float $entitySizeWidth = 1.45;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::PRISMARINE_SHARD()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return 10;
    }
}
