<?php

namespace presentkim\geometryapi\command\subcommands;

use pocketmine\command\CommandSender;
use presentkim\geometryapi\GeometryAPI as Plugin;
use presentkim\geometryapi\command\{
  SubCommand, PoolCommand
};

use function presentkim\geometryapi\util\toInt;

class ListSubCommand extends SubCommand{

    public function __construct(PoolCommand $owner){
        parent::__construct($owner, 'list');
    }

    /**
     * @param CommandSender $sender
     * @param String[]      $args
     *
     * @return bool
     */
    public function onCommand(CommandSender $sender, array $args) : bool{
        $list = array_keys($this->plugin->getGeometryDatas());

        $max = ceil(count($list) / 5);
        $page = min($max, (isset($args[0]) ? toInt($args[0], 1, function (int $i){
              return $i > 0 ? 1 : -1;
          }) : 1) - 1);
        $sender->sendMessage(Plugin::$prefix . $this->translate('head', $page + 1, $max));
        for ($i = $page * 5; $i < ($page + 1) * 5 && $i < count($list); $i++) {
            $sender->sendMessage($this->translate('item', $list[$i]));
        }
        return true;
    }
}