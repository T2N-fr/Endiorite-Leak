<?php

namespace T2N\endiorite\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class LobbyCmd extends Command {

    public function __construct() {
        parent::__construct("lobby", "Lobby");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            $sender->transfer("play.endiorite.com", 19132);
        }
    }
}