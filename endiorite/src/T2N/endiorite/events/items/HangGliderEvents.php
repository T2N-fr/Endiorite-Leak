<?php

namespace T2N\endiorite\events\items;

use T2N\endiorite\effect\HangGliderEffect;
use T2N\endiorite\items\HangGlider;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\player\Player;

class HangGliderEvents implements Listener {

    public function onDamage(EntityDamageEvent $event) {
        $entity = $event->getEntity();
        if(!$entity instanceof Player) {
            return;
        }
        if($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            if($entity->getInventory()->getItemInHand() instanceof HangGlider) {
                $event->cancel();
            }
        }
    }

    public function isItem(PlayerItemHeldEvent $event) {
        $sender = $event->getPlayer();
        $item = $event->getItem();
        if($item instanceof HangGlider) {
            $sender->getEffects()->add(new HangGliderEffect(VanillaEffects::LEVITATION(), 100 * 999999, -4, false));
        } else {
            $sender->getEffects()->remove(VanillaEffects::LEVITATION());
            $sender->resetFallDistance();
        }
    }

}