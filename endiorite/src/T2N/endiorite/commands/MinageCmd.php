<?php

namespace T2N\endiorite\commands;

use T2N\endiorite\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;

class MinageCmd extends Command {

    public function __construct() {
        parent::__construct("minage", "Monde minage", "/minage");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            Main::$instance->utils->goToMinage($sender);
            $sender->sendMessage(Main::$instance->utils->getPrefix() . "§f Monde minage.");
        }
    }

}