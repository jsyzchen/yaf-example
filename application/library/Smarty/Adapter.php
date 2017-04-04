<?php
namespace Smarty;

class Adapter implements \Yaf\View_Interface
{
    /**
     * Smarty object
     * @var Smarty
     */
    private $smarty;

    /**
     * Constructor
     *
     * @param string $tmplPath
     * @param array $extraParams
     * @return void
     */
    public function __construct($tmplPath = null, $extraParams = array())
    {
        $this->smarty = new \Smarty;

        if (null !== $tmplPath) {
            $this->setScriptPath($tmplPath);
        }

        foreach ($extraParams as $key => $value) {
            $this->smarty->$key = $value;
        }
    }

    /**
     * Return the template engine object
     *
     * @return Smarty
     */
    public function getEngine()
    {
        return $this->smarty;
    }

    /**
     * Set the path to the templates
     *
     * @param string $path The directory to set as the path.
     * @return void
     */
    public function setScriptPath($path)
    {
        if (is_readable($path)) {
            $this->smarty->template_dir = $path;
            return;
        }
        throw new \Exception('Invalid path provided');
    }

    /**
     * Retrieve the current template directory
     *
     * @return string
     */
    public function getScriptPath()
    {
        return $this->smarty->template_dir;
    }

    /**
     * Assign a variable to the template
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key, $val)
    {
        $this->smarty->assign($key, $val);
    }

    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return (null !== $this->smarty->getTemplateVars($key));
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->smarty->clearAssign($key);
    }

    /**
     * Assign variables to the template
     *
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     *
     * @see __set()
     * @param string|array $spec The assignment strategy to use (key or
     * array of key => value pairs)
     * @param mixed $value (Optional) If assigning a named variable,
     * use this as the value.
     * @return void
     */
    public function assign($spec, $value = null)
    {
        if (is_array($spec)) {
            $this->smarty->assign($spec);
            return;
        }
        $this->smarty->assign($spec, $value);
    }

    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via
     * {@link assign()} or property overloading
     * ({@link __get()}/{@link __set()}).
     *
     * @return void
     */
    public function clearVars()
    {
        $this->smarty->clearAllAssign();
    }

    /**
     * Processes a template and returns the output.
     *
     * @param string $name The template to process.
     * @return string The output.
     */
    public function render($name, $value = null)
    {
        return $this->smarty->fetch($name, $value);
    }

    /**
     * display
     * @param string $name
     * @param null $value
     */
    public function display($name, $value = null)
    {
        $this->smarty->display($name, $value);
    }


    /**
     * 魔术方法
     * @param $method
     * @param $args
     * @return mixed
     * @author chenchen16@leju.com
     * @date 2016/11/15
     */
    public function __call($method, $args)
    {
        $smarty = $this->smarty;

        switch (count($args)) {
            case 0:
                return $smarty->$method();
            case 1:
                return $smarty->$method($args[0]);
            case 2:
                return $smarty->$method($args[0], $args[1]);
            case 3:
                return $smarty->$method($args[0], $args[1], $args[2]);
            case 4:
                return $smarty->$method($args[0], $args[1], $args[2], $args[3]);
            default:
                return call_user_func_array([$smarty, $method], $args);
        }
    }
}