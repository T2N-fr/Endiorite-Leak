<?php

namespace T2N\endiorite\commands;

use T2N\endiorite\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class FeedCmd extends Command{

    public function __construct() {
        parent::__construct("feed", "Ce nourrir", "/feed");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            if($sender->hasPermission(Main::$instance->utils::FEED_PERM) || Server::getInstance()->isOp($sender->getName())) {
                $sender->getHungerManager()->setFood($sender->getHungerManager()->getMaxFood());
                $sender->getHungerManager()->setSaturation(20);
                $sender->sendMessage(Main::$instance->utils->getPrefix() . "§f Vous avez été feed.");
            }
        }
    }

}