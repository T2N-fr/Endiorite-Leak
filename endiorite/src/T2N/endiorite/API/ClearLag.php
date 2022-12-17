<?php

namespace T2N\endiorite\API;

use T2N\endiorite\Main;
use pocketmine\entity\Entity;
use pocketmine\entity\Human;
use pocketmine\entity\object\ExperienceOrb;
use pocketmine\entity\object\ItemEntity;
use pocketmine\scheduler\ClosureTask;

class ClearLag {

    public $interval;
    public $seconds;
    public $clearMobs;
    public $clearXpOrbs;
    public $clearItems;

    public $messages;

    protected array $config = [
        "seconds" => 500,
        "clear" => array(
            "items" => true,
            "mobs" => true,
            "xp-orbs" => true
        ),
        "broadcastTime" => [60, 30, 15, 10, 5, 4, 3, 2, 1],
        "messages" => array(
            "time" =>  "§l§9Endio§bClear §r§7> §fClearLag dans §b{seconds} seconde(s).",
            "clear" => "§l§9EndioClear §r§7> §b{x} entité(s) supprimée(s)."
        )
    ];

    public function init(): void {
        $main = Main::$instance;

        if(!is_numeric($this->config["seconds"] ?? 500)) {
            $main->getLogger()->error("La valeur seconds n'est pas numeric (clearlag)");
            $main->getServer()->getPluginManager()->disablePlugin($main);
            return;
        }

        $this->interval = $this->seconds = $this->config["seconds"];

        if(!is_array($this->config["clear"] ?? [])) {
            $main->getLogger()->error("La valeur clear n'est pas numeric (clearlag)");
            $main->getServer()->getPluginManager()->disablePlugin($main);
            return;
        }

        $clear = $this->config["clear"];
        $this->clearItems = (bool) ($clear["items"] ?? false);
        $this->clearMobs = (bool) ($clear["mobs"] ?? false);
        $this->clearXpOrbs = (bool) ($clear["xp-orbs"] ?? false);

        $message = $this->config["messages"];

        $main->getScheduler()->scheduleRepeatingTask(new ClosureTask(function() use ($message, $main): void {
            if(--$this->seconds === 0) {
                $close = 0;
                foreach(($main->getServer()->getWorldManager()->getWorlds()) as $level) {
                    foreach($level->getEntities() as $entity) {
                        if($this->clearItems && $entity instanceof ItemEntity) {
                            $entity->flagForDespawn();
                            ++$close;
                        } elseif($this->clearMobs && $entity instanceof Entity && !$entity instanceof Human) {
                            $entity->flagForDespawn();
                            ++$close;
                        } elseif($this->clearXpOrbs && $entity instanceof ExperienceOrb) {
                            $entity->flagForDespawn();
                            ++$close;
                        }
                    }
                }
                $main->getServer()->broadcastMessage(str_replace("{x}", (string) $close, $message["clear"]));
                $this->seconds = $this->interval;
            } elseif(in_array($this->seconds, $this->config["broadcastTime"])) {
                $main->getServer()->broadcastMessage(str_replace("{seconds}", (string) $this->seconds, $message["time"]));
            }
        }), 20);
    }

}