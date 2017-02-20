<?php
/***
 * Interface ILogHandler
 */
interface ILogHandler
{
	public function write($msg);
	
}

/***
 * Class CLogFileHandler
 */
class CLogFileHandler implements ILogHandler
{
	private $handle = null;
	
	public function __construct($file = '')
	{
		$this->handle = fopen($file,'a');
	}
	
	public function write($msg)
	{
		fwrite($this->handle, $msg, 4096);
	}
	
	public function __destruct()
	{
		fclose($this->handle);
	}
}

/***
 * Class Log
 */
class Log
{
	private $handler = null;
	private $level = 15;
	
	private static $instance = null;
	
	private function __construct(){}

	private function __clone(){}
	
	public static function Init($handler = null,$level = 15)
	{
		if(!self::$instance instanceof self)
		{
			self::$instance = new self();
			self::$instance->__setHandle($handler);
			self::$instance->__setLevel($level);
		}
		return self::$instance;
	}

	/***
	 * @param $handler
	 */
	private function __setHandle($handler){
		$this->handler = $handler;
	}
	
	private function __setLevel($level)
	{
		$this->level = $level;
	}
	
	public static function DEBUG($msg)
	{
		$debugInfo = debug_backtrace(0,1);
		$stack = "[";
		$last_location = strrpos($debugInfo[0]["file"],DIRECTORY_SEPARATOR);
		$file_name=substr($debugInfo[0]["file"],$last_location+1);
		$stack .= $file_name." ".$debugInfo[0]["line"];
		$stack .= "]";
		self::$instance->write(1,  $stack . $msg);
	}
	
	public static function WARN($msg)
	{
		self::$instance->write(4, $msg);
	}
	
	public static function ERROR($msg)
	{
		$debugInfo = debug_backtrace(0,1);
		$stack = "[";
		foreach($debugInfo as $key => $val){
			if(array_key_exists("file", $val)){
				$stack .= ",file:" . $val["file"];
			}
			if(array_key_exists("line", $val)){
				$stack .= ",line:" . $val["line"];
			}
			if(array_key_exists("function", $val)){
				$stack .= ",function:" . $val["function"];
			}
		}
		$stack .= "]";
		self::$instance->write(8, $stack . $msg);
	}
	
	public static function INFO($msg)
	{
		$debugInfo = debug_backtrace(0,1);
		$stack = "[";
		$last_location = strrpos($debugInfo[0]["file"],DIRECTORY_SEPARATOR);
		$file_name=substr($debugInfo[0]["file"],$last_location+1);
		$stack .= $file_name." ".$debugInfo[0]["line"];
		$stack .= "]";
		self::$instance->write(2, $stack .$msg);
	}
	
	private function getLevelStr($level)
	{
		switch ($level)
		{
		case 1:
			return 'debug';
		break;
		case 2:
			return 'info';	
		break;
		case 4:
			return 'warn';
		break;
		case 8:
			return 'error';
		break;
		default:
				
		}
	}
	
	protected function write($level,$msg)
	{
		if(($level & $this->level) == $level )
		{
			$msg = '['.date('Y-m-d H:i:s').']['.$this->getLevelStr($level).'] '.$msg."\n";
			$this->handler->write($msg);
		}
	}
}