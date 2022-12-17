<?php

namespace T2N\endiorite\API;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\ItemFactory;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;

class EnderChestAPI {

    public const MAX = 5;

    public function open(Player $sender): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("§bEndiorite Chest");
        $menu->getInventory()->setContents($sender->getEnderInventory()->getContents());

        for($x = 26; $x >= self::MAX ; $x--) {
            $menu->getInventory()->setItem($x, ItemFactory::getInstance()->get(160, 15,)->setCustomName("§cSlot bloqué"));
        }

        $menu->setListener(function(InvMenuTransaction $transaction) use ($sender): InvMenuTransactionResult {
            if($transaction->getAction()->getSlot() >= self::MAX) {
                return $transaction->discard();
            } else {
                return $transaction->continue();
            }
        });
        $menu->setInventoryCloseListener(function() use ($sender, $menu) {
            $sender->getEnderInventory()->setContents($menu->getInventory()->getContents());
        });

        $menu->send($sender);

        $packet = new PlaySoundPacket();
        $packet->x = $sender->getPosition()->x;
        $packet->y = $sender->getPosition()->y;
        $packet->z = $sender->getPosition()->z;
        $packet->soundName = "random.enderchestopen";
        $packet->volume = 1;
        $packet->pitch = 1;
        $sender->getNetworkSession()->sendDataPacket($packet);
    }

    /*
    private function open(Player $sender): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("§9Endiorite Chest");
        $menu->getInventory()->setContents($sender->getEnderInventory()->getContents());
        $menu->setListener(function(InvMenuTransaction $transaction) use ($sender): InvMenuTransactionResult {
            $sender->getEnderInventory()->setItem($transaction->getAction()->getSlot(), $transaction->getIn());
            return $transaction->continue();
        });
        $menu->send($sender);
        $packet = new PlaySoundPacket();
        $packet->x = $sender->getPosition()->x;
        $packet->y = $sender->getPosition()->y;
        $packet->z = $sender->getPosition()->z;
        $packet->soundName = "random.enderchestopen";
        $packet->volume = 1;
        $packet->pitch = 1;
        $sender->getNetworkSession()->sendDataPacket($packet);
    }
    */

}