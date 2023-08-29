<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\commands;

use bamboopm\MobsLite\entities\EntityClassMapper;
use bamboopm\MobsLite\manager\MobSpawner;
use bamboopm\MobsLite\MobsLoader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;

class summonCommand extends Command
{
    private EntityClassMapper $registration;
    private MobSpawner $spawn;

    public function __construct(private MobsLoader $plugin)
    {
        parent::__construct("msummon", "§bMobsLite §8» §7Summon Mob Command");
        $this->setPermission("mobslite.summon");

        $this->registration = new EntityClassMapper();
        $this->spawn = new MobSpawner($this->plugin);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if ($sender instanceof Player) {
            if (isset($args[0]) and isset($args[1])) {
                $entityName = $args[0];
                $amount = $args[1];

                if (array_key_exists($entityName, $this->registration->getClasses())) {
                    for ($x = 0; $x < (int)$amount; $x++) {
                        $this->spawn->spawnEntity($entityName, $sender->getWorld(), $sender->getPosition());
                    }
                } else {
                    $sender->sendMessage("§e{$entityName} §7does not exist!");
                }
            } else {
                $sender->sendMessage("§8» §e/msummon [mobName] [amount]");
            }
        }
    }

    public function getOwningPlugin(): Plugin
    {
        return $this->plugin;
    }
}