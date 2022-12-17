<?php

namespace T2N\endiorite\tasks;

use DaPigGuy\PiggyFactions\PiggyFactions;
use T2N\endiorite\Main;
use T2N\endiorite\rank\Rank;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\Config;

class ScoreboardTask extends Task {

    public function onRun(): void {
        foreach(Server::getInstance()->getOnlinePlayers() as $sender) {
            $sb = Main::$instance->utils;
            $sb->new($sender, "ObjectiveName", "§9Endiorite §fV3");
            $sb->setLine($sender, 1, "§7 ");
            $sb->setLine($sender, 2, $this->convertMessage($sender, "§l§9{username}"));
            $sb->setLine($sender, 3, $this->convertMessage($sender, "§f Grade: §b{grade}"));
            $sb->setLine($sender, 4, $this->convertMessage($sender, "§f Faction: §b{faction}"));
            $sb->setLine($sender, 5, $this->convertMessage($sender, "§f Solde: §b{solde}"));
            $sb->setLine($sender, 6, "§c ");
            $sb->setLine($sender, 7, "§9play.endiorite.com");
        }
    }

    public function convertMessage(Player $sender, string $message): array|string {
        return str_replace(
            array(
                "{username}", "{ping}", '{faction}', '{grade}', '{solde}', '{tps}', '{online}', '{max_online}'
            ),
            array(
                $sender->getName(),
                $sender->getNetworkSession()->getPing(),
                $this->getFactions($sender),
                $this->getRank($sender),
                $this->getSoldes($sender),
                Server::getInstance()->getTicksPerSecond(),
                count(Server::getInstance()->getOnlinePlayers()),
                Server::getInstance()->getMaxPlayers()
            ),
            $message
        );
    }

    private function getFactions($sender): string {
        $faction = Server::getInstance()->getPluginManager()->getPlugin("PiggyFactions");
        assert($faction instanceof PiggyFactions);
        /*
        $fac = $faction->getPlayerManager()->getPlayer($sender);
        if(!$fac->getFaction()) {
            return $fac->getFaction()->getName();
        } else {
            return "§bAucune.";
        }
        */
        return "§bAucune.";
    }

    private function getRank(Player $sender) {
        return "Aucun";
    }

    private function getSoldes($sender): string {
        $solde = Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI");
        assert($solde instanceof EconomyAPI);

        return  $solde->myMoney($sender);
    }

}