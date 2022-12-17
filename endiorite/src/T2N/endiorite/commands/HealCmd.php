<?php

namespace T2N\endiorite\commands;

use T2N\endiorite\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class HealCmd extends Command {

    public function __construct() {
        parent::__construct("heal", "Ce soigner.", "/heal");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            if($sender->hasPermission(Main::$instance->utils::HEAL_PERM) || Server::getInstance()->isOp($sender->getName())) {
                $sender->sendMessage(Main::$instance->utils->getPrefix() . "§f Vous avez été heal.");
                $sender->setHealth($sender->getMaxHealth());
            }
        }
    }

}