<?php

declare(strict_types=1);

namespace bamboopm\entities\hostile;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class MagmaCube extends AbstractMob
{
    const TYPE_ID = EntityIds::MAGMA_CUBE;

    protected int $health = 8;
    protected float $speed = 0.4;

    protected float $entitySizeHeigth = 0.8;
    protected float $entitySizeWidth = 0.8;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::MAGMA_CREAM()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(0, 4);
    }
}
