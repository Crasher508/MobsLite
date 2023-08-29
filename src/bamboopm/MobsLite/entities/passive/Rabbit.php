<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\passive;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Rabbit extends AbstractMob
{
    const TYPE_ID = EntityIds::RABBIT;

    protected int $health = 3;
    protected float $speed = 0.5;

    protected float $entitySizeHeigth = 0.4;
    protected float $entitySizeWidth = 0.2;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::RABBIT_HIDE(), VanillaItems::RABBIT_FOOT()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(0, 1);
    }
}
