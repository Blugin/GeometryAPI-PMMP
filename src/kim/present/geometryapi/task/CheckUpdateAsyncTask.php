<?php

declare(strict_types=1);

namespace kim\present\geometryapi\task;

use kim\present\geometryapi\GeometryAPI;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class CheckUpdateAsyncTask extends AsyncTask{
	public const CACHE_ENTITY_TAG = "e";
	public const CACHE_LATEST_VERSION = "v";
	public const CACHE_FILE_NAME = "f";
	public const CACHE_DOWNLOAD_URL = "d";

	private const RELEASE_URL = "https://api.github.com/repos/PresentKim/GeometryAPI-PMMP/releases/latest";

	/** @var string|null Latest version of plugin */
	private $latestVersion = null;

	/** @var string|null File-name and Download-url of latest release */
	private $fileName, $downloadURL;

	/** @var string Path of latest response cache file */
	private $cachePath;

	public function __construct(){
		$this->cachePath = GeometryAPI::getInstance()->getDataFolder() . ".latestCache";
	}

	/**
	 * Actions to execute when run
	 *
	 * Get latest version for comparing with plugin version, Store to $latestVersion
	 * Get file-name and download-url of latest release, Store to $fileName, $downloadURL
	 */
	public function onRun() : void{
		try{
			//Initialize a cURL session and set option
			curl_setopt_array($curlHandle = curl_init(), [
				CURLOPT_URL => self::RELEASE_URL,
				CURLOPT_HEADER => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_USERAGENT => "true"
			]);

			//Load latest cache for prevent "API rate limit exceeded"
			$latestCache = [];
			if(file_exists($this->cachePath)){
				$latestCache = json_decode(file_get_contents($this->cachePath), true);
				curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ["If-None-Match: " . $latestCache[self::CACHE_ENTITY_TAG]]);
			}

			//Perform a cURL session and get header size of session
			$response = curl_exec($curlHandle);
			$headerSize = curl_getinfo($curlHandle, CURLINFO_HEADER_SIZE);
			curl_close($curlHandle);

			//Get latest release data from cURL response when data is modified
			$header = substr($response, 0, $headerSize);
			if(!strpos($header, "304 Not Modified")){
				foreach(explode(PHP_EOL, $header) as $key => $line){
					if(strpos($line, "ETag: ") === 0){ //starts with "ETag: "
						$latestCache[self::CACHE_ENTITY_TAG] = substr($line, strlen("ETag: "));
					}
				}
				$jsonData = json_decode(substr($response, $headerSize), true);
				$latestCache[self::CACHE_LATEST_VERSION] = $jsonData["tag_name"];
				foreach($jsonData["assets"] as $key => $assetData){
					if(substr_compare($assetData["name"], ".phar", -strlen(".phar")) === 0){ //ends with ".phar"
						$latestCache[self::CACHE_FILE_NAME] = $assetData["name"];
						$latestCache[self::CACHE_DOWNLOAD_URL] = $assetData["browser_download_url"];
					}
				}
			}

			//Save latest cache
			file_put_contents($this->cachePath, json_encode($latestCache));

			//Mapping latest cache to properties values
			$this->latestVersion = $latestCache[self::CACHE_LATEST_VERSION];
			$this->fileName = $latestCache[self::CACHE_FILE_NAME];
			$this->downloadURL = $latestCache[self::CACHE_DOWNLOAD_URL];
		}catch(\Exception $exception){
		}
	}

	/**
	 * Actions to execute when completed (on main thread)
	 * Implement this if you want to handle the data in your AsyncTask after it has been processed
	 *
	 * @param Server $server
	 */
	public function onCompletion(Server $server) : void{
		$plugin = GeometryAPI::getInstance();
		if($this->latestVersion === null){
			$plugin->getLogger()->critical("Update check failed : Connection to release server failed");
		}elseif(version_compare($plugin->getDescription()->getVersion(), $this->latestVersion) >= 0){
			$plugin->getLogger()->notice("The plugin is latest version or higher (Latest version: {$this->latestVersion})");
		}else{
			$plugin->getLogger()->warning("The plugin is not up to date. We recommend that you update your plugin. (Latest : {$this->latestVersion})");

			//Shorten download url of latest release
			$plugin->getServer()->getAsyncPool()->submitTask(new ShortenDownloadURLAsyncTask($this->fileName, $this->downloadURL));
		}
	}
}