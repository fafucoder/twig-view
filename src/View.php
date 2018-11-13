<?php
namespace Dawn\Twig;

class View {
	/**
	 * 是否缓存视图
	 *
	 * @var boolean
	 */
	public $cache = false;

	/**
	 * 是否开启调错
	 *
	 * @var boolean
	 */
	public $debug = false;

	/**
	 * 视图路径
	 *
	 * @var [type]
	 */
	public $path;

	/**
	 * Twig view instance.
	 *
	 * @var object
	 */
	public $view;

	/**
	 * Construct.
	 *
	 * @param array $config
	 */
	public function __construct($config = array()) {
		foreach ($config as $key => $value) {
			$this->$key = $value;
		}

		if (!isset($this->path)) {
			throw new InvalidArgumentException("View path must exists and not empty");
		}

		$loader = new \Twig_Loader_Filesystem($this->path);
		$this->view = new \Twig_Environment($loader, array(
			'cache' => $this->cache,
			'debug' => $this->debug,
		));
		$this->view->addExtension(new Extension());
	}

	/**
	 * 视图渲染
	 *
	 * @param string $file
	 * @param array $arguments
	 * 
	 * @return void
	 */
	public function render($file, $arguments = array()) {
		return $this->view->render($file, $arguments);
	}

}