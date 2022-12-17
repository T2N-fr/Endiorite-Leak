<?php

namespace T2N\endiorite\items\armor\titane;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use T2N\endiorite\Main;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\inventory\ArmorInventory;

class TitaneHelmet extends Armor implements ItemComponents {

    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, new ArmorTypeInfo(5, Main::$instance->utils::TITANE_TOOLS_DURABILITY, ArmorInventory::SLOT_HEAD));
        $this->initComponent("titane_helmet", 1, new CreativeInventoryInfo("equipment", "itemGroup.name.helmet"));
        $this->addComponent("minecraft:wearable", CompoundTag::create()->setString("slot", "slot.armor.head"));
        $this->addComponent("minecraft:armor", CompoundTag::create()->setInt("protection", 5));
        $this->addComponent("minecraft:durability", CompoundTag::create()->setInt("max_durability", Main::$instance->utils::TITANE_TOOLS_DURABILITY));
    }

}