<?php

namespace T2N\endiorite\items\tools\endiorite;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use T2N\endiorite\Main;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;
use pocketmine\item\Sword;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;

class EndioriteSword extends Sword implements ItemComponents {

    use ItemComponentsTrait;
    
    const DURABILITY = 6500;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $this->initComponent("azurite_sword", 1, new CreativeInventoryInfo("equipment", "itemGroup.name.sword"));
        $this->addProperty("hand_equipped", true);
        $this->addProperty("damage", Main::$instance->utils::ENDIUM_SWORD_DAMAGE);
        $this->addComponent("minecraft:durability", CompoundTag::create()
                    ->setTag("damage_chance", CompoundTag::create()
                        ->setTag("max", new IntTag(100))
                        ->setTag("min", new IntTag(100))
                    )
                    ->setTag("max_durability", new IntTag(self::DURABILITY))
        );
    }

    public function getMaxDurability(): int {
        return Main::$instance->utils::ENDIUM_TOOLS_DURABILITY;
    }

}