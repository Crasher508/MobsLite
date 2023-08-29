<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\manager;

use bamboopm\MobsLite\entities\AbstractMob;
use pocketmine\block\Water;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\World;

class MobMovementLogic
{
    public function getSaferSpawn(Vector3 $start, World $world, int $radius): Vector3
    {
        for ($r = $radius; $r > 5; $r -= 5) {
            $x = mt_rand(-$r, $r);
            $m = sqrt(pow($r, 2) - pow($x, 2));
            $z = mt_rand((int)-$m, (int)$m);

            $vec = $start->add($x, 0, $z);
            $chunk = $world->getOrLoadChunkAtPosition($vec);

            if ($chunk !== null) {
                $safe = $world->getSafeSpawn($vec);

                if ($safe->y > 0) {
                    return $safe;
                }
            }
        }

        return $start;
    }

    public function getRandomDestination(AbstractMob $entity): Vector3
    {
        $pos = $this->getEnemyDestination($entity);

        if (!$pos->equals(new Vector3(0, 0, 0))) {
            return $pos;
        }

        $pos = $this->getSaferSpawn($entity->getPosition(), $entity->getWorld(), 15);

        if ($entity->_isFlying()) {
            $pos->add(0, 8, 0);
        }

        if ($entity->isSwimming()) {
            $pos->add(0, mt_rand(-8, 8), 0);
        }

        $block = $entity->getWorld()->getBlock($pos);

        if (($entity->isSwimming() && !$block instanceof Water) || (!$entity->isSwimming() && $block->isSolid())) {
            $entity->setTimer(40);
            return new Vector3(0, 0, 0);
        }

        return $pos;
    }

    public function getEnemyDestination(AbstractMob $entity): Vector3
    {
        if (!$entity->_isHostile()) {
            return new Vector3(0, 0, 0);
        }

        $targetEntity = $entity->getTargetEntity();

        if ($targetEntity !== null) {
            return $targetEntity->getPosition();
        }

        foreach ($entity->getWorld()->getNearbyEntities($entity->getBoundingBox()->expandedCopy(15, 15, 15)) as $e) {
            if ($e instanceof Player && $e->isAlive() && !$e->isCreative()) {
                $entity->setTargetEntity($e);
                return $e->getPosition();
            }
        }
        return new Vector3(0, 0, 0);
    }
}

