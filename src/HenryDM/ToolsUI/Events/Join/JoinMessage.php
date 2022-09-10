<?php

namespace HenryDM\ToolsUI\Events\Join;


use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;

use HenryDM\ToolsUI\Main;

class JoinMessage implements Listener {
    
    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        if($this->getMain()->cfg->get("join-message") === true) {
            $message = str_replace(["{player}", "{line}"], [$name, "\n"], $this->getMain()->cfg->get("message"));
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