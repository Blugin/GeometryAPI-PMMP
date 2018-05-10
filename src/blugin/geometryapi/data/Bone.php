<?php

declare(strict_types=1);

namespace blugin\geometryapi\data;

class Bone implements \JsonSerializable{

    /** @var string, name */
    protected $name;

    /** @var Cube[], cubes */
    protected $cubes;

    /** @var JsonVector3, pivot */
    protected $pivot;

    /** @var JsonVector3, rotation */
    protected $rotation;

    /** @var JsonVector3, pos */
    protected $pos;

    /** @var string, META_BoneType */
    protected $bonetype;

    /** @var null|string, parent */
    protected $parent;

    /** @var null|string, material */
    protected $material;

    /** @var bool, neverRender (inverse) */
    protected $render;

    /**
     * Cube constructor.
     *
     * @param string           $name     = 'undefined'
     * @param Cube[]           $cubes    = []
     * @param null|JsonVector3 $pivot    = new JsonVector3()
     * @param null|JsonVector3 $pos      = new JsonVector3()
     * @param null|JsonVector3 $rotation = new JsonVector3()
     * @param string           $bonetype = 'base'
     * @param null|string      $parent   = null
     * @param null|string      $material = null
     * @param bool             $render   = true
     */
    public function __construct(string $name = 'undefined', array $cubes = [], ?JsonVector3 $pivot = null, ?JsonVector3 $rotation = null, ?JsonVector3 $pos = null, string $bonetype = 'base', ?string $parent = null, ?string $material = null, bool $render = true){
        $this->name = $name;
        $this->cubes = $cubes;
        $this->pivot = $pivot ?? new JsonVector3();
        $this->rotation = $rotation ?? new JsonVector3();
        $this->pos = $pos ?? new JsonVector3();
        $this->bonetype = $bonetype;
        $this->parent = $parent;
        $this->material = $material;
        $this->render = $render;
    }

    /** @return string */
    public function getName() : string{
        return $this->name;
    }

    /** @param string $name */
    public function setName(string $name) : void{
        $this->name = $name;
    }

    /** @return Cube[] */
    public function getCubes() : array{
        return $this->cubes;
    }

    /** @param Cube[] $cubes */
    public function setCubes(array $cubes) : void{
        $this->cubes = $cubes;
    }

    /** @param Cube $cube */
    public function addCube(Cube $cube) : void{
        $this->cubes[] = $cube;
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

    /**@return JsonVector3 */
    public function getPos() : JsonVector3{
        return $this->pos;
    }

    /**@param JsonVector3 $pos */
    public function setPos(JsonVector3 $pos) : void{
        $this->pos = $pos;
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
     * @return null|string
     */
    public function getMaterial() : ?string{
        return $this->material;
    }

    /**@param null|string $material */
    public function setMaterial(?string $material) : void{
        $this->material = $material;
    }

    /**@return bool */
    public function isRender() : bool{
        return $this->render;
    }

    /**@param bool $render */
    public function setRender(bool $render) : void{
        $this->render = $render;
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
          'cubes'         => $this->cubes,
          'pivot'         => $this->pivot,
          'rotation'      => $this->rotation,
          'pos'           => $this->pos,
          'META_BoneType' => $this->bonetype,
          'parent'        => $this->parent,
          'material'      => $this->material,
          'neverRender'   => !$this->render,
        ];
    }

    /**
     * @param array $jsonData
     *
     * @return null|Bone
     */
    public static function jsonDeserialize(array $jsonData) : ?Bone{
        $bone = null;
        if (isset($jsonData['name'], $jsonData['cubes'], $jsonData['pivot'])) {
            $name = (string) $jsonData['name'];
            $cubes = array_map(function (array $value){
                return Cube::jsonDeserialize($value);
            }, $jsonData['cubes']);
            $pivot = JsonVector3::jsonDeserialize($jsonData['pivot']);
            $rotation = JsonVector3::jsonDeserialize($jsonData['rotation']);
            $pos = JsonVector3::jsonDeserialize($jsonData['pos']);
            $bonetype = $jsonData['bonetype'] ?? 'base';
            $parent = $jsonData['parent'] ?? null;
            $material = $jsonData['material'] ?? null;
            $render = isset($jsonData['neverRender']) && is_bool($jsonData['neverRender']) ? !((bool) $jsonData['neverRender']) : true;

            $bone = new Bone($name, $cubes, $pivot, $rotation, $pos, $bonetype, $parent, $material, $render);
        }
        return $bone;
    }
}