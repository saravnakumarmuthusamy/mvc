<?php
class cache
{
	private $scanDir;
	function __construct(){
		
	}
	//Function to write contents in a cache file
	function writeCache($cacheFile, $content)
	{
		$fp = fopen($cacheFile,'w');
		if($fp){
			fwrite($fp, $content);
			fclose($fp);
			return true;
		}
		return false;
	}
	//Function to read cache file
	function readCache($cacheFile)
	{
		if(file_exists($cacheFile)){
			return file_get_contents($cacheFile);
		} else {
			return false;
		}
	}
	//Function to delete a cache file
	function deleteCache($cacheFile)
	{
		if(@unlink($cacheFile)) {
			return true;
		} else {
			return false;
		}
	}
	//Get the Files in Cache Directory
	function scanDirectory($cacheDir)
	{
		$files = scandir(cacheDir);
		if(is_array($files)) {
			if(count($files)>2) {
				array_shift($files);
				array_shift($files);
				return $this->scanDir = $files;
			} else {
				return false; 
			} 
		} else {
			return; 
		}
	}
	//Function to Delete Files in cache Directory
	public function deleteDirecotry($cacheDir, $pattern = '')
	{
		if($this->scanDirectory($cacheDir)){
			if($this->scanDir) {
				foreach($this->scanDir as $k=>$v) {
					if($pattern && preg_match($pattern, $v, $matches))
						@unlink($this->cache.$v);
					else if(!$pattern) 
						@unlink($this->cache.$v); 
				}
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
	
	function __destruct(){
		unset($this->scanDir);
	}
	
}
?>