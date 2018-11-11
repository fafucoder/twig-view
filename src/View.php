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
	 * 是否开启布局
	 *
	 * @var boolean
	 */
	public $layout;

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
	 * 获取布局
	 * 
	 * 如果没有开启布局，返回false，如果开启了布局就返回布局的路径
	 *
	 * @return string|false
	 */
	public function getLayout() {
		$layout = $this->layout;
		
		if (!$layout) {
			return false;
		}
		//if is absolute path
		if(0 === strpos($layout, '/')) {
			return $layout;
		}
		if(false === strpos($layout, '.')) {
			$layout = 'layouts/layout.html';
		}

		return rtrim($this->path, '\\/') . DIRECTORY_SEPARATOR . $layout;
	}

	/**
	 * 设置布局。
	 *
	 * @return void
	 */
	public function setLayout($layout) {
		$this->layout = $layout;
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

	public function render_partial() {

	}

	public function render_plain() {

	}
}