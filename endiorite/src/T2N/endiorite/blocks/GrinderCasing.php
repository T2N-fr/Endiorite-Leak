<?php

namespace T2N\endiorite\blocks;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;

class GrinderCasing extends Block {

    public function __construct(BlockIdentifier $idInfo, string $name, BlockBreakInfo $blockBreakInfo) {
        parent::__construct($idInfo, $name, $blockBreakInfo);
    }

}