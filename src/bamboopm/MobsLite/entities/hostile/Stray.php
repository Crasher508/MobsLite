<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\hostile;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Stray extends AbstractMob
{
    const TYPE_ID = EntityIds::STRAY;

    protected int $health = 20;
    protected float $speed = 0.25;

    protected float $entitySizeHeigth = 1.99;
    protected float $entitySizeWidth = 0.6;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::ARROW()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(0, 2);
    }
}
