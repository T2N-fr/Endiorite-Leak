<?php

namespace T2N\endiorite\API;

use T2N\endiorite\events\items\HangGliderEvents;
use T2N\endiorite\events\MineralLoots;
use T2N\endiorite\events\PlayerManager;
use T2N\endiorite\Main;
use pocketmine\Server;

class EventsAPI {

    public function __construct() {
        $list = [
            new PlayerManager(), new HangGliderEvents()/*, new MineralLoots() */
        ];
        foreach($list as $events) {
            Main::$instance->getServer()->getPluginManager()->registerEvents($events, Main::$instance);
        }

        foreach(array_diff(scandir(Server::getInstance()->getDataPath() . "worlds"), ["..", "."]) as $level) {
            Server::getInstance()->getWorldManager()->loadWorld($level);
        }
    }

}