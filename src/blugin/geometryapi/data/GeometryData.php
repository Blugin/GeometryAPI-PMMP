<?php

declare(strict_types=1);

namespace blugin\geometryapi\data;

class GeometryData implements \JsonSerializable{

    /** @var string, name */
    protected $name;

    /** @var Bone[], bones */
    protected $bones;

    /** @var int, texturewidth */
    protected $width;

    /** @var int, textureheight */
    protected $height;

    /** @var string, META_ModelVersion */
    protected $version;

    /** @var string, rigtype */
    protected $rigtype;

    /** @var string, cape */
    protected $cape;

    /** @var bool, animationArmsDown */
    protected $aniArmsDown = false;

    /** @var bool, animationArmsOutFront */
    protected $aniArmsOutFront = false;

    /** @var bool, animationStatueOfLibertyArms */
    protected $aniStatueOfLibertyArms = false;

    /** @var bool, animationSingleArmAnimation */
    protected $aniSingleArmAnimation = false;

    /** @var bool, animationStationaryLegs */
    protected $aniStationaryLegs = false;

    /** @var bool, animationSingleLegAnimation */
    protected $aniSingleLegAnimation = false;

    /** @var bool, animationNoHeadBob */
    protected $aniNoHeadBob = false;

    /** @var bool, animationDontShowArmor */
    protected $aniDontShowArmor = false;

    /** @var bool, animationUpsideDown */
    protected $aniUpsideDown = false;

    /** @var bool, animationInvertedCrouch */
    protected $aniInvertedCrouch = false;

    /**
     * GeometryData constructor.
     *
     * @param string $name                   = 'undefined'
     * @param Bone[] $bones                  = []
     * @param int    $width                  = 64
     * @param int    $height                 = 64
     * @param string $version                = '1.0.0'
     * @param string $rigtype                = 'normal'
     * @param string $cape                   = ''
     * @param bool   $aniArmsDown            = false
     * @param bool   $aniArmsOutFront        = false
     * @param bool   $aniStatueOfLibertyArms = false
     * @param bool   $aniSingleArmAnimation  = false
     * @param bool   $aniStationaryLegs      = false
     * @param bool   $aniSingleLegAnimation  = false
     * @param bool   $aniNoHeadBob           = false
     * @param bool   $aniDontShowArmor       = false
     * @param bool   $aniUpsideDown          = false
     * @param bool   $aniInvertedCrouch      = false
     */
    public function __construct(string $name = 'undefined', array $bones = [], int $width = 64, int $height = 64, string $version = '1.0.0', string $rigtype = 'normal', string $cape = '', bool $aniArmsDown = false, bool $aniArmsOutFront = false, bool $aniStatueOfLibertyArms = false, bool $aniSingleArmAnimation = false, bool $aniStationaryLegs = false, bool $aniSingleLegAnimation = false, bool $aniNoHeadBob = false, bool $aniDontShowArmor = false, bool $aniUpsideDown = false, bool $aniInvertedCrouch = false){
        $this->name = $name;
        $this->bones = $bones;
        $this->width = $width;
        $this->height = $height;
        $this->version = $version;
        $this->rigtype = $rigtype;
        $this->cape = $cape;
        $this->aniArmsDown = $aniArmsDown;
        $this->aniArmsOutFront = $aniArmsOutFront;
        $this->aniStatueOfLibertyArms = $aniStatueOfLibertyArms;
        $this->aniSingleArmAnimation = $aniSingleArmAnimation;
        $this->aniStationaryLegs = $aniStationaryLegs;
        $this->aniSingleLegAnimation = $aniSingleLegAnimation;
        $this->aniNoHeadBob = $aniNoHeadBob;
        $this->aniDontShowArmor = $aniDontShowArmor;
        $this->aniUpsideDown = $aniUpsideDown;
        $this->aniInvertedCrouch = $aniInvertedCrouch;
    }

    /** @return string */
    public function getName() : string{
        return $this->name;
    }

    /** @param string $name */
    public function setName(string $name) : void{
        $this->name = $name;
    }

    /** @return Bone[] */
    public function getBones() : array{
        return $this->bones;
    }

    /** @param Bone $bone */
    public function addBone(Bone $bone) : void{
        $this->bones[] = $bone;
    }

    /** @param Bone[] $bones */
    public function setBones(array $bones) : void{
        $this->bones = $bones;
    }

