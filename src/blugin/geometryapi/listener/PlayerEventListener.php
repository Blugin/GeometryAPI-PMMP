<?php

declare(strict_types=1);

namespace blugin\geometryapi\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\{
    PlayerChangeSkinEvent, PlayerJoinEvent
};
use blugin\geometryapi\GeometryAPI as Plugin;

class PlayerEventListener implements Listener{

    /** @var Plugin */
    private $owner = null;

    public function __construct(){
        $this->owner = Plugin::getInstance();
    }

    /** @param PlayerChangeSkinEvent $event */
    public function onPlayerChangeSkinEvent(PlayerChangeSkinEvent $event) : void{
        $skin = $event->getNewSkin();
        $this->owner->addGeometryData($skin->getGeometryName(), $skin->getGeometryData());
    }

    /** @param PlayerJoinEvent $event */
    public function onPlayerJoinEvent(PlayerJoinEvent $event) : void{
        $skin = $event->getPlayer()->getSkin();
        $this->owner->addGeometryData($skin->getGeometryName(), $skin->getGeometryData());
    }
}