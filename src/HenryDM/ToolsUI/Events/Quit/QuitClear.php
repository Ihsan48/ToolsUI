<?php

namespace HenryDM\ToolsUI\Events\Quit;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerQuitEvent;

class QuitClear implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        if($this->getMain()->cfg->get("quit-clear") === true) {
            if($this->getMain()->cfg->get("clear-normal-inventory") === true) {
                $player->getInventory()->clearAll();
            }
            if($this->getMain()->cfg->get("clear-armor-inventory") === true) {
                $player->getArmorInventory()->clearAll();
            }
        }
    }
    public function getMain() : Main {
        return $this->main;
    }
}