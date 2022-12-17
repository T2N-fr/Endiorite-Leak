<?php

namespace T2N\endiorite\API;

use T2N\endiorite\Main;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class BoxAPI {

    public string $sender;

    public function __construct(string $sender) {
        $this->sender = $sender;
    }

    private function getConfig(): Config {
        return new Config(Main::$instance->getDataFolder() . "stats/{$this->sender}-box.json");
    }

    private function getCfg(): Config {
        return new Config(Main::$instance->getDataFolder() . "box.yml");
    }

    public function init(): void {
        $config = $this->getConfig();
        $config->set("commun", 0);
        $config->set("vote", 0);
        $config->set("fancy", 0);
        $config->set("loots", 0);
        $config->set("obsidian", 0);
        try { $config->save(); } catch(\JsonException $e) {}
    }

    public function getKey(string $key) {
        $config = $this->getConfig();
        return $config->get("$key");
    }

    public function addKey(string $key, int $value): void {
        $config = $this->getConfig();
        $config->set("$key", $this->getKey($key) + $value);
        try { $config->save(); } catch (\JsonException $e) {}
    }

    public function getLoots(string $box): void {
        $config = $this->getCfg();
        $allItems = $config->getNested("box.{$box}.items");

        $item = explode(":", $allItems[array_rand($allItems)]);
        $item = ItemFactory::getInstance()->get("$item[0]", "$item[1]", "$item[2]");
        if($this->sender instanceof Player) {
            $this->sender->getInventory()->addItem($item);
        }
    }

}