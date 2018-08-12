<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/agpl-3.0.html AGPL-3.0.0
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\geometryapi;

use kim\present\geometryapi\lang\PluginLang;
use kim\present\geometryapi\listener\PlayerEventListener;
use kim\present\geometryapi\task\CheckUpdateAsyncTask;
use pocketmine\command\{
	Command, CommandExecutor, CommandSender, PluginCommand
};
use pocketmine\permission\{
	Permission, PermissionManager
};
use pocketmine\plugin\PluginBase;

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

	/**
	 * Called when the plugin is loaded, before calling onEnable()
	 */
	public function onLoad() : void{
		self::$instance = $this;
	}

	/**
	 * Called when the plugin is enabled
	 */
	public function onEnable() : void{
		//Save default resources
		$this->saveResource("lang/eng/lang.ini", false);
		$this->saveResource("lang/kor/lang.ini", false);
		$this->saveResource("lang/language.list", false);

		//Load config file
		$this->saveDefaultConfig();
		$this->reloadConfig();
		$config = $this->getConfig();

		//Check latest version
		if($config->getNested("settings.update-check", false)){
			$this->getServer()->getAsyncPool()->submitTask(new CheckUpdateAsyncTask());
		}

		//Load language file
		$this->language = new PluginLang($this, $config->getNested("settings.language"));
		$this->getLogger()->info($this->language->translate("language.selected", [$this->language->getName(), $this->language->getLang()]));

		//Register main command
		$this->command = new PluginCommand($config->getNested("command.name"), $this);
		$this->command->setPermission("startkit.cmd");
		$this->command->setAliases($config->getNested("command.aliases"));
		$this->command->setUsage($this->language->translate("commands.startkit.usage"));
		$this->command->setDescription($this->language->translate("commands.startkit.description"));
		$this->getServer()->getCommandMap()->register($this->getName(), $this->command);

		//Load permission's default value from config
		$permissions = PermissionManager::getInstance()->getPermissions();
		$defaultValue = $config->getNested("permission.main");
		if($defaultValue !== null){
			$permissions["geometry.cmd"]->setDefault(Permission::getByName($config->getNested("permission.main")));
		}

		//Load geometry datas
		if(!file_exists($jsonFolder = "{$this->getDataFolder()}json/")){
			mkdir($jsonFolder, 0777, true);
		}
		$this->geometryDatas = [];
		foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($jsonFolder)) as $path => $fileInfo){
			if(!is_dir($path) && strcasecmp(substr($path, -5), ".json") === 0){
				$this->geometryDatas[substr($fileName = $fileInfo->getFileName(), 0, strlen($fileName) - 5)] = file_get_contents($path);
			}
		}

		//Register event listeners
		$this->getServer()->getPluginManager()->registerEvents(new PlayerEventListener($this), $this);
	}

	/**
	 * Called when the plugin is disabled
	 * Use this to free open things and finish actions
	 */
	public function onDisable() : void{
		foreach($this->geometryDatas as $geometryName => $geometryData){
			file_put_contents("{$this->getDataFolder()}json/{$geometryName}.json", $geometryData);
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
		if(isset($args[0]) && is_numeric($args[0])){
			$page = ((int) $args[0]) - 1;
			if($page < 0){
				$page = 0;
			}elseif($page > $max){
				$page = $max;
			}
		}
		$sender->sendMessage($this->language->translate("commands.geometry.head", [
			(string) ($page + 1),
			(string) $max,
		]));
		for($i = $page * 5, $count = count($list), $loopMax = ($page + 1) * 5; $i < $count && $i < $loopMax; $i++){
			$sender->sendMessage($this->language->translate("commands.geometry.item", [$list[$i]]));
		}
		return true;
	}

	/**
	 * @Override for multilingual support of the config file
	 *
	 * @return bool
	 */
	public function saveDefaultConfig() : bool{
		$resource = $this->getResource("lang/{$this->getServer()->getLanguage()->getLang()}/config.yml");
		if($resource === null){
			$resource = $this->getResource("lang/" . PluginLang::FALLBACK_LANGUAGE . "/config.yml");
		}

		if(!file_exists($configFile = $this->getDataFolder() . "config.yml")){
			$ret = stream_copy_to_stream($resource, $fp = fopen($configFile, "wb")) > 0;
			fclose($fp);
			fclose($resource);
			return $ret;
		}
		return false;
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
		if(!isset($this->geometryDatas[$geometryName])){
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
	 * @return PluginLang
	 */
	public function getLanguage() : PluginLang{
		return $this->language;
	}
}
