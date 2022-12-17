<?php

namespace T2N\endiorite\API;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use customiesdevs\customies\item\CreativeInventoryInfo;
use T2N\endiorite\blocks\AmethysteOre;
use T2N\endiorite\blocks\CaveBlock;
use T2N\endiorite\blocks\Grinder;
use T2N\endiorite\blocks\GrinderCasing;
use T2N\endiorite\blocks\GrinderFrame;
use T2N\endiorite\blocks\PaladiumOre;
use T2N\endiorite\blocks\TitaneBlock;
use T2N\endiorite\blocks\TitaneOre;
use T2N\endiorite\blocks\TotemOfFertility;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;

class CustomBlockLoad {

    public function __construct() {
        CustomiesBlockFactory::getInstance()->registerBlock(
            TitaneOre::class, "minecraft:titane_ore", "Titane Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel()),
            new Model([new Material("*", "titane_ore", "blend")], "geometry.titane_ore", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
        CustomiesBlockFactory::getInstance()->registerBlock(
            PaladiumOre::class, "minecraft:paladium_ore", "Palladium Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel()),
            new Model([new Material("*", "paladium_ore", "blend")], "geometry.paladium_ore", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
        CustomiesBlockFactory::getInstance()->registerBlock(
            AmethysteOre::class, "minecraft:amethyste_ore", "Amethyste Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel()),
            new Model([new Material("*", "amethyste_ore", "blend")], "geometry.amethyste_ore", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
        CustomiesBlockFactory::getInstance()->registerBlock(
            TitaneBlock::class, "minecraft:titane_block", "Titane Block", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()),
            new Model([new Material("*", "titane_block", "blend")], "geometry.amethyste_ore", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
        CustomiesBlockFactory::getInstance()->registerBlock(
            TitaneBlock::class, "minecraft:amethyste_block", "Amethyste Block", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()),
            new Model([new Material("*", "amethyste_block", "blend")], "geometry.amethyste_ore", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
        CustomiesBlockFactory::getInstance()->registerBlock(
            TitaneBlock::class, "minecraft:paladium_block", "Palladium Block", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()),
            new Model([new Material("*", "paladium_block", "blend")], "geometry.amethyste_ore", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
        CustomiesBlockFactory::getInstance()->registerBlock(
            CaveBlock::class, "minecraft:cave_block", "Cave Block", new BlockBreakInfo(0.3),
            new Model([new Material("*", "cave_block", "blend")], "geometry.caveblock", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
        CustomiesBlockFactory::getInstance()->registerBlock(
            TotemOfFertility::class, "minecraft:totem_of_fertility", "Totem Of Fertility", new BlockBreakInfo(5.0),
            new Model([new Material("*", "totem_of_fertility", "blend")], "geometry.totem_of_fertility", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );

        CustomiesBlockFactory::getInstance()->registerBlock(
            Grinder::class, "minecraft:grinder", "Grinder", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()),
            new Model([new Material("*", "grinder", "blend")], "geometry.totem_of_fertility", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );

        CustomiesBlockFactory::getInstance()->registerBlock(
            GrinderCasing::class, "minecraft:grinder_casing", "Grinder Casing", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()),
            new Model([new Material("*", "grinder_casing", "blend")], "geometry.totem_of_fertility", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );

        CustomiesBlockFactory::getInstance()->registerBlock(
            GrinderFrame::class, "minecraft:grinder_frame", "Grinder Frame", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()),
            new Model([new Material("*", "grinder_frame", "blend")], "geometry.totem_of_fertility", new Vector3(-10, 0, -7), new Vector3(20, 10, 14)),
            new CreativeInventoryInfo("construction")
        );
    }

}