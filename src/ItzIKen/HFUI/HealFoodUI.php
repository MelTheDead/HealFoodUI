<?php

namespace ItzIKen\HFUI;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;


class HealFoodUI extends PluginBase implements Listener
{

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§aPlugin HFUI Enabled!");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        switch ($cmd->getName()) {
            case "hfui":
                if ($sender instanceof Player) {
                    $sender->hasPermission("hfui.cmd");
                    $this->openMyForm($sender);
                }
        }
        return true;
    }

    public function openMyForm($player) {
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null) {
            switch ($data) {
                case 0:
                    /*$this->getServer()->dispatchCommand($player, ""); (to put a command on the button)*/
                    /*$player->sendMessage("Your Message");*/
                    /*$player->YourFunction();*/
                    break;
                case 1:
                    $player->setHealth(20);
                    $player->sendMessage("The heart bar has filled up successfully");
                    break;
                case 2:
                    $player->setFood(20);
                    $player->sendMessage("The hunger bar has successfully filled");
                    break;
            }
        });
        $form->setTitle("§l§eHealFoodUI");
        $form->setContent("Choose a function");
        $form->addButton("§cExit", 0, "textures/ui/realms_red_x");
        $form->addButton("Heal", 0, "textures/ui/absorption_effect");
        $form->addButton("Food", 0, "textures/items/beef_cooked");
        $form->sendToPlayer($player);
        /*return $form;*/
    }
}
