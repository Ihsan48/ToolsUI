<?php

namespace HenryDM\CustomPVP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use HenryDM\CustomPVP\Events\Join\JoinMessage;
use HenryDM\CustomPVP\Events\Join\JoinSound;

use HenryDM\CustomPVP\Events\Quit\QuitClear;
use HenryDM\CustomPVP\Events\Quit\QuitSound;

class Main extends PluginBase implements Listener {

    /*** @var Main|null */
    private static Main|null $instance;

    /*** @var Config */
    public Config $cfg;

    public function onEnable() : void {
        $this->saveResource("config.yml");
        $this->cfg = $this->getConfig(); 
    }

    public function onLoad() : void {
      self::$instance = $this;
      if($this->getConfig()->get("config-version") < "1.0.0") {
        $this->getLogger()->warning("Your configuration is outdate! Please consider update.");
        rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_outdate.yml");
      }
    }    
    
    $events = [
      JoinMessage::class,
      JoinSound::class,
      QuitSound::class,
      QuitClear::class
    
    ];
    
    foreach($events as $ev) {
      $this->getServer()->getPluginManager()->registerEvents(new $ev($this), $this);
    }

    public function getInstance() : Main {
      return self::$instance;
    }

    public function getMainConfig() : Config {
      return $this->cfg;
    }
}