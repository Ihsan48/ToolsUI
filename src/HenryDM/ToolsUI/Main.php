<?php

namespace HenryDM\ToolsUI;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use HenryDM\BlockPerms\Events\Join\JoinMessage;
use HenryDM\BlockPerms\Events\Join\JoinSound;

use HenryDM\BlockPerms\Events\Quit\QuitClear;
use HenryDM\BlockPerms\Events\Quit\QuitSound;

class Main extends PluginBase implements Listener {

    /*** @var Main */
    private static Main $instance;

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig();

        $events = [
            JoinMessage::class,
            JoinSound::class,
            QuitClear::class,
            QuitSound::class
        ];
        foreach($events as $e) {
            $this->getServer()->getPluginManager()->registerEvents(new $e($this), $this);
        }
    }

    public function onLoad() : void {
        self::$instance = $this;
    }

    public static function getInstance() : Main {
        return self::$instance;
    }

    public function getMainConfig() : Config {
        return $this->cfg;
    }
}