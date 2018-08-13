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

namespace kim\present\geometryapi\listener;

use kim\present\geometryapi\GeometryAPI;
use pocketmine\entity\Skin;
use pocketmine\event\Listener;
use pocketmine\event\player\{
	PlayerChangeSkinEvent, PlayerJoinEvent
};

class PlayerEventListener implements Listener{
	/** @var GeometryAPI */
	private $owner = null;

	public function __construct(GeometryAPI $owner){
		$this->owner = $owner;
	}

	/** @param PlayerChangeSkinEvent $event */
	public function onPlayerChangeSkinEvent(PlayerChangeSkinEvent $event) : void{
		$player = $event->getPlayer();
		$event->setNewSkin($this->getPureGeometryData($player->getSkin()));
	}

	/** @param PlayerJoinEvent $event */
	public function onPlayerJoinEvent(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		$player->setSkin($this->getPureGeometryData($player->getSkin()));
	}

	/**
	 * @param Skin $skin
	 *
	 * @return Skin
	 */
	private function getPureGeometryData(Skin $skin) : Skin{
		$geometryData = $skin->getGeometryData();
		if(!empty($geometryData)){
			$this->owner->readGeometryData($geometryData);

			$geometryName = $skin->getGeometryName();
			$geometryData = $this->owner->getGeometryData($geometryName);
			return $geometryData === null ? $skin : new Skin($skin->getSkinId(), $skin->getSkinData(), $skin->getCapeData(), $geometryName, $geometryData);
		}else{
			return $skin;
		}
	}
}