<?php

namespace HenryDM\ToolsUI;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use HenryDM\ToolsUI\Events\Join\JoinMessage;
use HenryDM\ToolsUI\Events\Join\JoinSound;

use HenryDM\ToolsUI\Events\Quit\QuitClear;
use HenryDM\ToolsUI\Events\Quit\QuitSound;

use HenryDM\ToolsUI\Events\World\AntiBreak;
use HenryDM\ToolsUI\Events\World\AntiPlace;
use HenryDM\ToolsUI\Events\World\AntiDrop;

class Main extends PluginBase implements Listener {

    /*** @var Main */
    private static Main $instance;

    const VERSION = "1.0.0";

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig();
        $this->ConfigVersion();

        $events = [
            JoinMessage::class,
            JoinSound::class,
            QuitClear::class,
            QuitSound::class,
            AntiPlace::class,
            AntiBreak::class,
            AntiDrop:class
        ];
        foreach($events as $e) {
            $this->getServer()->getPluginManager()->registerEvents(new $e($this), $this);
        }
    }

    private function ConfigVersion() : void {
      if (empty($this->cfg->getNested("config-version"))) return;
          if (($this->cfg->getNested("config-version")) < Main::VERSION) {
            $this->getLogger()->critical("Your configuration is outdate! Please consider update.");
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_outdate.yml");
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