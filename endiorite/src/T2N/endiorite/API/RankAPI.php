<?php

namespace T2N\endiorite\API;

use T2N\endiorite\Main;
use pocketmine\player\Player;
use pocketmine\Server;

class RankAPI {

    protected string $default = "Palladin";

    public array $config = array(
        "default" => "Palladin",
        "Palladin" => array(
            "nametag" => "joueur",
            "message" => "§7joueur {username} » {message}",
            "pseudo" => "§7joueur §7{username}",
            "permissions" => [ "kit.player" ]
        ),
        "MiniYtb" => array(
            "nametag" => "Mini-Youtubeur",
            "message" => "§4[§cMini-Youtubeur§4] {username}§4 » §c{message}",
            "pseudo" => "§4[§cMini-Youtubeur§4] {username}",
            "permissions" => [ "easykits.kit.youtube" ]
        ),
        "Ytb" => array(
            "nametag" => "Youtubeur",
            "message" => "§4[§cYoutubeur§4] {username}§4 » §c{message}",
            "pseudo" => "§4[§cYoutubeur§4] {username}",
            "permissions" => [ "easykits.kit.youtube" ]
        ),
        "Supreme" => array(
            "nametag" => "Suprême",
            "message" => "§6[§cSuprême§6] {username}§6 » §c{message}",
            "pseudo" => "§6[§cSuprême§6] {username}",
            "permissions" => []
        ),
        "Aventurier" => array(
            "nametag" => "Aventurier",
            "message" => "§5[§dAventurier§5] {username}§5 » §d{message}",
            "pseudo" => "§5[§dAventurier§5] {username}",
            "permissions" => [ "easykits.kit.aventurier" ]
        ),
        "Palladium" => array(
            "nametag" => "Palladium",
            "message" => "§6[§4Palladium§6] {username}§6 » §4{message}",
            "pseudo" => "§6[§4Palladium§6] {username}",
            "permissions" => [ "easykits.kit.palladin" ]
        ),
        "Titane" => array(
            "nametag" => "Gardien",
            "message" => "§7[§8Gardien§7] {username}§7 » §f{message}",
            "pseudo" => "§7[§8Gardien§7] {username}",
            "permissions" => [ "easykits.kit.gardien" ]
        ),
        "Endiorite" => array(
            "nametag" => "Endiorite",
            "message" => "§1[§9Endiorite§1] {username}§1 » §a{message}",
            "pseudo" => "§1[§9Endiorite§1] {username}",
            "permissions" => [ "easykits.kit.endiorite" ]
        ),
        "Guide" => array(
            "nametag" => "Guide",
            "message" => "§2[§aGuide§2] {username}§2 » §a{message}",
            "pseudo" => "§2[§aGuide§2] {username}",
            "permissions" => [
                "easykits.kit.player",
                "pocketmine.command.kick"
            ]
        ),
        "Developpeur" => array(
            "nametag" => "Developpeur",
            "message" => "§9[§1Développeur§9] {username}§9 » §1{message}",
            "pseudo" => "§9[§1Développeur§9] {username}",
            "permissions" => [ "easykits.kit.player" ]
        ),
        "Moderateur" => array(
            "nametag" => "Moderateur",
            "message" => "§6[§eModérateur§6] {username}§6 » §e{message}",
            "pseudo" => "§6[§eModérateur§6] {username}",
            "permissions" => [
                "easykits.kit.player",
                "pocketmine.command.ban",
                "pocketmine.command.ban.player",
                "pocketmine.command.kick",
                "pocketmine.command.teleport",
            ]
        ),
        "Super-Moderateur" => array(
            "nametag" => "Super-Moderateur",
            "message" => "§e[§3Super-§6Modérateur§e] {username}§e » §3{message}",
            "pseudo" => "§e[§3Super-§6Modérateur§e] {username}",
            "permissions" => [
                "easykits.kit.player",
                "pocketmine.command.ban",
                "pocketmine.command.ban.player",
                "pocketmine.command.ban.ip",
                "pocketmine.command.unban",
                "pocketmine.command.unban.player",
                "pocketmine.command.kick",
                "pocketmine.command.teleport",
            ]
        ),
        "Administrateur" => array(
            "nametag" => "Administrateur",
            "message" => "§9[§bAdministrateur§9] {username}§9 » §b{message}",
            "pseudo" => "§9[§bAdministrateur§9] {username}",
            "permissions" => [
                "easykits.kit.player",
                "pocketmine.command.ban",
                "pocketmine.command.ban.player",
                "pocketmine.command.ban.ip",
                "pocketmine.command.unban",
                "pocketmine.command.unban.player",
                "pocketmine.command.unban.ip",
                "pocketmine.command.kick",
                "pocketmine.command.teleport",
            ]
        ),
        "Fondateur" => array(
            "nametag" => "Fondateur",
            "message" => "§4[§cFondateur§4] {username}§4 » §c{message}",
            "pseudo" => "§4[§cFondateur§4] {username}",
            "permissions" => [ "easykits.kit.player" ]
        )
    );

    private function isPlayerRank(string $username): bool {
        if(Main::$instance->rankConfig->exists($username)) {
            return false;
        } else {
            return true;
        }
    }

    /*** @throws \JsonException */
    public function isRank(Player $sender): void {
        if(!$this->isPlayerRank($sender->getName())) {
            $this->setRank($sender->getName(), $this->config["default"]);
            $this->isRank($sender);
        } else {
            $this->init($sender);
        }
    }

    /** @throws \JsonException */
    public function setRank(string $username, string $rank): void {
        $cfg = Main::$instance->rankConfig;
        $cfg->set($username, $rank);
        $cfg->save();
        foreach(Server::getInstance()->getOnlinePlayers() as $player) {
            if($player->getName() == $username) {
                $this->init($player);
            }
        }
    }

    public function getRank(string $username) {
        $cfg = Main::$instance->rankConfig;
        return $cfg->get($username);
    }

    /*** @throws \JsonException */
    public function getRankScoreboard(Player $sender) {
        $configRank = Main::$instance->rankConfig;
        if($configRank->exists($sender->getName())) {
            $rank = $configRank->get($sender->getName());
            return $this->config[$rank]["nametag"];
        } else {
            $this->isRank($sender);
        }
    }

    public function init(Player $sender): void{
        $rank = $this->getRank($sender->getName());
        $nametag = $this->config[$rank]["pseudo"];
        $sender->setNameTag(str_replace(array("{username}", "{faction}"), array($sender->getName(), " "), $nametag));
        $this->addPerms($sender);
    }

    public function addPerms(Player $sender): void {
        if($this->isPlayerRank($sender->getName())) {
            $rank = $this->getRank($sender->getName());
            $perms = $this->config[$rank]["permissions"];
            foreach($perms as $perm) {
                $sender->addAttachment(Main::$instance, $perm, true);
            }
        }

    }

}