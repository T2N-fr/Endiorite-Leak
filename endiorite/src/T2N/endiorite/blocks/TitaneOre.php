<?php

namespace T2N\endiorite\blocks;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\Opaque;

class TitaneOre extends Opaque {

    public function __construct(BlockIdentifier $idInfo, string $name, BlockBreakInfo $blockBreakInfo) {
        parent::__construct($idInfo, $name, $blockBreakInfo);
    }

}