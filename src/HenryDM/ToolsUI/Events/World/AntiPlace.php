<?php 

namespace HenryDM\ToolsUI\Events\World;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;

use pocketmine\event\block\BlockPlaceEvent;

class AntiPlace implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onPlace(BlockPlaceEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        if($this->getMain()->cfg->get("anti-place") === true) {
            if(in_array($worldName, $this->getMain()->cfg->get("anti-place-worlds", []))) {
                $event->cancel();
                    if($this->getMain()->Cfg->get("anti-place-alert-message") === true) {
                        $player->sendPopup($this->getMain()->cfg->get("anti-place-message"));
                    }
                }
            }
        }
    }
}