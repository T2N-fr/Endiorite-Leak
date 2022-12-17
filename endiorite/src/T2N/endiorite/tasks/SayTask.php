<?php

namespace T2N\endiorite\tasks;

use T2N\endiorite\Main;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class SayTask extends Task {

    public function onRun(): void {
        $list = str_replace(
            array("{online}", "{inscrit}"),
            array(count(Server::getInstance()->getOnlinePlayers()), Main::$instance->utils->countInscrit()),
            Main::$instance->utils->autosay["messages"][array_rand(Main::$instance->utils->autosay["messages"])]
        );
        Server::getInstance()->broadcastMessage($list);
    }

}