    /** @return int */
    public function getWidth() : int{
        return $this->width;
    }

    /** @param int $width */
    public function setWidth(int $width) : void{
        $this->width = $width;
    }

    /** @return int */
    public function getHeight() : int{
        return $this->height;
    }

    /** @param int $height */
    public function setHeight(int $height) : void{
        $this->height = $height;
    }

    /** @return string */
    public function getVersion() : string{
        return $this->version;
    }

    /** @param string $version */
    public function setVersion(string $version) : void{
        $this->version = $version;
    }

    /** @return string */
    public function getRigtype() : string{
        return $this->rigtype;
    }

    /** @param string $rigtype */
    public function setRigtype(string $rigtype) : void{
        $this->rigtype = $rigtype;
    }

    /** @return string */
    public function getCape() : string{
        return $this->cape;
    }

    /** @param string $cape */
    public function setCape(string $cape) : void{
        $this->cape = $cape;
    }

    /** @return bool */
    public function isAniArmsDown() : bool{
        return $this->aniArmsDown;
    }

    /** @param bool $aniArmsDown */
    public function setAniArmsDown(bool $aniArmsDown) : void{
        $this->aniArmsDown = $aniArmsDown;
    }

    /** @return bool
     */
    public function isAniArmsOutFront() : bool{
        return $this->aniArmsOutFront;
    }

    /** @param bool $aniArmsOutFront */
    public function setAniArmsOutFront(bool $aniArmsOutFront) : void{
        $this->aniArmsOutFront = $aniArmsOutFront;
    }

    /** @return bool */
    public function isAniStatueOfLibertyArms() : bool{
        return $this->aniStatueOfLibertyArms;
    }

    /** @param bool $aniStatueOfLibertyArms */
    public function setAniStatueOfLibertyArms(bool $aniStatueOfLibertyArms) : void{
        $this->aniStatueOfLibertyArms = $aniStatueOfLibertyArms;
    }

    /** @return bool */
    public function isAniSingleArmAnimation() : bool{
        return $this->aniSingleArmAnimation;
    }

    /** @param bool $aniSingleArmAnimation */
    public function setAniSingleArmAnimation(bool $aniSingleArmAnimation) : void{
        $this->aniSingleArmAnimation = $aniSingleArmAnimation;
    }

    /** @return bool */
    public function isAniStationaryLegs() : bool{
        return $this->aniStationaryLegs;
    }

    /** @param bool $aniStationaryLegs */
    public function setAniStationaryLegs(bool $aniStationaryLegs) : void{
        $this->aniStationaryLegs = $aniStationaryLegs;
    }

    /** @return bool */
    public function isAniSingleLegAnimation() : bool{
        return $this->aniSingleLegAnimation;
    }

    /** @param bool $aniSingleLegAnimation */
    public function setAniSingleLegAnimation(bool $aniSingleLegAnimation) : void{
        $this->aniSingleLegAnimation = $aniSingleLegAnimation;
    }

    /** @return bool */
    public function isAniNoHeadBob() : bool{
        return $this->aniNoHeadBob;
    }

    /** @param bool $aniNoHeadBob */
    public function setAniNoHeadBob(bool $aniNoHeadBob) : void{
        $this->aniNoHeadBob = $aniNoHeadBob;
    }

    /** @return bool */
    public function isAniDontShowArmor() : bool{
        return $this->aniDontShowArmor;
    }

    /**  @param bool $aniDontShowArmor */
    public function setAniDontShowArmor(bool $aniDontShowArmor) : void{
        $this->aniDontShowArmor = $aniDontShowArmor;
    }

    /** @return bool */
    public function isAniUpsideDown() : bool{
        return $this->aniUpsideDown;
    }

    /** @param bool $aniUpsideDown */
    public function setAniUpsideDown(bool $aniUpsideDown) : void{
        $this->aniUpsideDown = $aniUpsideDown;
    }

    /** @return bool */
    public function isAniInvertedCrouch() : bool{
        return $this->aniInvertedCrouch;
    }

