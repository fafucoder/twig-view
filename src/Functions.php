<?php
namespace Dawn\Twig;

class Functions {
	/**
	 * PHP system functions.
	 * 
	 * @var array
	 */
	private $functions = array();

	/**
	 * Construct
	 */
	public function __construct() {
		$this->functions = array_merge($this->system(), $this->functions);
	}

	/**
	 * Register a functions.
	 * 
	 * @param  mixed $name     function name
	 * @param  mixed $callback callback
	 * @return void
	 */
	public function register($name, $callback) {
		if (is_array($name)) {
			foreach ($name as $n => $function) {
				$this->register($n, $function);
			}
		} else {
			$this->functions[$name] = $callback;
		}
	}

	/**
	 * Get all registered functions.
	 * 
	 * @return array
	 */
	public function all() {
		return $this->functions;
	}

	/**
	 * Unregister functions.
	 * 
	 * @param  mixed $name function name
	 * @return void       
	 */
	public function unregister($name) {
		if (is_array($name)) {
			foreach ($name as $n) {
				$this->unregister($n);
			}
		} else {
			if ($this->has($name)) {
				unset($this->functions[$name]);
			}
		}
	}

	/**
	 * Check if exists register function.
	 * 
	 * @param  string  $name 
	 * @return boolean       
	 */
	public function has($name) {
		return array_key_exists($name, $this->functions);
	}

	/**
	 * Get twig functions.
	 * 
	 * @return array
	 */
	public function getFunctions() {
		$twig_functions = array();

		foreach ($this->functions as $key => $callback) {
			$twig_functions[] = new Twig_Function($key, $callback);
		}

		return $twig_functions;
	}

	/**
	 * Get php defined function.
	 * 
	 * @return array 
	 */
	private function system() {
		$system = array();

		foreach (get_defined_functions()['internal'] as $func) {
			$system[$func] = $func;
		}
		return $system;
	}
}