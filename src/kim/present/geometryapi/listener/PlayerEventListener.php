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

namespace kim\present\geometryapi\listener;

use kim\present\geometryapi\GeometryAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\{
	PlayerChangeSkinEvent, PlayerJoinEvent
};

class PlayerEventListener implements Listener{
	/** @var GeometryAPI */
	private $plugin;

	public function __construct(GeometryAPI $plugin){
		$this->plugin = $plugin;
	}

	/** @param PlayerChangeSkinEvent $event */
	public function onPlayerChangeSkinEvent(PlayerChangeSkinEvent $event) : void{
		$skin = $event->getNewSkin();
		$geometryData = $skin->getGeometryData();
		if(!empty($geometryData)){
			$this->plugin->readGeometryData($geometryData);
		}
	}

	/** @param PlayerJoinEvent $event */
	public function onPlayerJoinEvent(PlayerJoinEvent $event) : void{
		$skin = $event->getPlayer()->getSkin();
		$geometryData = $skin->getGeometryData();
		if(!empty($geometryData)){
			$this->plugin->readGeometryData($geometryData);
		}
	}
}