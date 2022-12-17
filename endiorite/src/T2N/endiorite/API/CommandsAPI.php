<?php

namespace T2N\endiorite\API;

use T2N\endiorite\commands\EnderChestCommands;
use T2N\endiorite\commands\FeedCmd;
use T2N\endiorite\commands\HealCmd;
use T2N\endiorite\commands\IdCmd;
use T2N\endiorite\commands\LobbyCmd;
use T2N\endiorite\commands\MinageCmd;
use T2N\endiorite\commands\RtpCmd;
use T2N\endiorite\commands\SpawnCmd;
use pocketmine\Server;

class CommandsAPI {

    public function __construct() {
        Server::getInstance()->getCommandMap()->registerAll("endiorite", [
            new FeedCmd(), new HealCmd(), new IdCmd(),
            new EnderChestCommands(), new LobbyCmd()
        ]);
    }

}