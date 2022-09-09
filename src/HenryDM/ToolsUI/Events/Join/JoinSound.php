<?php

namespace HenryDM\ToolsUI\Events\Join;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;

class JoinSound implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onJoin(PlayerJoinEvent $event) {
# ========================= 
        $player = $event->getPlayer();
# =========================         
        if($this->getMain()->cfg->get("join-sound") === true) {
            Utils::playSound($player, $this->getMain()->cfg->get("join-sound-name"), 1, 1);
        }
    }
    public function getMain() : Main {
        return $this->main;
    }
}