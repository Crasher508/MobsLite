<?php

declare(strict_types=1);

namespace bamboopm\manager;

use bamboopm\entities\AbstractMob;
use pocketmine\player\Player;
use pocketmine\world\World;

class MobUtility
{
    public function isDayTime(World $world): bool
    {
        return $world->getSunAngleDegrees() < 90 or $world->getSunAngleDegrees() > 270;
    }

    public function listMobs(Player $sender): void
    {
        $total = 0;
        $entityList = $this->getMobList($sender);

        $sender->sendMessage("§e[Current BiomeID = {$sender->getWorld()->getBiome($sender->getPosition()->getFloorX(), $sender->getPosition()->getFloorY(), $sender->getPosition()->getFloorZ())->getName()}]");

        foreach ($entityList as $worldName => $attr) {
            $t = 0;

            foreach ($attr as $name => $value) {
                $t += $value;
            }

            $total += $t;

            $message = "§d$worldName §7(§r$t" . "§7)§r";

            foreach ($attr as $name => $value) {
                $message .= " §9-§r $name §7(§r$value" . "§7)§r";
            }

            $sender->sendMessage($message);
        }

        if (!$total) {
            $sender->sendMessage("No Mobs");
        }
    }

    public function getMobList(Player $sender): array
    {
        $entityList = [];

        $worlds = $sender->getServer()->getWorldManager()->getWorlds();
        foreach ($worlds as $world) {
            $worldName = $world->getFolderName();

            foreach ($world->getEntities() as $entity) {
                if (!method_exists($entity, "getName")) {
                    continue;
                }

                if ($entity instanceof Player) {
                    continue;
                }

                $entityName = $entity->getName();

                if (!array_key_exists($worldName, $entityList)) {
                    $entityList[$worldName] = [];
                }

                if (!array_key_exists($entityName, $entityList[$worldName])) {
                    $entityList[$worldName][$entityName] = 0;
                }

                $entityList[$worldName][$entityName] += 1;
            }
        }
        return $entityList;
    }

    public function killMobs(Player $sender): void
    {
        $total = 0;

        $worlds = $sender->getServer()->getWorldManager()->getWorlds();
        foreach ($worlds as $world) {
            foreach ($world->getEntities() as $entity) {
                if (!method_exists($entity, "getName")) {
                    continue;
                }

                if ($entity instanceof Player) {
                    continue;
                }

                if ($entity instanceof AbstractMob) {
                    $total++;
                    $entity->kill();
                }
            }
        }

        $sender->sendMessage("Killed §d$total §rMobs");
    }
}
