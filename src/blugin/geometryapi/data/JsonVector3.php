<?php
declare(strict_types=1);

namespace blugin\geometryapi\data;

use pocketmine\math\Vector3;

class JsonVector3 extends Vector3 implements \JsonSerializable{

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     */
    public function jsonSerialize() : array{
        return [
          $this->x,
          $this->y,
          $this->z,
        ];
    }

    /**
     * @param array $jsonData
     *
     * @return null|JsonVector3
     */
    public static function jsonDeserialize(array $jsonData) : ?JsonVector3{
        $vector3 = null;
        if (isset($jsonData[2]) && is_numeric($jsonData[0]) && is_numeric($jsonData[1]) && is_numeric($jsonData[2])) {
            $vector3 = new JsonVector3((float) $jsonData[0], (float) $jsonData[1], (float) $jsonData[2]);
        }
        return $vector3;
    }
}