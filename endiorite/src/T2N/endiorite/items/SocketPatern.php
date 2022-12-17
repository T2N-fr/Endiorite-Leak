<?php

namespace T2N\endiorite\items;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use T2N\endiorite\Main;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Tool;
use pocketmine\nbt\tag\CompoundTag;

class SocketPatern extends Tool implements ItemComponents {

    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name);
        $this->initComponent("socket_patern", 1, new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS));
        $this->addProperty("hand_equipped", true);
        $this->addComponent("minecraft:render_offsets", CompoundTag::create()
            ->setTag("main_hand", Main::$instance->utils->setupRenderOffSets(32, 32, true))
            ->setTag("off_hand", Main::$instance->utils->setupRenderOffSets(32, 32, true))
        );
    }

    public function getMaxDurability(): int {
        return 8;
    }
}