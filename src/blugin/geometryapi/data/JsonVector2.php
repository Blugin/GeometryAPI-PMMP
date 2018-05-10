<?php
declare(strict_types=1);

namespace blugin\geometryapi\data;

use pocketmine\math\Vector2;

class JsonVector2 extends Vector2 implements \JsonSerializable{

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
        ];
    }

    /**
     * @param array $jsonData
     *
     * @return null|JsonVector3
     */
    public static function jsonDeserialize(array $jsonData) : ?JsonVector2{
        $vector2 = null;
        if (isset($jsonData[1]) && is_numeric($jsonData[0]) && is_numeric($jsonData[1])) {
            $vector2 = new JsonVector2((float) $jsonData[0], (float) $jsonData[1]);
        }
        return $vector2;
    }
}