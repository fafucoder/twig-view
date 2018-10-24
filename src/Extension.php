<?php
namespace FaFu\Twig;

use Twig_Extension;
use Twig_Function;
use Twig_Filter;

class Extension extends Twig_Extension{
    /**
     * Filter extension.
     *
     * @return array
     */
    public function getFilters() {
        return array(
            //Filter 没有参数
            new Twig_Filter('demo', array($this, 'demo')),
        );
    }

    /**
     * Functions extension.
     *
     * @return array
     */
    public function getFunctions() {
        return array(
            new Twig_Function('demo', array($this, 'demo_functions')),
        );
    }
}