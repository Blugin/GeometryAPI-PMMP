<?php

declare(strict_types=1);

namespace kim\present\geometryapi\task;

use kim\present\geometryapi\GeometryAPI;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class ShortenDownloadURLAsyncTask extends AsyncTask{
	private const URL = "https://git.io";

	/** @var string|null File-name and Download-url of latest release */
	private $fileName, $downloadURL;

	/** @var string|null Short url of latest release download */
	private $shortURL = null;

	/**
	 * ShortenDownloadURLAsyncTask constructor.
	 *
	 * @param string $fileName
	 * @param string $downloadURL
	 */
	public function __construct(string $fileName, string $downloadURL){
		$this->fileName = $fileName;
		$this->downloadURL = $downloadURL;
	}

	/**
	 * Actions to execute when run
	 *
	 * Shorten download url of latest release
	 * Get shortened url and store that to $shortURL
	 */
	public function onRun() : void{
		try{
			curl_setopt_array($curlHandle = curl_init(), [
				CURLOPT_URL => self::URL,
				CURLOPT_POSTFIELDS => [
					"code" => $this->fileName,
					"url" => $this->downloadURL
				],
				CURLOPT_HEADER => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_SSL_VERIFYPEER => false
			]);
			foreach(explode("\n", curl_exec($curlHandle)) as $key => $line){
				if(strpos($line, "Location: ") === 0){ //starts with "Location: "
					$this->shortURL = substr($line, strlen("Location: "));
				}
			}
			curl_close($curlHandle);
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
		if($this->shortURL !== null){
			$plugin = GeometryAPI::getInstance();
			$plugin->getLogger()->warning("latest release link : {$this->shortURL}");
		}
	}
}