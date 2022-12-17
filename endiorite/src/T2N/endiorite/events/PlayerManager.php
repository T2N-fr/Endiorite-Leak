<?php

namespace T2N\endiorite\events;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\item\CustomiesItemFactory;
use T2N\endiorite\blocks\CaveBlock;
use T2N\endiorite\Main;
use pocketmine\block\EnderChest;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\item\BeetrootSoup;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\math\Vector3;
use pocketmine\player\GameMode;
use pocketmine\world\Position;

class PlayerManager implements Listener {

    public function onJoin(PlayerJoinEvent $event) {
        $event->setJoinMessage(Main::$instance->utils->getJoinMessage($event->getPlayer()->getName()));

        #Main::$instance->utils->goToSpawn($event->getPlayer());
        $event->getPlayer()->setGamemode(GameMode::SURVIVAL());
    }


    public function onQuit(PlayerQuitEvent $event) {
        $event->setQuitMessage(Main::$instance->utils->getQuitMessage($event->getPlayer()->getName()));
    }

    protected array $caveBlock = [];
    public function placeCaveBlock(BlockPlaceEvent $event) {
        $sender = $event->getPlayer();
        $senderId = $sender->getId();
        $block = $event->getBlock();
        $pos = $block->getPosition();
        $id = $block->getId();
        $item = ItemFactory::getInstance()->get($block->getId());
        if($block instanceof CaveBlock) {
            $this->caveBlock[$senderId] = $sender->getPosition();
            $sender->setGamemode(GameMode::SPECTATOR());
            $sender->setImmobile(true);
            $sender->teleport(new Position($pos->x, $pos->y - 2, $pos->z, $pos->world));
            $sender->getInventory()->remove($item);
        }
    }
    public function leaveCaveBlock(PlayerToggleSneakEvent $event) {
        $sender = $event->getPlayer();
        $senderId = $sender->getId();
        if(isset($this->caveBlock[$senderId])) {
            $sender->setGamemode(GameMode::SURVIVAL());
            $sender->setImmobile(false);
            $sender->teleport($this->caveBlock[$senderId]);
            unset($this->caveBlock[$senderId]);
        }
    }

    public function openEnderChest(PlayerInteractEvent $event) {
        $sender = $event->getPlayer();
        $block = $event->getBlock();
        if($block instanceof EnderChest) {
            $event->cancel();
            Main::$instance->enderChestAPI->open($sender);
        }
    }

}