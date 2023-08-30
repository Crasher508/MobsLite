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

	private string $overworldName = "";
	private string $netherName = "";
	private string $endName = "";

    protected function onEnable(): void
    {
		$this->saveDefaultConfig();
        $this->registerEntities();
        $this->registerTask();
        $this->registerCommands();
		$this->loadConfig();
    }

    private function registerEntities(): void
    {
        $registration = new EntityClassMapper();
        $registration->registerEntities();
    }

    private function registerTask(): void
    {
        $task = new SpawnTask($this);
        $this->getScheduler()->scheduleRepeatingTask($task, 300);
    }

    private function registerCommands(): void
    {
        $commands = [
            killCommand::class, listCommand::class, summonCommand::class
        ];

        $commandMap = $this->getServer()->getCommandMap();
        foreach ($commands as $class) {
            $commandMap->register("MobsLite", new $class($this));
        }
    }

	public function loadConfig(): void
	{
		$config = $this->getConfig();
		$this->overworldName = $config->get("overworld", "");
		$this->netherName = $config->get("nether", "");
		$this->endName = $config->get("end", "");
	}

	public function getOverworldName(): string
	{
		return $this->overworldName;
	}

	public function getNetherName(): string
	{
		return $this->netherName;
	}

	public function getEndName(): string
	{
		return $this->endName;
	}

	public function getFarmWorldNames(): array
	{
		return [$this->getOverworldName(), $this->getNetherName(), $this->getEndName()];
	}
}
