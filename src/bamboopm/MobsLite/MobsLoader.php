<?php

declare(strict_types=1);

namespace bamboopm\MobsLite;

use bamboopm\MobsLite\commands\killCommand;
use bamboopm\MobsLite\commands\listCommand;
use bamboopm\MobsLite\commands\summonCommand;
use bamboopm\MobsLite\entities\EntityClassMapper;
use pocketmine\plugin\PluginBase;

class MobsLoader extends PluginBase
{
    protected function onEnable(): void
    {
        $this->registerEntities();
        $this->registerTask();
        $this->registerCommands();
    }

    protected function registerEntities(): void
    {
        $registration = new EntityClassMapper();
        $registration->registerEntities();
    }

    public function registerTask(): void
    {
        $task = new SpawnTask($this);
        $this->getScheduler()->scheduleRepeatingTask($task, 300);
    }

    public function registerCommands(): void
    {
        $commands = [
            killCommand::class, listCommand::class, summonCommand::class
        ];

        $commandMap = $this->getServer()->getCommandMap();
        foreach ($commands as $class) {
            $commandMap->register("MobsLite", new $class($this));
        }
    }
}
