<?php


namespace Gthareau;
use Gthareau\Application;

class Page extends Application
{
    protected $contentFile;
    protected $vars = [];
    protected $layout;

    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractère non nulle');
        }
        $this->vars[$var] = $value;
    }

    public function getPage()
    {
        if (!file_exists($this->contentFile)) {
            throw new \RuntimeException('la vus spécifié n\'existe pas');
        }
        extract($this->vars);

        ob_start();
        include $this->contentFile;
        $content = ob_get_clean();

        ob_start();
        include $this->layout;
        return ob_get_clean();

    }

    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        }
        $this->contentFile = $contentFile;
    }

    Public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}