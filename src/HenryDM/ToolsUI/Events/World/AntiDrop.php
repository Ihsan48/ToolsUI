<?php 

namespace HenryDM\ToolsUI\Events\World;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;

class AntiDrop implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDrop(PlayerDropItemEvent $event) {
        $player = $event->getPlayer();
        $message = $this->getMain()->cfg->get("anti-drop-message");
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        if($this->getMain()->cfg->get("anti-drop") === true) {
            if(in_array($worldName, $this->getMain()->cfg->get("anti-drop-worlds", []))) {
                $event->cancel();
                if($this->getMain()->cfg->get("anti-drop-alert-message") == true) {
                    if($this->getMain()->cfg->get("anti-drop-message-popup") === true) {
                        $player->sendPopup($message);
                    } else {
                        $player->sendMessage($message);
                    }
                }
            }
        }
    }
    public function getMain() : Main {
        return $this->main;
    }
}