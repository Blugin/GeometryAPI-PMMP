<?php

declare(strict_types=1);

namespace blugin\geometryapi;

use pocketmine\command\{
  Command, PluginCommand, CommandExecutor, CommandSender
};
use pocketmine\plugin\PluginBase;
use blugin\geometryapi\listener\PlayerEventListener;
use blugin\geometryapi\lang\PluginLang;

class GeometryAPI extends PluginBase implements CommandExecutor{

    /** @var GeometryAPI */
    private static $instance = null;

    /** @return GeometryAPI */
    public static function getInstance() : GeometryAPI{
        return self::$instance;
    }

    /** @var PluginCommand */
    private $command;

    /** @var PluginLang */
    private $language;

    /** @var string[] */
    private $geometryDatas = [];

    public function onLoad() : void{
        self::$instance = $this;
    }

    public function onEnable() : void{
        if (!file_exists($dataFolder = $this->getDataFolder())) {
            mkdir($dataFolder, 0777, true);
        }
        $this->language = new PluginLang($this);

        if ($this->command !== null) {
            $this->getServer()->getCommandMap()->unregister($this->command);
        }
        $this->command = new PluginCommand($this->language->translate('commands.geometry'), $this);
        $this->command->setPermission('geometry.cmd');
        $this->command->setDescription($this->language->translate('commands.geometry.description'));
        $this->command->setUsage($this->language->translate('commands.geometry.usage'));
        if (is_array($aliases = $this->language->getArray('commands.geometry.aliases'))) {
            $this->command->setAliases($aliases);
        }
        $this->getServer()->getCommandMap()->register('geometryapi', $this->command);

        if (!file_exists($jsonFolder = "{$dataFolder}json/")) {
            mkdir($jsonFolder, 0777, true);
        }
        $this->geometryDatas = [];
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($jsonFolder)) as $path => $fileInfo) {
            if (!is_dir($path) && strcasecmp(substr($path, -5), '.json') === 0) {
                $this->geometryDatas[substr($fileName = $fileInfo->getFileName(), 0, strlen($fileName) - 5)] = file_get_contents($path);
            }
        }

        $this->getServer()->getPluginManager()->registerEvents(new PlayerEventListener(), $this);
    }

    public function onDisable() : void{
        if (!file_exists($dataFolder = $this->getDataFolder())) {
            mkdir($dataFolder, 0777, true);
        }
        if (!file_exists($jsonFolder = "{$dataFolder}json/")) {
            mkdir($jsonFolder, 0777, true);
        }
        foreach ($this->geometryDatas as $geometryName => $geometryData) {
            file_put_contents("{$jsonFolder}{$geometryName}.json", $geometryData);
        }
    }

    /**
     * @param CommandSender $sender
     * @param Command       $command
     * @param string        $label
     * @param string[]      $args
     *
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        $list = array_keys($this->getGeometryDatas());
        $max = ceil(count($list) / 5);
        $page = 0;
        if (isset($args[0]) && is_numeric($args[0])) {
            $page = ((int) $args[0]) - 1;
            if ($page < 0) {
                $page = 0;
            } elseif ($page > $max) {
                $page = $max;
            }
        }
        $sender->sendMessage($this->language->translate('commands.geometry.head', [
          (string) ($page + 1),
          (string) $max,
        ]));
        for ($i = $page * 5, $count = count($list), $loopMax = ($page + 1) * 5; $i < $count && $i < $loopMax; $i++) {
            $sender->sendMessage($this->language->translate('commands.geometry.item', [$list[$i]]));
        }
        return true;
    }

    /**  @return string[] */
    public function getGeometryDatas() : array{
        return $this->geometryDatas;
    }

    /**
     * @param string $geometryName
     * @param string $geometryData
     */
    public function addGeometryData(string $geometryName, string $geometryData) : void{
        if (!isset($this->geometryDatas[$geometryName])) {
            $this->geometryDatas[$geometryName] = $geometryData;
        }
    }

    /**
     * @param string $geometryName
     *
     * @return string | null
     */
    public function getGeometryData(string $geometryName) : ?string{
        return $this->geometryDatas[$geometryName] ?? null;
    }

    /**
     * @param string $name = ''
     *
     * @return PluginCommand
     */
    public function getCommand(string $name = '') : PluginCommand{
        return $this->command;
    }

    /**
     * @return PluginLang
     */
    public function getLanguage() : PluginLang{
        return $this->language;
    }

    /**
     * @return string
     */
    public function getSourceFolder() : string{
        $pharPath = \Phar::running();
        if (empty($pharPath)) {
            return dirname(__FILE__, 4) . DIRECTORY_SEPARATOR;
        } else {
            return $pharPath . DIRECTORY_SEPARATOR;
        }
    }
}
