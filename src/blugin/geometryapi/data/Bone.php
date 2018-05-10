<?php

declare(strict_types=1);

namespace blugin\geometryapi\data;

class Bone implements \JsonSerializable{

    /** @var string, name */
    protected $name;

    /** @var JsonVector3, pivot */
    protected $pivot;

    /** @var JsonVector3, rotation */
    protected $rotation;

    /** @var string, META_BoneType */
    protected $bonetype;

    /** @var null|string, parent */
    protected $parent;

    /**
     * Cube constructor.
     *
     * @param string           $name     = 'undefined'
     * @param null|JsonVector3 $pivot    = new JsonVector3()
     * @param null|JsonVector3 $rotation = new JsonVector3()
     * @param string           $bonetype = 'base'
     * @param null|string      $parent   = null
     */
    public function __construct(string $name = 'undefined', ?JsonVector3 $pivot = null, ?JsonVector3 $rotation = null, string $bonetype = 'base', ?string $parent = null){
        $this->name = $name;
        $this->pivot = $pivot ?? new JsonVector3();
        $this->rotation = $rotation ?? new JsonVector3();
        $this->bonetype = $bonetype;
        $this->parent = $parent;
    }

    /** @return string */
    public function getName() : string{
        return $this->name;
    }

    /** @param string $name */
    public function setName(string $name) : void{
        $this->name = $name;
    }

    /** @return JsonVector3 */
    public function getPivot() : JsonVector3{
        return $this->pivot;
    }

    /** @param JsonVector3 $pivot */
    public function setPivot(JsonVector3 $pivot) : void{
        $this->pivot = $pivot;
    }

    /** @return JsonVector3 */
    public function getRotation() : JsonVector3{
        return $this->rotation;
    }

    /** @param JsonVector3 $rotation */
    public function setRotation(JsonVector3 $rotation) : void{
        $this->rotation = $rotation;
    }

    /** @return string */
    public function getBonetype() : string{
        return $this->bonetype;
    }

    /** @param string $bonetype */
    public function setBonetype(string $bonetype) : void{
        $this->bonetype = $bonetype;
    }

    /** @return null|string */
    public function getParent() : ?string{
        return $this->parent;
    }

    /** @param null|string $parent */
    public function setParent(?string $parent) : void{
        $this->parent = $parent;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     */
    public function jsonSerialize() : array{
        return [
          'name'          => $this->name,
          'pivot'         => $this->pivot,
          'rotation'      => $this->rotation,
          'META_BoneType' => $this->bonetype,
          'parent'        => $this->parent,
        ];
    }

    /**
     * @param array $jsonData
     *
     * @return null|Bone
     */
    public static function jsonDeserialize(array $jsonData) : ?Bone{
        $bone = null;
        if (isset($jsonData['name'], $jsonData['pivot'])) {
            $name = (string) $jsonData['name'];
            $pivot = JsonVector3::jsonDeserialize($jsonData['pivot']);
            $rotation = JsonVector3::jsonDeserialize($jsonData['rotation']);
            $bonetype = $jsonData['bonetype'] ?? 'base';
            $parent = $jsonData['parent'] ?? null;

            $bone = new Bone($name, $pivot, $rotation, $bonetype, $parent);
        }
        return $bone;
    }
}