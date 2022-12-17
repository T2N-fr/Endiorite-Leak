<?php

namespace T2N\endiorite\commands;

use T2N\endiorite\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\player\Player;

class RtpCmd extends Command {

    public function __construct() {
        parent::__construct("rtp", "RPT", "/rpt", ["randomteleport"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if($sender instanceof Player) {
            Main::$instance->utils->goToMinage($sender);
            $sender->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(), 20 * 15, 250));
            $sender->sendMessage(Main::$instance->utils->getPrefix() . "§f Vous avez été téléporté aléatoirement.");
        }
    }

}