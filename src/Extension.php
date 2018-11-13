<?php
namespace Dawn\Twig;

use Twig_Extension;
use Twig_Function;
use Twig_Filter;

class Extension extends Twig_Extension{
    /**
     * Functions instance.
     * 
     * @var object
     */
    private $functions;

    /**
     * Construct.
     */
    public function __construct() {
        $this->functions = new Functions();
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return 'dawn/twig';
    }

    /**
     * Filter extension.
     *
     * @return array
     */
    public function getFilters() {
        $filters = array();
        foreach ($this->functions->all() as $name => $callback) {
            $filters[] = new Twig_Filter($name, $callback);
        }

        return $filters;
    }

    /**
     * Function extension.
     * 
     * @return array
     */
    public function getFunctions() {
        $functions = array();

        foreach ($this->functions->all() as $name => $callback) {
            $functions[] = new Twig_Function($name, $callback);
        }

        return $functions;
    }
}