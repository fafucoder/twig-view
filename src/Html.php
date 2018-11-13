<?php
namespace Dawn\Twig;

use Dawn\Asset\AssetManager;

/**
 * 可以跟pluginjs结合起来
 * 
 * @todo 跟前端组件结合起来(npm， webpack， pluginjs)
 */
class Html {
	/**
	 * Render registered asset
	 *
	 * @param string $name
	 * @return void
	 */
	public function renderAsset($name) {
		$asset = AssetManager::getInstance();

		return $asset->enqueue($name);
	}
}