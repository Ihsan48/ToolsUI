<?php

namespace HenryDM\ToolsUI\Events\Quit;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerQuitEvent;
use HenryDM\ToolsUI\Utils\PluginUtils;

class QuitSound implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onQuit(PlayerQuitEvent $event) {
# ========================= 
        $player = $event->getPlayer();
# =========================         
        if($this->getMain()->cfg->get("quit-sound") === true) {
            PluginUtils::playSound($player, $this->getMain()->cfg->get("quit-sound-name"), 1, 1);
        }
    }
    public function getMain() : Main {
        return $this->main;
    }
}
