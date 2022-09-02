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

# Coming Soon

class Main extends PluginBase implements Listener {

      public function onEnable() : void {
        $this->saveDefaultConfig();

  }
}
