<?php

namespace HenryDM\ToolsUI;

# Plugin Forms Libs 
use HenryDM\ToolsUI\Form\SimpleForm;
use HenryDM\ToolsUI\Form\CustomForm;
use HenryDM\ToolsUU\Form\ModalForm;

# Pocketmine Libs
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

# Plugin Events Libs 
use HenryDM\ToolsUI\Events\Join\JoinMessage;
use HenryDM\ToolsUI\Events\Join\JoinSound;
use HenryDM\ToolsUI\Events\Quit\QuitSound;
use HenryDM\ToolsUI\Events\Quit\QuitClear;

class Main extends PluginBase implements Listener {

      public function onEnable() : void {
        $this->saveDefaultConfig();
        if($this->getConfig()->get("Config-Version") < "1.0.0") {
          $this->getLogger()->warning("Your config file is outdate, Please consider update!")
          rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_outdate.yml");
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
        
        public function onDisable() : void {
          $this->saveDefaultConfig();
        }
        
        public function onLoad() : void {
          self::$instance = $this;
        }
      
        public function getInstance() : Main {
          return self::$instance;
        }
  
        public function getMainConfig() : Config {
          return $this->cfg;
        }
    } 
}
