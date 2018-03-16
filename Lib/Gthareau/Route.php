<?php


namespace Gthareau;


class Route
{
    protected $url;
    protected $module;
    protected $action;
    protected $layout;
    protected $varsNames;
    protected $vars = [];

    public function __construct($url, $module, $action, $layout, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setLayout($layout);
        $this->setVarsNames($varsNames);
    }

    public function hasVars()
    {
        return !empty($this->varsNames);
    }

    public function match($url)
    {
        if (preg_match('`^'.$this->url.'$`', $url, $matches))
        {
            return $matches;
        }
        else
        {
            return false;
        }
    }

    public function setAction($action)
    {
        if (is_string($action))
        {
            $this->action = $action;
        }
    }

    public function setModule($module)
    {
        if (is_string($module))
        {
            $this->module = $module;
        }
    }

    public function setUrl($url)
    {
        if (is_string($url))
        {
            $this->url = $url;
        }
    }

    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }

    Public function setLayout($layout)
    {
        $this->layout =$layout;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getVars()
    {
        return $this->vars;
    }

    public function getVarsNames()
    {
        return $this->varsNames;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function getUrl()
    {
        return $this->url;
    }
}