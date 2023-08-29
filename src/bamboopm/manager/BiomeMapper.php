<?php

declare(strict_types=1);

namespace bamboopm\manager;


class BiomeMapper
{
    private array $biomeMobs = [
        "PLAINS" => ["Bee", "Chicken", "Cow", "Donkey", "Enderman", "Horse", "Mule", "Pig", "Rabbit", "Sheep", "SkeletonHorse", "TraderLlama"],
        "FOREST" => ["Allay", "Bee", "Chicken", "Cow", "Enderman", "Pig", "Pillager", "Rabbit", "Sheep", "Wolf"],
        "BIRCH FOREST" => ["Allay", "Rabbit"],
        "CRIMSON FOREST" => ["Allay", "Rabbit"],
        "FLOWER FOREST" => ["Allay", "Bee", "Rabbit"],
        "ROOFED FOREST" => ["Allay", "Rabbit"],
        "WARPED FOREST" => ["Allay", "Rabbit"],
        "JUNGLE" => ["Chicken", "Ocelot", "Panda", "Parrot"],
        "BAMBOO JUNGLE" => ["Panda"],
        "TAIGA" => ["Fox", "Rabbit", "Wolf"],
        "COLD TAIGA" => ["Fox", "Rabbit"],
        "MEGA TAIGA" => ["Fox", "Rabbit"],
        "EXTREME HILLS" => ["Goat"],
        "DEEP DARK" => ["Warden"],
        "MUSHROOM ISLAND" => ["Mooshroom"],
        "BEACH" => ["Silverfish", "Turtle"],
        "DESERT" => ["Camel", "Husk", "TraderLlama"],
        "SAVANNA" => ["Donkey", "Horse", "Mule", "TraderLlama"],
        "OCEAN" => ["Cod", "Dolphin", "Drowned", "ElderGuardian", "Guardian", "PufferFish", "Squid"],
        "WARM OCEAN" => ["TropicalFish"],
        "FROZEN OCEAN" => ["PolarBear"],
        "DEEP OCEAN" => ["GlowSquid"],
        "RIVER" => ["Dolphin", "Drowned", "Salmon"],
        "FROZEN RIVER" => ["PolarBear"],
        "SWAMPLAND" => ["Drowned", "Frog", "Slime", "Tadpole", "Witch"],
        "LUSH CAVES" => ["Axolotl", "Tadpole"],
        "HELL" => ["Blaze", "Enderman", "Ghast", "Hoglin", "MagmaCube", "Piglin", "PiglinBrute", "Strider", "WitherSkeleton", "Zoglin"],
        "THE END" => ["Enderman", "Endermite"],
        "NIGHT MOBS" => ["Zombie", "Creeper", "Skeleton", "ZombieVillager", "Witch", "Spider", "Enderman", "Husk", "Phantom"]
    ];

    public function getMobsForBiome(string $worldName, string $biome, bool $isNight = false): array
    {
        $biome = strtoupper($biome);

        if (!array_key_exists($biome, $this->biomeMobs)) {
            if ($worldName === "overworld") {
                $biome = "PLAINS";
            } elseif ($worldName === "nether") {
                $biome = "HELL";
            } elseif ($worldName === "the_end") {
                $biome = "THE END";
            } else {
                $biome = "PLAINS";
            }
        }

        $mobTable = $this->biomeMobs[$biome];

        if ($isNight and $worldName === "overworld") {
            return $this->biomeMobs["NIGHT MOBS"];
        }

        return $mobTable;
    }
}
