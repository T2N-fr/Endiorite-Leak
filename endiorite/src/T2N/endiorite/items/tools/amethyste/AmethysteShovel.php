<?php

namespace T2N\endiorite\items\tools\amethyste;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use T2N\endiorite\Main;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;
use pocketmine\item\Shovel;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;

class AmethysteShovel extends Shovel implements ItemComponents {

    use ItemComponentsTrait;

    const DURABILITY = 3200;
    
    const SPEED = 6;
    
    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $this->initComponent("amethiste_hovel", 1, new CreativeInventoryInfo("equipment", "itemGroup.name.shovel"));
        $this->addProperty("hand_equipped", true);
        $this->addComponent("minecraft:durability", CompoundTag::create()
                    ->setTag("damage_chance", CompoundTag::create()
                        ->setTag("max", new IntTag(100))
                        ->setTag("min", new IntTag(100))
                    )
                    ->setTag("max_durability", new IntTag(self::DURABILITY))
        );
        $this->addComponent("minecraft:digger", CompoundTag::create()->setTag("destroy_speeds", new ListTag([
            CompoundTag::create()
                ->setTag("block", CompoundTag::create()->setString("tags", "query.any_tag('grass', 'sand')"))
                ->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dirt")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:sand")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:concrete_powder")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:farmland")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:grass")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:grass_path")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:podzol")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:mycelium")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:snow")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:snow_layer")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:soul_sand")->setInt("speed", self::SPEED)
        ])));
    }

    public function getMaxDurability(): int {
        return Main::$instance->utils::AMETHYSTE_TOOLS_DURABILITY;
    }

}