    /** @param bool $aniInvertedCrouch */
    public function setAniInvertedCrouch(bool $aniInvertedCrouch) : void{
        $this->aniInvertedCrouch = $aniInvertedCrouch;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     */
    public function jsonSerialize() : array{
        return [
          'name'                         => $this->name,
          'bones'                        => $this->bones,
          'texturewidth'                 => $this->width,
          'textureheight'                => $this->height,
          'version'                      => $this->version,
          'rigtype'                      => $this->rigtype,
          'cape'                         => $this->cape,
          'animationArmsDown'            => $this->aniArmsDown,
          'animationArmsOutFront'        => $this->aniArmsOutFront,
          'animationStatueOfLibertyArms' => $this->aniStatueOfLibertyArms,
          'animationSingleArmAnimation'  => $this->aniSingleArmAnimation,
          'animationStationaryLegs'      => $this->aniStationaryLegs,
          'animationSingleLegAnimation'  => $this->aniSingleLegAnimation,
          'animationNoHeadBob'           => $this->aniNoHeadBob,
          'animationDontShowArmor'       => $this->aniDontShowArmor,
          'animationUpsideDown'          => $this->aniUpsideDown,
          'animationInvertedCrouch'      => $this->aniInvertedCrouch,
        ];
    }

    /**
     * @param array $jsonData
     *
     * @return null|GeometryData
     */
    public static function jsonDeserialize(array $jsonData) : ?GeometryData{
        $geometryData = null;
        if (isset($jsonData['name'], $jsonData['bones']) && is_array($jsonData['bones'])) {
            $name = $jsonData['name'];
            $bones = array_map(function (array $value){
                return Bone::jsonDeserialize($value);
            }, $jsonData['bones']);
            $width = isset($jsonData['texturewidth']) && is_numeric($jsonData['texturewidth']) ? (int) $jsonData['texturewidth'] : 64;
            $height = isset($jsonData['textureheight']) && is_numeric($jsonData['textureheight']) ? (int) $jsonData['textureheight'] : 64;
            $version = $jsonData['META_ModelVersion'] ?? '1.0.0';
            $rigtype = $jsonData['rigtype'] ?? 'normal';
            $cape = $jsonData['cape'] ?? '';
            $aniArmsDown = isset($jsonData['animationArmsDown']) && is_bool($jsonData['animationArmsDown']) ? (bool) $jsonData['animationArmsDown'] : false;
            $aniArmsOutFront = isset($jsonData['animationArmsOutFront']) && is_bool($jsonData['animationArmsOutFront']) ? (bool) $jsonData['animationArmsOutFront'] : false;
            $aniStatueOfLibertyArms = isset($jsonData['animationStatueOfLibertyArms']) && is_bool($jsonData['animationStatueOfLibertyArms']) ? (bool) $jsonData['animationStatueOfLibertyArms'] : false;
            $aniSingleArmAnimation = isset($jsonData['animationSingleArmAnimation']) && is_bool($jsonData['animationSingleArmAnimation']) ? (bool) $jsonData['animationSingleArmAnimation'] : false;
            $aniStationaryLegs = isset($jsonData['animationStationaryLegs']) && is_bool($jsonData['animationStationaryLegs']) ? (bool) $jsonData['animationStationaryLegs'] : false;
            $aniSingleLegAnimation = isset($jsonData['animationSingleLegAnimation']) && is_bool($jsonData['animationSingleLegAnimation']) ? (bool) $jsonData['animationSingleLegAnimation'] : false;
            $aniNoHeadBob = isset($jsonData['animationNoHeadBob']) && is_bool($jsonData['animationNoHeadBob']) ? (bool) $jsonData['animationNoHeadBob'] : false;
            $aniDontShowArmor = isset($jsonData['animationDontShowArmor']) && is_bool($jsonData['animationDontShowArmor']) ? (bool) $jsonData['animationDontShowArmor'] : false;
            $aniUpsideDown = isset($jsonData['animationUpsideDown']) && is_bool($jsonData['animationUpsideDown']) ? (bool) $jsonData['animationUpsideDown'] : false;
            $aniInvertedCrouch = isset($jsonData['animationInvertedCrouch']) && is_bool($jsonData['animationInvertedCrouch']) ? (bool) $jsonData['animationInvertedCrouch'] : false;

            $geometryData = new GeometryData($name, $bones, $width, $height, $version, $rigtype, $cape, $aniArmsDown, $aniArmsOutFront, $aniStatueOfLibertyArms, $aniSingleArmAnimation, $aniStationaryLegs, $aniSingleLegAnimation, $aniNoHeadBob, $aniDontShowArmor, $aniUpsideDown, $aniInvertedCrouch);
        }
        return $geometryData;
    }
}