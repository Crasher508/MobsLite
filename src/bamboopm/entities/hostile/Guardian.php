<?php

declare(strict_types=1);

namespace bamboopm\entities\hostile;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Guardian extends AbstractMob
{
    const TYPE_ID = EntityIds::GUARDIAN;

    protected int $health = 30;
    protected float $speed = 0.5;

    protected float $entitySizeHeigth = 0.85;
    protected float $entitySizeWidth = 0.85;

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
