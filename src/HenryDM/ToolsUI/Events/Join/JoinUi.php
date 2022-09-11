<?php

namespace HenryDM\ToolsUI\Events\Join;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;

use HenryDM\ToolsUI\Main;

use Vecnavium\FormsUI\SimpleForm;

class JoinUi implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        if ($this->getMain()->cfg->getNested("join-ui", true)) {
            $this->sendForm($player);
        }
    }

    public function sendForm(Player $player) {
        $form = new SimpleForm (function (Player $player, int|null $data) {
            if (!isset($data)) {
                return true;
            }

            if ($data === 0) {
                if ($this->getMain()->cfg->getNested("exit-button", true)) {
                    if ($this->getMain()->cfg->getNested("exit-button-message-toggle", true)) {
                        $player->sendMessage($this->getMain()->cfg->getNested("exit-button-message"));
                    }
                }
            }
        });
        $form->setTItle($this->getMain()->cfg->getNested("join-title"));
        $form->setContent($this->getMain()->cfg->getNested("join-content"));
        if ($this->getMain()->cfg->getNested("exit-button", true)) {
            $form->addButton($this->getMain()->cfg->getNested("exit-button-text"));
        }
        return $form;
    }

    public function getMain() : Main {
        return $this->main;
    }
}