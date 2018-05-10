<?php

declare(strict_types=1);

namespace blugin\geometryapi\data;

class Cube implements \JsonSerializable{

    /** @var JsonVector3, origin */
    protected $origin;

    /** @var JsonVector3, size */
    protected $size;

    /** @var JsonVector2, uv */
    protected $uv;

    /** @var float, inflate */
    protected $inflate;

    /** @var bool, mirror */
    protected $mirror;

    /**
     * Cube constructor.
     *
     * @param null|JsonVector3 $origin  = new JsonVector3()
     * @param null|JsonVector3 $size    = new JsonVector3()
     * @param null|JsonVector2 $uv      = new JsonVector2()
     * @param float            $inflate = 0
     * @param bool             $mirror  = false
     */
    public function __construct(?JsonVector3 $origin = null, ?JsonVector3 $size = null, ?JsonVector2 $uv = null, float $inflate = 0, bool $mirror = false){
        $this->origin = $origin ?? new JsonVector3();
        $this->size = $size ?? new JsonVector3();
        $this->uv = $uv ?? new JsonVector2();
        $this->inflate = $inflate;
        $this->mirror = $mirror;
    }

    /** @return JsonVector3 */
    public function getOrigin() : JsonVector3{
        return $this->origin;
    }

    /** @param JsonVector3 $origin */
    public function setOrigin(JsonVector3 $origin) : void{
        $this->origin = $origin;
    }

    /** @return JsonVector3 */
    public function getSize() : JsonVector3{
        return $this->size;
    }

    /** @param JsonVector3 $size */
    public function setSize(JsonVector3 $size) : void{
        $this->size = $size;
    }

    /** @return JsonVector2 */
    public function getUV() : JsonVector2{
        return $this->uv;
    }

    /** @param JsonVector2 $uv */
    public function setUV(JsonVector2 $uv) : void{
        $this->uv = $uv;
    }

    /** @return float */
    public function getInflate() : float{
        return $this->inflate;
    }

    /** @param float $inflate */
    public function setInflate(float $inflate) : void{
        $this->inflate = $inflate;
    }

    /** @return bool */
    public function isMirror() : bool{
        return $this->mirror;
    }

    /** @param bool $mirror */
    public function setMirror(bool $mirror) : void{
        $this->mirror = $mirror;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     */
    public function jsonSerialize() : array{
        return [
          'origin'  => $this->origin,
          'size'    => $this->size,
          'uv'      => $this->uv,
          'inflate' => $this->inflate,
          'mirror'  => $this->mirror,
        ];
    }

    /**
     * @param array $jsonData
     *
     * @return null|Cube
     */
    public static function jsonDeserialize(array $jsonData) : ?Cube{
        $cube = null;
        if (isset($jsonData['origin'], $jsonData['size'], $jsonData['uv'])) {
            $origin = JsonVector3::jsonDeserialize($jsonData['origin']);
            $size = JsonVector3::jsonDeserialize($jsonData['size']);
            $uv = JsonVector2::jsonDeserialize($jsonData['uv']);
            $inflate = isset($jsonData['uv']) && is_numeric($jsonData['uv']) ? (float) $jsonData['uv'] : 0;
            $mirror = isset($jsonData['mirror']) && is_bool($jsonData['mirror']) ? (bool) $jsonData['mirror'] : false;

            $cube = new Cube($origin, $size, $uv, $inflate, $mirror);
        }
        return $cube;
    }
}