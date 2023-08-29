<?php

declare(strict_types=1);

namespace bamboopm\entities;

use bamboopm\entities\hostile\Blaze;
use bamboopm\entities\hostile\Creeper;
use bamboopm\entities\hostile\Drowned;
use bamboopm\entities\hostile\ElderGuardian;
use bamboopm\entities\hostile\Endermite;
use bamboopm\entities\hostile\Ghast;
use bamboopm\entities\hostile\Guardian;
use bamboopm\entities\hostile\Hoglin;
use bamboopm\entities\hostile\Husk;
use bamboopm\entities\hostile\MagmaCube;
use bamboopm\entities\hostile\Phantom;
use bamboopm\entities\hostile\PiglinBrute;
use bamboopm\entities\hostile\Pillager;
use bamboopm\entities\hostile\Ravager;
use bamboopm\entities\hostile\Silverfish;
use bamboopm\entities\hostile\Skeleton;
use bamboopm\entities\hostile\Slime;
use bamboopm\entities\hostile\Stray;
use bamboopm\entities\hostile\Vex;
use bamboopm\entities\hostile\Vindicator;
use bamboopm\entities\hostile\Warden;
use bamboopm\entities\hostile\Witch;
use bamboopm\entities\hostile\WitherSkeleton;
use bamboopm\entities\hostile\Zoglin;
use bamboopm\entities\hostile\Zombie;
use bamboopm\entities\hostile\ZombieVillager;
use bamboopm\entities\neutral\Bee;
use bamboopm\entities\neutral\CaveSpider;
use bamboopm\entities\neutral\Dolphin;
use bamboopm\entities\neutral\Enderman;
use bamboopm\entities\neutral\Goat;
use bamboopm\entities\neutral\IronGolem;
use bamboopm\entities\neutral\Llama;
use bamboopm\entities\neutral\Panda;
use bamboopm\entities\neutral\Piglin;
use bamboopm\entities\neutral\PolarBear;
use bamboopm\entities\neutral\Spider;
use bamboopm\entities\neutral\TraderLlama;
use bamboopm\entities\neutral\Wolf;
use bamboopm\entities\passive\Allay;
use bamboopm\entities\passive\Axolotl;
use bamboopm\entities\passive\Bat;
use bamboopm\entities\passive\Camel;
use bamboopm\entities\passive\Cat;
use bamboopm\entities\passive\Chicken;
use bamboopm\entities\passive\Cod;
use bamboopm\entities\passive\Cow;
use bamboopm\entities\passive\Donkey;
use bamboopm\entities\passive\Fox;
use bamboopm\entities\passive\Frog;
use bamboopm\entities\passive\GlowSquid;
use bamboopm\entities\passive\Horse;
use bamboopm\entities\passive\Mooshroom;
use bamboopm\entities\passive\Mule;
use bamboopm\entities\passive\Ocelot;
use bamboopm\entities\passive\Parrot;
use bamboopm\entities\passive\Pig;
use bamboopm\entities\passive\PufferFish;
use bamboopm\entities\passive\Rabbit;
use bamboopm\entities\passive\Salmon;
use bamboopm\entities\passive\Sheep;
use bamboopm\entities\passive\SkeletonHorse;
use bamboopm\entities\passive\Sniffer;
use bamboopm\entities\passive\SnowGolem;
use bamboopm\entities\passive\Squid;
use bamboopm\entities\passive\Strider;
use bamboopm\entities\passive\Tadpole;
use bamboopm\entities\passive\TropicalFish;
use bamboopm\entities\passive\Turtle;
use bamboopm\entities\passive\Villager;
use bamboopm\entities\passive\WanderingTrader;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\World;

class EntityClassMapper
{
    public function registerEntities(): void
    {
        $entityFactory = EntityFactory::getInstance();
        foreach (self::getClasses() as $entityName => $typeClass) {
            $entityFactory->register($typeClass, function (World $world, CompoundTag $nbt) use ($typeClass): AbstractMob {
                return new $typeClass(EntityDataHelper::parseLocation($nbt, $world), $nbt);
            }, [$entityName]);
        }
    }

    public function getClasses(): array
    {
        return [
            "Allay" => Allay::class,
            "Axolotl" => Axolotl::class,
            "Bat" => Bat::class,
            "Bee" => Bee::class,
            "Blaze" => Blaze::class,
            "Camel" => Camel::class,
            "Cat" => Cat::class,
            "CaveSpider" => CaveSpider::class,
            "Chicken" => Chicken::class,
            "Cod" => Cod::class,
            "Cow" => Cow::class,
            "Creeper" => Creeper::class,
            "Dolphin" => Dolphin::class,
            "Donkey" => Donkey::class,
            "Drowned" => Drowned::class,
            "ElderGuardian" => ElderGuardian::class,
            "Enderman" => Enderman::class,
            "Endermite" => Endermite::class,
            "Fox" => Fox::class,
            "Frog" => Frog::class,
            "GlowSquid" => GlowSquid::class,
            "Goat" => Goat::class,
            "Ghast" => Ghast::class,
            "Guardian" => Guardian::class,
            "Horse" => Horse::class,
            "Husk" => Husk::class,
            "Hoglin" => Hoglin::class,
            "IronGolem" => IronGolem::class,
            "Llama" => Llama::class,
            "MagmaCube" => MagmaCube::class,
            "Mooshroom" => Mooshroom::class,
            "Mule" => Mule::class,
            "Ocelot" => Ocelot::class,
            "Panda" => Panda::class,
            "Parrot" => Parrot::class,
            "Phantom" => Phantom::class,
            "Pig" => Pig::class,
            "Pillager" => Pillager::class,
            "Piglin" => Piglin::class,
            "PiglinBrute" => PiglinBrute::class,
            "PolarBear" => PolarBear::class,
            "PufferFish" => PufferFish::class,
            "Rabbit" => Rabbit::class,
            "Ravager" => Ravager::class,
            "Salmon" => Salmon::class,
            "Sheep" => Sheep::class,
            "Silverfish" => Silverfish::class,
            "Skeleton" => Skeleton::class,
            "SkeletonHorse" => SkeletonHorse::class,
            "Slime" => Slime::class,
            "Sniffer" => Sniffer::class,
            "SnowGolem" => SnowGolem::class,
            "Spider" => Spider::class,
            "Squid" => Squid::class,
            "Strider" => Strider::class,
            "Stray" => Stray::class,
            "Tadpole" => Tadpole::class,
            "TraderLlama" => TraderLlama::class,
            "TropicalFish" => TropicalFish::class,
            "Turtle" => Turtle::class,
            "Villager" => Villager::class,
            "Vindicator" => Vindicator::class,
            "Vex" => Vex::class,
            "WanderingWitch" => WanderingTrader::class,
            "Warden" => Warden::class,
            "Witch" => Witch::class,
            "Wolf" => Wolf::class,
            "WitherSkeleton" => WitherSkeleton::class,
            "Zombie" => Zombie::class,
            "ZombieVillager" => ZombieVillager::class,
            "Zoglin" => Zoglin::class
        ];
    }
}
