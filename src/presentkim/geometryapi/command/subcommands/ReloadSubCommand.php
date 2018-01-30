<?php

namespace presentkim\geometryapi\command\subcommands;

use pocketmine\command\CommandSender;
use presentkim\geometryapi\GeometryAPI as Plugin;
use presentkim\geometryapi\command\{
  SubCommand, PoolCommand,
};

class ReloadSubCommand extends SubCommand{

    public function __construct(PoolCommand $owner){
        parent::__construct($owner, 'reload');
    }

    /**
     * @param CommandSender $sender
     * @param String[]      $args
     *
     * @return bool
     */
    public function onCommand(CommandSender $sender, array $args) : bool{
        $this->plugin->load();
        $sender->sendMessage(Plugin::$prefix . $this->translate('success'));

        return true;
    }
}