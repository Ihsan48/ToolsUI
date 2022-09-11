<?php 

namespace HenryDM\ToolsUI\Events\World;

use HenryDM\ToolsUI\Main;
use pocketmine\event\Listener;

use pocketmine\event\block\BlockBreakEvent;

class AntiBreak implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        if($this->getMain()->cfg->get("anti-break") === true) {
            if(in_array($worldName, $this->getMain()->cfg->get("anti-break-worlds", []))) {
                $event->cancel();
                    if($this->getMain()->Cfg->get("anti-break-alert-message") === true) {
                        $player->sendPopup($this->getMain()->cfg->get("anti-break-message"));
                    }
                }
            }
        }
    }
}