<?php

namespace T2N\endiorite\API;

use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\Position;

class Utils {

    public const ADMIN_PERM = "admin.perm";

    public const AMETHYSTE_TOOLS_DURABILITY = 1561;
    public const TRAVEL_TOOLS_DURABILITY = 1561;
    public const TITANE_TOOLS_DURABILITY = 2031;
    public const PALLADIUM_TOOLS_DURABILITY = 3561;
    public const ENDIUM_TOOLS_DURABILITY = 4031;

    public const AMETHYSTE_SWORD_DAMAGE = 7;
    public const TITANE_SWORD_DAMAGE = 10;
    public const PALLADIUM_SWORD_DAMAGE = 13;
    public const ENDIUM_SWORD_DAMAGE = 16;

    public const FEED_PERM = "feed.perm";
    public const HEAL_PERM = "heal.perm";
    public const ENDER_CHEST_PERM = "enderchest.perm";

    public array $autosay = [
        "messages" => array(
            "§l§9[§b!!!§9]§r§f Il y a actuellement §b{online} joueur(s)§f de connecter sur le serveur.",
            "§l§9[§b!!!§9]§r§b {inscrit} joueur(s) §fsont inscrit sur le serveur",
            "§l§9[§b!!!§9]§r§f Vous souhaitez suivre nos sondages ? Nos annonces ? Rejoints nous sur notre discord !",
            "§l§9[§b!!!§9]§r§f Rejoint nous sur §bdiscord.gg/endiorite §f!"
        )
    ];

    public function getPrefix(): string { return "§l§9Endiorite §r§7> "; }
    public function getJoinMessage(string $username): string { return "§a[+] {$username}"; }
    public function getQuitMessage(string $username): string { return "§c[-] {$username}"; }

    public function goToSpawn(Player $sender): void {
        $sender->teleport(new Position(0.5, 73, 0, Server::getInstance()->getWorldManager()->getDefaultWorld()));
    }

    public function goToMinage(Player $sender): void {
        $sender->teleport(new Position(rand(-1500, 1500), 73, rand(-1500, 1500), Server::getInstance()->getWorldManager()->getDefaultWorld()));
        $sender->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(), 20 * 15, 250));
    }

    public function setupRenderOffSets(int $width, int $height, bool $handEquipped = false): CompoundTag {
        $scaleTag = CompoundTag::create()
            ->setTag("scale", new ListTag([
                new FloatTag(($handEquipped ? 0.075 : 0.1) / ($width / 16)),
                new FloatTag(($handEquipped ? 0.125 : 0.1) / ($height / 16)),
                new FloatTag(($handEquipped ? 0.075 : 0.1) / ($width / 16))
            ]));
        return CompoundTag::create()
            ->setTag("first_person", $scaleTag)
            ->setTag("third_person", $scaleTag);
    }

    public function countInscrit(): int {
        $dir = Server::getInstance()->getDataPath() . "players/";
        $count = 0;
        $f = glob($dir . "*");
        if($f) {
            $count = count($f);
        }
        return $count;
    }

    /**
     * Scoreboard API
     */
    public array $lists = [];
    public function getObjectiveName(Player $sender): ?string {
        return $this->lists[$sender->getName()] ?? null;
    }

    public function remove(Player $sender): void {
        $obj = $this->getObjectiveName($sender);
        $sender->getNetworkSession()->sendDataPacket(RemoveObjectivePacket::create(
            $obj
        ));
        unset($this->lists[$sender->getName()]);
    }

    public function new(Player $sender, string $obj, string $display): void {
        if(isset($this->lists[$sender->getName()])) {
            $this->remove($sender);
        }
        $sender->getNetworkSession()->sendDataPacket(SetDisplayObjectivePacket::create(
            "sidebar",
            $obj,
            $display,
            "dummy",
            0
        ));
        $this->lists[$sender->getName()] = $obj;
    }

    public function setLine(Player $sender, int $score, string $message): void {
        if(!isset($this->lists[$sender->getName()])) {
            return;
        }
        if($score > 15 || $score < 1) {
            return;
        }

        $objN = $this->getObjectiveName($sender);
        $e = new ScorePacketEntry();
        $e->objectiveName = $objN;
        $e->type = $e::TYPE_FAKE_PLAYER;
        $e->customName = $message;
        $e->score = $score;
        $e->scoreboardId = $score;

        $pk = new SetScorePacket();
        $pk->type = $pk::TYPE_CHANGE;
        $pk->entries[] = $e;

        $sender->getNetworkSession()->sendDataPacket($pk);
    }

}