<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\hostile;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class Ghast extends AbstractMob
{
    const TYPE_ID = EntityIds::GHAST;

    protected int $health = 10;
    protected float $speed = 0.001;

    protected float $entitySizeHeigth = 4.0;
    protected float $entitySizeWidth = 4.0;

    protected bool $gravityMob = false;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::GHAST_TEAR(), VanillaItems::GUNPOWDER()];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return 5;
    }
}
