<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Cow extends AbstractMob
{
    const TYPE_ID = EntityIds::COW;

    protected int $health = 10;
    protected float $speed = 0.45;

    protected float $entitySizeHeigth = 1.4;
    protected float $entitySizeWidth = 0.9;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::RAW_BEEF(), VanillaItems::LEATHER()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
