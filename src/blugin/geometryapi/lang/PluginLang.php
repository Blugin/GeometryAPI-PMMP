<?php

declare(strict_types=1);

namespace blugin\geometryapi\lang;

use blugin\geometryapi\GeometryAPI;

class PluginLang{

    public const FALLBACK_LANGUAGE = "eng";

    /**
     * @var DustBin
     */
    protected $plugin;

    /**
     * @var string[]
     */
    protected $lang = [];

    /**
     * @var string[]
     */
    protected $fallbackLang = [];

    public function __construct(GeometryAPI $plugin){
        $this->plugin = $plugin;

        $fallbackLangResource = "{$plugin->getSourceFolder()}resources/lang/eng.ini";
        $dataFolder = $plugin->getDataFolder();
        $langFile = "{$dataFolder}lang.ini";
        $langResource = "{$plugin->getSourceFolder()}resources/lang/{$plugin->getServer()->getLanguage()->getLang()}.ini";
        if (!file_exists($langFile)) {
            if (!file_exists($dataFolder)) {
                mkdir($dataFolder, 0777, true);
            }
            copy(file_exists($langResource) ? $langResource : $fallbackLangResource, $langFile);
        }
        $this->lang = $this->loadLang($langFile);
        $this->fallbackLang = $this->loadLang($fallbackLangResource);
    }

    /**
     * @return DustBin
     */
    public function getPlugin() : DustBin{
        return $this->plugin;
    }

    /**
     * @return string[]
     */
    public function getLang() : array{
        return $this->lang;
    }

    /**
     * @param string $id
     *
     * @return null|string
     */
    public function get(string $id) : ?string{
        if (isset($this->lang[$id])) {
            $result = $this->lang[$id];
        } elseif (isset($this->fallbackLang[$id])) {
            $result = $this->fallbackLang[$id];
        } else {
            return null;
        }
        if (is_array($result)) {
            return $result[array_rand($result)];
        } else {
            return $result;
        }
    }

    /**
     * @param string $id
     *
     * @return null|string[]
     */
    public function getArray(string $id) : ?array{
        if (isset($this->lang[$id])) {
            $result = $this->lang[$id];
        } elseif (isset($this->fallbackLang[$id])) {
            $result = $this->fallbackLang[$id];
        } else {
            return null;
        }
        if (is_array($result)) {
            return $result;
        } else {
            return [$result];
        }
    }

    /**
     * @param string[] $lang
     */
    public function setLang(array $lang) : void{
        $this->lang = $lang;
    }

    /**
     * @param string   $id
     * @param string[] $params = []
     *
     * @return null|string
     */
    public function translate(string $id, array $params = []) : ?string{
        $text = $this->get($id);
        if ($text === null) {
            return $id;
        } else {
            foreach ($params as $i => $param) {
                $text = str_replace("{%$i}", $param, $text);
            }
            return $text;
        }
    }

    /**
     * @return string[]
     */
    public function getLanguageList() : array{
        $result = [];
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->plugin->getSourceFolder() . 'resources/lang/')) as $filePath => $fileInfo) {
            if (substr($filePath, -4) == '.ini') {
                $lang = $this->loadLang($filePath);
                if (isset($lang['language.name'])) {
                    $result[substr($fileInfo->getFilename(), 0, -4)] = $lang['language.name'];
                }
            }
        }
        return $result;
    }

    /**
     * @param string $file
     *
     * @return null|array
     */
    public function loadLang(string $file) : ?array{
        if (file_exists($file)) {
            $result = [];
            foreach (parse_ini_file($file, false, INI_SCANNER_RAW) as $key => $value) {
                if (is_string($value)) {
                    $result[$key] = stripcslashes($value);
                } elseif (is_array($value)) {
                    $result[$key] = [];
                    foreach ($value as $index => $str) {
                        $result[$key][] = stripcslashes($str);
                    }
                }
            }
            return $result;
        } else {
            return null;
        }
    }
}