<?php


/**
 * TargetsFinder has for role to read a file that contains
 * a list of URL (one by line) to scan.
 * 
 */
class TargetsFinder
{
	/**
	 * @var array
	 * An array that contains all targets
	 */
	private $targets;
	
	/**
 	 * @var string
	 * A string that reprents the path to the targets file
	 */
	private $filePath;

	public function __construct($filePath = __DIR__."/../res/targets.txt")
	{
		$this->targets = array();
		$this->filePath = $filePath;
	}

	public function getTargets()
	{
		return $this->targets;
	}

	public function getFilePath()
	{
		return $this->filePath;
	}

	/**
	 * Find targets in file specified in constructor.
	 * Links that are not URL are not saved
	 */
	public function findTargets()
	{
		$fileContent = file_get_contents($this->filePath);
		//Explode file content, and filter to remove empty strings.
		//Then, reindex values
		$this->targets = array_values(
							array_filter(
									explode("\n", $fileContent), 
									function($elem) { return !empty($elem);}
							)
						 );
		return $this;
	}

	/**
	 * Is $link an URL ?
	 * @return bool
	 */
	public function isUrl($link)
	{
		return preg_match("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $link);
	}

	/**
 	 * Clears targets to keep only valid URL
	 */
	public function clearNotUrl()
	{
		$this->targets = array_values(array_filter($this->targets, array($this, "isUrl")));
		return $this;
	}









}

