<?php

namespace presentkim\geometryapi\listener;

use pocketmine\event\Listener;

use presentkim\geometryapi\GeometryAPI as Plugin;

class PlayerEventListener implements Listener{

    /** @var Plugin */
    private $owner = null;

    public function __construct(){
        $this->owner = Plugin::getInstance();
    }
}