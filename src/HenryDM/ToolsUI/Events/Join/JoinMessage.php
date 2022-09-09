<?php

namespace HenryDM\ToolsUI\Events\Join\JoinMessage;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;

class JoinMessage implements Listener {
    
    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onJoin(PlayerJoinEvent $event) {
# ================================
       $player = $event->getPlayer();
       $message = $this->getMain()->cfg->get("message");
       $line = "\n"
       str_replace("{player}", "{line}", $name, $line);
       $name = $player->getName();
# ================================
        if($this->getMain()->cfg->get("join-message") === true) {
            if($this->getMain()->cfg->get("popup") === true) {
                $player->sendPopup($message);
            } else {
                $player->sendMessage($message);
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}
