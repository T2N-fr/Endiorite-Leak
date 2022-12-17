<?php

namespace T2N\endiorite\items\armor\travel;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use T2N\endiorite\Main;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\nbt\tag\CompoundTag;

class TravelLeggings extends Item implements ItemComponents {

    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name);
        $this->initComponent("travel_leggings", 1, new CreativeInventoryInfo("equipment", "itemGroup.name.leggings"));
        $this->addComponent("minecraft:wearable", CompoundTag::create()->setString("slot", "slot.armor.legs"));
        $this->addComponent("minecraft:armor", CompoundTag::create()->setInt("protection", 5));
        $this->addComponent("minecraft:durability", CompoundTag::create()->setInt("max_durability", Main::$instance->utils::TRAVEL_TOOLS_DURABILITY));
    }

}