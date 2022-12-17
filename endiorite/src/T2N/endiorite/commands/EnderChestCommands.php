<?php

namespace T2N\endiorite\commands;

use T2N\endiorite\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class EnderChestCommands extends Command {

    public function __construct() {
        parent::__construct("enderchest", "Ouvrir votre EnderChest", "/enderchest", ["ec"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            if($sender->hasPermission(Main::$instance->utils::ENDER_CHEST_PERM) || Server::getInstance()->isOp($sender->getName())) {
                Main::$instance->enderChestAPI->open($sender);
            }
        }
    }

}