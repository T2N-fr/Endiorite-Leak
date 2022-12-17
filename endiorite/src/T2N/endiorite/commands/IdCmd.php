<?php

namespace T2N\endiorite\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class IdCmd extends Command {

    public function __construct() {
        parent::__construct("id", "Id d'un item ou bloc", "/id");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            $item = $sender->getInventory()->getItemInHand();
            $id = $item->getId();
            $meta = $item->getMeta();

            $sender->sendMessage("ID: $id | META: $meta");
        }
    }

}