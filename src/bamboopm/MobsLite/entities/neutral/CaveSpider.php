<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities\neutral;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;

class CaveSpider extends AbstractMob
{
    const TYPE_ID = EntityIds::CAVE_SPIDER;

    protected int $health = 12;
    protected float $speed = 0.5;

    protected float $entitySizeHeigth = 0.5;
    protected float $entitySizeWidth = 0.7;

    protected bool $canClimb = true;
    protected bool $canClimb_WALLS = true;

    public function getDrops(): array
    {
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                return [VanillaItems::STRING(), VanillaItems::SPIDER_EYE()->setCount(mt_rand(0, 1))];
            }
        }
        return [];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(0, 2);
    }
}
