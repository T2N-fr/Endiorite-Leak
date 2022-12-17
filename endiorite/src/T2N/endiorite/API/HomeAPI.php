<?php

namespace T2N\endiorite\API;

use T2N\endiorite\commands\homes\DelHomeCmd;
use T2N\endiorite\commands\homes\HomesCmd;
use T2N\endiorite\commands\homes\SetHomeCmd;
use T2N\endiorite\Main;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\world\Position;

class HomeAPI {

    public Config $home;
    public Config $homeCount;
    protected array $message = [
        "create" => "§f Vous avez créé un nouveau home sous le nom de §b{name}§f.",
        "teleport" => "§f Vous avez été téléportés sur votre home §b{name}§f.",
        "no-exists" => "§c Ce home n'existe pas dans notre base de donnée!",
        "home-exists" => "§c Vous avez déjà un home avec ce nom!",
        "del-home" => "§f Vous avez supprimé le home §b{name}§f.",
        "home-not-exists" => "§c Ce home n'existe pas sur le serveur!",
        "home-max" => "§c Vous avez atteint votre limite de home!"
    ];
    protected function getPrefix(): string { return Main::$instance->utils->getPrefix(); }
    protected function getLimiteHome(): int { return 3; }
    protected function getPlayerName(Player $sender): string { return strtolower($sender->getName()); }

    public function __construct() {
        $this->home = new Config(Main::$instance->getDataFolder() . "homes.json", Config::JSON);
        $this->homeCount = new Config(Main::$instance->getDataFolder() . "homes-count.json", Config::JSON);
        Server::getInstance()->getCommandMap()->registerAll("homes", [
            new HomesCmd(), new SetHomeCmd(), new DelHomeCmd()
        ]);
    }

    protected function saveConfig(): void {
        try { $this->homeCount->save(); } catch(\JsonException $e) {}
        try { $this->home->save(); } catch(\JsonException $e) {}
    }

    protected function getPosition(string $name): Position {
        $get = $this->home->get($name);
        return new Position($get[0], $get[1], $get[2], Server::getInstance()->getWorldManager()->getWorldByName($get[3]));
    }

    protected function homeExist(string $name): bool {
        if($this->home->exists($name)) {
            return true;
        } else {
            return false;
        }
    }

    protected function addCount(Player $sender): void {
        if($this->homeCount->exists($sender->getName())) {
            $this->homeCount->set($sender->getName(), $this->homeCount->get($sender->getName()) + 1);
            $this->saveConfig();
        } else {
            $this->homeCount->set($sender->getName(), 1);
            $this->saveConfig();
        }
    }

    protected function delCount(Player $sender): void {
        if($this->homeCount->exists($sender->getName())) {
            $this->homeCount->set($sender->getName(), $this->homeCount->get($sender->getName()) - 1);
            $this->saveConfig();
        }
    }

    protected function getCountHome(Player $sender): bool {
        if($this->homeCount->exists($sender->getName())) {
            if($this->homeCount->get($sender->getName()) == $this->getLimiteHome()) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function setHome(Player $sender, string $name, Position $position): void {
        $username = $this->getPlayerName($sender);
        if($this->getCountHome($sender)) {
            if(!$this->homeExist("{$username}.{$name}")) {
                $this->home->set("{$username}.{$name}", [$position->x, $position->y, $position->z, $position->world->getFolderName()]);
                $this->addCount($sender);
                $this->saveConfig();
                $sender->sendMessage($this->getPrefix() . str_replace("{name}", $name, $this->message["create"]));
            } else {
                $sender->sendMessage($this->getPrefix() . $this->message["home-exists"]);
            }
        } else {
            $sender->sendMessage($this->getPrefix() . $this->message["home-max"]);
        }
    }

    public function teleportHome(Player $sender, string $name): void {
        $username = $this->getPlayerName($sender);
        if($this->homeExist("{$username}.{$name}")) {
            $sender->teleport($this->getPosition("{$username}.{$name}"));
            $sender->sendMessage($this->getPrefix() . str_replace("{name}", $name, $this->message["teleport"]));
        } else {
            $sender->sendMessage($this->getPrefix() . $this->message["no-exists"]);
        }
    }

    public function deleteHome(Player $sender, string $name): void {
        $username = $this->getPlayerName($sender);
        if($this->homeExist("{$username}.{$name}")) {
            $this->home->remove("{$username}.{$name}");
            $this->delCount($sender);
            $this->saveConfig();
            $sender->sendMessage($this->getPrefix() . str_replace("{name}", $name, $this->message["del-home"]));
        } else {
            $sender->sendMessage($this->getPrefix() . $this->message["home-not-exists"]);
        }
    }

}