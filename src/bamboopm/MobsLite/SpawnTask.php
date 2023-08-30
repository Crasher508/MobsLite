<?php

declare(strict_types=1);

namespace bamboopm\MobsLite;

use bamboopm\MobsLite\manager\MobSpawner;
use pocketmine\entity\object\ExperienceOrb;
use pocketmine\scheduler\Task;

class SpawnTask extends Task
{
    private MobSpawner $spawn;

    public function __construct(private MobsLoader $plugin)
    {
        $this->spawn = new MobSpawner($this->plugin);
    }

    public function onRun(): void
    {
        $this->spawn->deSpawnMobs();
        $this->clearXpOrbs();
        $this->spawn->spawnMobs();
    }

    public function clearXpOrbs(): void
    {
        $worlds = $this->plugin->getServer()->getWorldManager()->getWorlds();
        foreach ($worlds as $world) {
            if ($world->getFolderName() === $this->plugin->getOverworldName() or $world->getFolderName() === $this->plugin->getNetherName() or $world->getFolderName() === $this->plugin->getEndName()) {
                if ($world->isLoaded()) {
                    $entities = $world->getEntities();
                    foreach ($entities as $entity) {
                        if ($entity instanceof ExperienceOrb) {
                            $entity->flagForDespawn();
                        }
                    }
                }
            }
        }
    }
}
