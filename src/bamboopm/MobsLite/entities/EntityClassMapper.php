<?php

declare(strict_types=1);

namespace bamboopm\MobsLite\entities;

use bamboopm\MobsLite\entities\hostile\Blaze;
use bamboopm\MobsLite\entities\hostile\Creeper;
use bamboopm\MobsLite\entities\hostile\Drowned;
use bamboopm\MobsLite\entities\hostile\ElderGuardian;
use bamboopm\MobsLite\entities\hostile\Endermite;
use bamboopm\MobsLite\entities\hostile\Ghast;
use bamboopm\MobsLite\entities\hostile\Guardian;
use bamboopm\MobsLite\entities\hostile\Hoglin;
use bamboopm\MobsLite\entities\hostile\Husk;
use bamboopm\MobsLite\entities\hostile\MagmaCube;
use bamboopm\MobsLite\entities\hostile\Phantom;
use bamboopm\MobsLite\entities\hostile\PiglinBrute;
use bamboopm\MobsLite\entities\hostile\Pillager;
use bamboopm\MobsLite\entities\hostile\Ravager;
use bamboopm\MobsLite\entities\hostile\Silverfish;
use bamboopm\MobsLite\entities\hostile\Skeleton;
use bamboopm\MobsLite\entities\hostile\Slime;
use bamboopm\MobsLite\entities\hostile\Stray;
use bamboopm\MobsLite\entities\hostile\Vex;
use bamboopm\MobsLite\entities\hostile\Vindicator;
use bamboopm\MobsLite\entities\hostile\Warden;
use bamboopm\MobsLite\entities\hostile\Witch;
use bamboopm\MobsLite\entities\hostile\WitherSkeleton;
use bamboopm\MobsLite\entities\hostile\Zoglin;
use bamboopm\MobsLite\entities\hostile\Zombie;
use bamboopm\MobsLite\entities\hostile\ZombieVillager;
use bamboopm\MobsLite\entities\neutral\Bee;
use bamboopm\MobsLite\entities\neutral\CaveSpider;
use bamboopm\MobsLite\entities\neutral\Dolphin;
use bamboopm\MobsLite\entities\neutral\Enderman;
use bamboopm\MobsLite\entities\neutral\Goat;
use bamboopm\MobsLite\entities\neutral\IronGolem;
use bamboopm\MobsLite\entities\neutral\Llama;
use bamboopm\MobsLite\entities\neutral\Panda;
use bamboopm\MobsLite\entities\neutral\Piglin;
use bamboopm\MobsLite\entities\neutral\PolarBear;
use bamboopm\MobsLite\entities\neutral\Spider;
use bamboopm\MobsLite\entities\neutral\TraderLlama;
use bamboopm\MobsLite\entities\neutral\Wolf;
use bamboopm\MobsLite\entities\passive\Allay;
use bamboopm\MobsLite\entities\passive\Axolotl;
use bamboopm\MobsLite\entities\passive\Bat;
use bamboopm\MobsLite\entities\passive\Camel;
use bamboopm\MobsLite\entities\passive\Cat;
use bamboopm\MobsLite\entities\passive\Chicken;
use bamboopm\MobsLite\entities\passive\Cod;
use bamboopm\MobsLite\entities\passive\Cow;
use bamboopm\MobsLite\entities\passive\Donkey;
use bamboopm\MobsLite\entities\passive\Fox;
use bamboopm\MobsLite\entities\passive\Frog;
use bamboopm\MobsLite\entities\passive\GlowSquid;
use bamboopm\MobsLite\entities\passive\Horse;
use bamboopm\MobsLite\entities\passive\Mooshroom;
use bamboopm\MobsLite\entities\passive\Mule;
use bamboopm\MobsLite\entities\passive\Ocelot;
use bamboopm\MobsLite\entities\passive\Parrot;
use bamboopm\MobsLite\entities\passive\Pig;
use bamboopm\MobsLite\entities\passive\PufferFish;
use bamboopm\MobsLite\entities\passive\Rabbit;
use bamboopm\MobsLite\entities\passive\Salmon;
use bamboopm\MobsLite\entities\passive\Sheep;
use bamboopm\MobsLite\entities\passive\SkeletonHorse;
use bamboopm\MobsLite\entities\passive\Sniffer;
use bamboopm\MobsLite\entities\passive\SnowGolem;
use bamboopm\MobsLite\entities\passive\Squid;
use bamboopm\MobsLite\entities\passive\Strider;
use bamboopm\MobsLite\entities\passive\Tadpole;
use bamboopm\MobsLite\entities\passive\TropicalFish;
use bamboopm\MobsLite\entities\passive\Turtle;
use bamboopm\MobsLite\entities\passive\Villager;
use bamboopm\MobsLite\entities\passive\WanderingTrader;
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
