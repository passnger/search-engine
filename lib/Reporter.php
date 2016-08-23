<?php


class Reporter
{
	/**
	 * @var string
	 * Website's URL
	 */
	private $url;

	/**
	 * @var string
	 * Path to directory where output file will be written
	 * Note: The path should be ended with a '/'
	 */
	private $fileDirectory;

	/**
	 * @var string
	 * Output file's name
	 */
	private $fileName;

	/**
	 * @var array
	 * An array with following form: url => occurencesNumber
	 */
	private $linksOccurences;



	/**
	 * Reporter constructor
	 * @param string $url the website url
	 * @param string $filename the output file name
	 * @param string $fileDirectory the path to the directory that hosts
	 * the output file, it should be ended by '/'
	 */
	public function __construct($url, $fileName, $fileDirectory = __DIR__."/../res/")
	{
		$this->url = $url;
		$this->fileName = $fileName;
		$this->fileDirectory = $fileDirectory;
	}

	/**
	 * Set linksOccurences
	 * @param array $linksOccurences associative array. url => occurencesNb
	 */
	public function setLinksOccurences($linksOccurences)
	{
		$this->linksOccurences = $linksOccurences;
		return $this;	
	}


	/**
	 * Get the report header
	 * @return string
	 */
	public function getHeader()
	{
		return "===================\n
				". $this->url . "\n
				===================\n
				";
	}


	/**
	 * Get the report footer
	 * @return string
	 */
	public function getFooter()
	{
		return "====================";
	}

	/**
	 * Writes report in output file
	 * @param $headAndFoot Write header and footer in report ?
	 */
	public function report($headAndFoot = false)
	{
		$report = "";
		if ($headAndFoot) {
			$report .= $this->getHeader();
		}
		foreach($this->linksOccurences as $link => $occurencesNb) {
				$report .= $link . " => " . $occurencesNumber . "\n";
		}

		if ($headAndFoot) {
			$report .= $this->getFooter();
		}

		$f = fopen($this->fileDirectory . $this->fileName, "w");

		if (!$f) {
			echo "Unable to open " . $this->fileDirectory . $this->fileName . "\n";
			return;
		}
		fwrite($f, $report);
		fclose($f);
	}
















} 
