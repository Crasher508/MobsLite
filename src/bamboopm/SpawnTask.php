<?php

declare(strict_types=1);

namespace bamboopm;

use bamboopm\manager\MobSpawner;
use pocketmine\entity\object\ExperienceOrb;
use pocketmine\scheduler\Task;

class SpawnTask extends Task
{
    private MobSpawner $spawn;

    public function __construct(private MobsLite $plugin)
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
            if ($world->getFolderName() === "overworld" or $world->getFolderName() === "nether" or $world->getFolderName() === "the_end") {
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
