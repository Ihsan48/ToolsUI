<?php 

namespace HenryDM\ToolsUI\Events\World;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;

class AntiDrop implements Listener {

    public function __construct(Main $main) {
        $this->main = $main
    }

    public function onDrop(PlayerDropItemEvent $event) {
        $player = $event->getPlayer();
        $message = $this->getMain()->cfg->get("anti-drop-message");
        $world = $player->getWorld();
        $worldName = $world->getForlderName();
        if($this->getMain()->cfg->get("anti-drop" === true) {
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
}