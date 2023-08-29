<?php

declare(strict_types=1);

namespace bamboopm\manager;

use bamboopm\entities\AbstractMob;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class MobBehaviour
{
    private MobUtility $tools;
    private MobMovementLogic $movement;

    public function __construct()
    {
        $this->tools = new MobUtility();
        $this->movement = new MobMovementLogic();
    }

    public function tick(AbstractMob $entity): void
    {
        $timer = $entity->getTimer() - 1;
        $flying = $entity->_isFlying();
        $entity->setTimer($timer);

        if ($timer > 0) {
            $this->wait($entity);
            return;
        }

        if ($timer === 0 && !$flying && mt_rand(0, 1) === 1 && $entity->getTargetEntity() === null) {
            $entity->setTimer(mt_rand(100, 600));
            return;
        }

        $pos = $entity->getDestination();

        if ($pos->x === 0 && $pos->y === 0 && $pos->z === 0) {
            $entity->setDestination($this->movement->getRandomDestination($entity));
        }

        if ($entity->getTimer() > 0) {
            return;
        }

        $this->move($entity);
    }

    public function move(AbstractMob $entity): void
    {
        $motion = $entity->getMotion();
        $location = $entity->getLocation();
        $swimming = $entity->isSwimming();
        $flying = $entity->_isFlying();

        if (!$entity->onGround && $motion->y < 0 && !$flying && !$swimming) {
            $motion->y *= 0.6;
        } else {
            if (mt_rand(0, 500) === 1 || ($entity->isCollided && $swimming)) {
                $entity->setDestination($this->movement->getRandomDestination($entity));
            }
            $targetPos = $this->calculateMotion($entity);
            $motion->x = $targetPos->x;
            $motion->y = $targetPos->y;
            $motion->z = $targetPos->z;
        }

        if ($entity->getTimer() > 0) {
            return;
        }

        if ($entity->isCollidedHorizontally && !$swimming) {
            $motion->y = 1;
        }

        if ($entity->_isJumping() && $entity->onGround) {
            $motion->y = 1;
        }

        if ($entity->getName() === "Chicken" && $entity->onGround && mt_rand(0, 100) >= 99) {
            $motion->y = 1;
        }

        $vec = new Vector3($motion->x, $motion->y, $motion->z);
        $look = $location->add($motion->x, $motion->y + $entity->getEyeHeight(), $motion->z);

        $entity->setDefaultLook($look);
        $entity->lookAt($look);
        $entity->setMotion($vec);
        $this->attackEntity($entity, 4);
    }

    public function wait(AbstractMob $entity): void
    {
        $location = $entity->getLocation();

        if ($entity->lastUpdate % 100 === 0) {
            if ($entity->getHealth() < $entity->getMaxHealth()) {
                $entity->setHealth($entity->getHealth() + 2);
            }
        }

        if ($entity->_isFlying()) {
            return;
        }

        if ($entity->isSwimming()) {
            if (!$entity->isUnderwater()) {
                $entity->setTimer(-1);
            }
            return;
        }

        if ($entity->_catchesFire() && $this->tools->isDayTime($entity->getWorld())) {
            $entity->setOnFire(120);
            $entity->setTargetEntity($entity);
        }

        if ($entity->isOnFire()) {
            $this->attackEntity($entity, 4);
        }

        if (mt_rand(1, 200) === 1) {
            $entity->lookAt($entity->getDefaultLook());
        } elseif (mt_rand(1, 200) === 1) {
            $x = $location->x + mt_rand(-1, 1);
            $y = $location->y + mt_rand(-1, 1);
            $z = $location->z + mt_rand(-1, 1);
            $entity->lookAt(new Vector3($x, $y, $z));
        }
    }

    public function calculateMotion(AbstractMob $entity): Vector3
    {
        $dest = $entity->getDestination();
        $epos = $entity->getPosition();
        $motion = $entity->getMotion();
        $speed = 1.0;
        $flying = $entity->_isFlying();

        $x = $dest->x - $epos->x;
        $y = $dest->y - $epos->y;
        $z = $dest->z - $epos->z;

        if ($x ** 2 + $z ** 2 < 0.7) {
            if ($entity->getTargetEntity() === null) {
                $motion->y = 0;
                $entity->setTimer($flying ? 100 : 200);
                $entity->setDestination(new Vector3(0, 0, 0));
            }
        } else {
            $diff = abs($x) + abs($z);

            $motion->x = $speed * 0.15 * ($x / $diff);
            $motion->y = 0;
            $motion->z = $speed * 0.15 * ($z / $diff);

            if ($entity->isSwimming()) {
                $motion->y = $speed * 0.15 * ($y / $diff);
            }
        }

        return new Vector3($motion->x, $motion->y, $motion->z);
    }

    public function attackEntity(AbstractMob $entity, int $damage): void
    {
        $target = $entity->getTargetEntity();

        if ($target === null) {
            return;
        }

        $dist = $entity->getPosition()->distanceSquared($target->getPosition());

        if (!$target->isAlive() || $dist >= 200 || ($target instanceof Player && $target->isCreative())) {
            $entity->setMovementSpeed(1.00);
            $entity->setTargetEntity(null);
            return;
        }

        if ($entity->getAttackDelay() > 20 && $dist < 2) {
            $entity->setAttackDelay(0);
            $ev = new EntityDamageByEntityEvent($entity, $target, EntityDamageEvent::CAUSE_ENTITY_ATTACK, $damage);
            $target->attack($ev);
        }

        $entity->setAttackDelay($entity->getAttackDelay() + 1);

        $pos = $target->getPosition();
        $entity->setDestination(new Vector3($pos->x, 0, $pos->z));
    }
}
