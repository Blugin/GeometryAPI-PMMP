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
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://opensource.org/licenses/MIT MIT License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\geometryapi\lang;

use pocketmine\plugin\PluginBase;

class PluginLang{
	public const FALLBACK_LANGUAGE = "eng";

	/** @var string */
	protected $langName;

	/** @var PluginBase */
	protected $plugin;

	/** @var string[] */
	protected $lang = [];

	/** @var string[] */
	protected $fallbackLang = [];

	/**
	 * @noinspection PhpMissingParentConstructorInspection
	 * PluginLang constructor.
	 *
	 * @param PluginBase $plugin
	 * @param string     $lang
	 */
	public function __construct(PluginBase $plugin, string $lang){
		$this->langName = strtolower($lang);
		$this->plugin = $plugin;

		//Load required language
		$this->load($lang);

		//Load fallback language
		$resoruce = $plugin->getResource("lang/" . self::FALLBACK_LANGUAGE . "/lang.ini");
		if($resoruce !== null){
			$this->fallbackLang = array_map("stripcslashes", parse_ini_string(stream_get_contents($resoruce), false, INI_SCANNER_RAW));
		}else{
			$plugin->getLogger()->error("Missing fallback language file");
		}
	}

	/**
	 * @param string $lang
	 *
	 * @return bool
	 */
	public function load(string $lang) : bool{
		if($this->isAvailableLanguage($lang)){
			$file = "{$this->plugin->getDataFolder()}lang/{$this->langName}/lang.ini";
			if(file_exists($file)){
				$this->lang = array_map("stripcslashes", parse_ini_file($file, false, INI_SCANNER_RAW));
			}else{
				$this->plugin->getLogger()->error("Missing required language file ({$this->langName})");
			}
		}
		return false;
	}

	/**
	 * @param string   $id
	 * @param string[] $params
	 *
	 * @return string
	 */
	public function translate(string $id, array $params = []) : string{
		$str = $this->lang[$id] ?? $this->fallbackLang[$id] ?? $id;
		foreach($params as $i => $param){
			$str = str_replace("{%$i}", (string) $param, $str);
		}
		return $str;
	}

	/**
	 * @return string
	 */
	public function getName() : string{
		return $this->translate("language.name");
	}

	/**
	 * @return string
	 */
	public function getLang() : string{
		return $this->langName;
	}

	/**
	 * Read available language list from language.list file
	 *
	 * @return string[]
	 */
	public function getLanguageList() : array{
		return explode("\n", file_get_contents("{$this->plugin->getDataFolder()}lang/language.list"));
	}

	/**
	 * @param string $lang
	 *
	 * @return bool
	 */
	public function isAvailableLanguage(string $lang) : bool{
		return in_array(strtolower($lang), $this->getLanguageList());
	}
}
