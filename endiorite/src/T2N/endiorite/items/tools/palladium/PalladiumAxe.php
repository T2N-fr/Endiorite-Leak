<?php

namespace T2N\endiorite\items\tools\palladium;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use T2N\endiorite\Main;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Axe;
use pocketmine\item\ToolTier;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\IntTag;

class PalladiumAxe extends Axe implements ItemComponents {

    use ItemComponentsTrait;
    
    const SPEED = 11;
    
    const DURABILITY = 5250;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $this->initComponent("paladium_axe", 1, new CreativeInventoryInfo("equipment", "itemGroup.name.axe"));
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
                ->setTag("block", CompoundTag::create()->setString("tags", "query.any_tag('plank', 'wood')"))
                ->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:planks")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:stripped_oak_log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:stripped_spruce_log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:stripped_birch_log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:stripped_jungle_log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:stripped_acacia_log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:stripped_dark_oak_log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:stripped_oak_log")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:log2")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:wood")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:trapdoor")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:fence")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:fence_gate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_fence_gate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:birch_fence_gate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_fence_gate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_fence_gate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:acacia_fence_gate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:oak_stairs")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_stairs")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:birch_stairs")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_stairs")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_stairs")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:wooden_door")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_door")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:birch_door")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_door")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:acacia_door")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_door")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_trapdoor")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_trapdoor")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_trapdoor")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_trapdoor")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_trapdoor")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:ladder")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:wooden_slab")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:double_wooden_slab")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:melon_block")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:pumpkin")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:carved_pumpkin")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:lit_pumpkin")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:bed")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:crafting_table")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:fletching_table")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:bookshelf")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:lectern")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:chest")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:trapped_chest")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:barrel")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:noteblock")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jukebox")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:standing_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:wall_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_standing_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_wall_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:birch_standing_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:birch_wall_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_standing_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_wall_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:acacia_standing_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:acacia_wall_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:darkoak_standing_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:darkoak_wall_sign")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:frame")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:redstone_torch")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:unlit_redstone_torch")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:lever")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:wooden_button")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_button")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_button")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_button")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:birch_button")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:acacia_button")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:tripwire_hook")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:wooden_pressure_plate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:spruce_pressure_plate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:jungle_pressure_plate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:dark_oak_pressure_plate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:birch_pressure_plate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:acacia_pressure_plate")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:loom")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:standing_banner")->setInt("speed", self::SPEED),
            CompoundTag::create()->setString("block", "minecraft:wall_banner")->setInt("speed", self::SPEED)
        ])));
    }

    public function getMaxDurability(): int {
        return Main::$instance->utils::PALLADIUM_TOOLS_DURABILITY;
    }

}