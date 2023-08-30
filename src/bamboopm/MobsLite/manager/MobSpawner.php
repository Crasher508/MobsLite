<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\manager;

use bamboopm\MobsLite\entities\AbstractMob;
use bamboopm\MobsLite\entities\EntityClassMapper;
use bamboopm\MobsLite\MobsLoader;
use pocketmine\block\Water;
use pocketmine\entity\Location;
use pocketmine\math\Vector3;
use pocketmine\world\World;

class MobSpawner
{
    private BiomeMapper $biomes;
    private MobMovementLogic $coords;
    private EntityClassMapper $registration;
    private MobUtility $utility;

    public function __construct(private MobsLoader $plugin)
    {
        $this->biomes = new BiomeMapper($this->plugin);
        $this->coords = new MobMovementLogic();
        $this->registration = new EntityClassMapper();
        $this->utility = new MobUtility();
    }

    public function spawnMobs(): void
    {
        foreach ($this->plugin->getServer()->getWorldManager()->getWorlds() as $world) {
            if (!$this->isAllowedSpawn($world->getFolderName())) {
                continue;
            }

            $positions = [];

            for ($i = 0; $i < 20; $i++) {
                foreach ($world->getPlayers() as $player) {
                    $positions[] = $this->coords->getSaferSpawn($player->getPosition(), $world, 100);
                }
            }

            foreach ($positions as $pos) {
                $biome = $world->getBiome((int)$pos->x, (int)$pos->y, (int)$pos->z)->getName();
                $isNight = !$this->utility->isDayTime($world);
                $mobtable = $this->biomes->getMobsForBiome($world->getFolderName(), $biome, $isNight);

                foreach ($mobtable as $mobname) {
                    $total = count(array_filter($world->getEntities(), fn($entity) => method_exists($entity, "getName") && $entity->getName() === $mobname));
                    $allowed = 3;
                    $max = $allowed - $total;

                    if ($max < 1) {
                        continue;
                    }

                    while ($max > 0) {
                        $newpos = $this->coords->getSaferSpawn($pos, $world, 8);
                        $this->spawnEntity($mobname, $world, $newpos);
                        $max--;
                    }

                    break;
                }
            }
        }
    }

    public function deSpawnMobs(): void
    {
        foreach ($this->plugin->getServer()->getWorldManager()->getWorlds() as $world) {
            foreach ($world->getEntities() as $entity) {
                if (!method_exists($entity, "getName") || !$entity instanceof AbstractMob) {
                    continue;
                }

                $swimming = $entity->_isSwimming();
                $block = $entity->getWorld()->getBlock($entity->getPosition()->subtract(0, 1, 0));

                if ((!$swimming && ($block instanceof Water || $entity->isUnderwater())) || count($world->getPlayers()) < 1) {
                    $entity->kill();
                    continue;
                }

                $near = false;

                foreach ($world->getPlayers() as $p) {
                    if (count($p->getWorld()->getNearbyEntities($p->getBoundingBox()->expandedCopy(100, 100, 100), $entity)) > 0) {
                        $near = true;
                        break;
                    }
                }

                if (!$near) {
                    $entity->kill();
                }
            }
        }
    }

    public function spawnEntity(string $mobname, World $world, Vector3 $pos): void
    {
        $location = new Location($pos->x, $pos->y, $pos->z, $world, 0, 0);
        $entityClass = $this->registration->getClasses()[$mobname] ?? null;

        if ($entityClass === null) {
            $this->plugin->getServer()->getLogger()->info("§cError§f spawning mob §d$mobname §r");
            return;
        }

        $entity = new $entityClass($location);

        if ($entity === null) {
            $this->plugin->getServer()->getLogger()->info("§cError§f spawning mob §d$mobname §r");
            return;
        }

        $entity->spawnToAll();
    }

    public function isAllowedSpawn(string $worldName): bool
    {
        return in_array($worldName, $this->plugin->getFarmWorldNames());
    }
}
