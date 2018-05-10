<?php

declare(strict_types=1);

namespace blugin\geometryapi\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\{
  PlayerChangeSkinEvent, PlayerJoinEvent
};
use blugin\geometryapi\GeometryAPI;

class PlayerEventListener implements Listener{

    /** @var GeometryAPI */
    private $owner = null;

    public function __construct(GeometryAPI $owner){
        $this->owner = $owner;
    }

    /** @param PlayerChangeSkinEvent $event */
    public function onPlayerChangeSkinEvent(PlayerChangeSkinEvent $event) : void{
        $skin = $event->getNewSkin();
        $geometryData = $skin->getGeometryData();
        if (!empty($geometryData)) {
            $this->owner->addGeometryData($skin->getGeometryName(), $geometryData);
        }
    }

    /** @param PlayerJoinEvent $event */
    public function onPlayerJoinEvent(PlayerJoinEvent $event) : void{
        $skin = $event->getPlayer()->getSkin();
        $geometryData = $skin->getGeometryData();
        if (!empty($geometryData)) {
            $this->owner->addGeometryData($skin->getGeometryName(), $geometryData);
        }
    }
}