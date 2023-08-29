<?php

declare(strict_types=1);

namespace bamboopm\commands;

use bamboopm\manager\MobUtility;
use bamboopm\MobsLite;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class listCommand extends Command implements PluginOwned
{
    private MobUtility $tools;

    public function __construct(private MobsLite $plugin)
    {
        parent::__construct("mlist", "§bMobsLite §8» §7List all Mobs that can spawn");
        $this->setPermission("mobslite.list");

        $this->tools = new MobUtility();
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if ($sender instanceof Player) {
            $this->tools->listMobs($sender);
        }
    }

    public function getOwningPlugin(): Plugin
    {
        return $this->plugin;
    }
}