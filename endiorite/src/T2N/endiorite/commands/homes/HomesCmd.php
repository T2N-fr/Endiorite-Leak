<?php

namespace T2N\endiorite\commands\homes;

use T2N\endiorite\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class HomesCmd extends Command {

    public function __construct() {
        parent::__construct("home", "Vos homes.", "/home <nom>");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            if(isset($args[0])) {
                Main::$instance->homeAPI->teleportHome($sender, $args[0]);
            } else {
                $sender->sendMessage(Main::$instance->utils->getPrefix() . $this->getUsage());
            }
        }
    }

}