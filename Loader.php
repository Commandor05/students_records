<?php
/**
 * Created by PhpStorm.
 * User: oleh
 * Date: 23.06.15
 * Time: 11:39
 */


/**
 *Autoload classes.
 */

class Loader{



	static $_instance;

	//Array namespases paths
	protected $_namespacePaths = array();


	/**
	 * @return Loader instance
	 */
	public static function getInstance()
	{
		if (!(self::$_instance instanceof self))
			self::$_instance = new self();
		return self::$_instance;
	}



	private function __construct(){}


	private function __clone(){}

	/**
	 * Register loader in SPL loaders staсk.
	 *
	 * @return void
	 */
	public function register()
	{
		echo   $filePath;
		spl_autoload_register(array($this, '_loadClass'));
	}

	 /**
	 * Set path for namespase
	 * @param string
	 * @param string
	 * @return boolean
	 */
	public function addNamespacePath($namespace, $path)
	{
		if (is_dir($path)) {
			$namespace = trim($namespace, '\\') . '\\';
			$path = rtrim($path, DIRECTORY_SEPARATOR) . '/';
			$this->_namespacePaths[$namespace] = $path;
			return true;
		}

		return false;
	}

	 /**
	 * Class load
	 * @param string
	 * @return boolean
	 * @todo replace exeption later
	 */
	protected function _loadClass($class)
	{
		$pathParts = explode('\\', $class);
		if(is_array($pathParts)) {
			$namespace = array_shift($pathParts);
			if (!empty($this->_namespacePaths[$namespace])) {
				$filePath = $this->_namespacePaths[$namespace] . '/' . implode( '/', $pathParts ) . '.php';
				if ( $this->requireFile( $filePath ) ) {
					return true;
					}
				}
			}
		return false;
	}

	/**
	 * Load file if exist.
	 *
	 * @param string
	 * @return bool
	 */
	protected function requireFile($file)
	{
		if (file_exists($file)) {
			require_once $file;
			return true;
		}
		return false;
	}



}
