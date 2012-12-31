<?php

namespace DOMPDF;

class Config
{
    protected $temporaryDirectory = null;
    protected $defaultStylesheetPath = null;
    protected $enableRenderPhp = false;
    protected $enableHtml5Parser = false;
    protected $defaultFontFamily = 'serif';
    protected $defaultMediaType = 'screen';
    protected $renderingEngine = 'CPDF';
    protected $enabeUnicode = true;
    protected $fontCacheDirectory = null;
    protected $enableFontSubsetting = false;
    protected $enableCssFloat = false;
    protected $resourceDirectory = null;
    protected $enableRemote = false;
    protected $fontHeightRatio = 1.1;
    protected $dpi = 96;
    protected $enableJavascript = true;
    
    public function __construct(array $options = array())
    {
    }
    
    public function setOption($key, $value)
    {
        throw new \Exception('Method not implemented.');
    }
    
    public function setOptions(array $array)
    {
        throw new \Exception('Method not implemented.');
    }
    
    public function setTemporaryDirectory($directory)
    {
        $this->temporaryDirectory = $directory;
        return $this;
    }
    
    public function getTemporaryDirectory()
    {
        return $this->temporaryDirectory;
    }
    
    public function setDefaultStylesheetPath($path)
    {
        $this->defaultStylesheetPath = $path;
        return $this;
    }
    
    public function getDefaultStylesheetPath()
    {
        return $this->defaultStylesheetPath;
    }
    
    public function setEnableRenderPhp($flag)
    {
        $this->enableRenderPhp = (bool) $flag;
        return $this;
    }
    
    public function getEnableRenderPhp()
    {
        return $this->enableRenderPhp;
    }
    
    public function setEnableHtml5Parser($flag)
    {
        $this->enableHtml5Parser = (bool) $flag;
        return $this;
    }
    
    public function getEnableHtml5Parser()
    {
        return $this->enableHtml5Parser;
    }
    
    public function setDefaultFontFamily($family)
    {
        $this->defaultFontFamily = $family;
        return $this;
    }
    
    public function getDefaultFontFamily()
    {
        return $this->defaultFontFamily;
    }
    
    public function setDefaultMediaType($type)
    {
        $this->defaultMediaType = $type;
        return $this;
    }
    
    public function getDefaultMediaType()
    {
        return $this->defaultMediaType;
    }
    
    public function setRenderingEngine($engine)
    {
        $this->renderingEngine = $engine;
        return $this;
    }
    
    public function getRenderingEngine()
    {
        return $this->renderingEngine;
    }
    
    public function setEnableUnicode($flag)
    {
        $this->enableUnicode = (bool) $flag;
    }
    
    public function getEnableUnicode()
    {
        return $this->enabeUnicode;
    }
    
    public function setFontCacheDirectory($path)
    {
        $this->fontCacheDirectory = $path;
        return $this;
    }
    
    public function getFontCacheDirectory()
    {
        return $this->fontCacheDirectory;
    }
    
    public function setEnableFontSubsetting($flag)
    {
        $this->enableFontSubsetting = (bool) $flag;
        return $this;
    }
    
    public function getEnableFontSubsetting()
    {
        return $this->enableFontSubsetting;
    }
    
    public function setEnableCssFloat($flag)
    {
        $this->enableCssFloat = (bool) $flag;
        return $this;
    }
    
    public function getEnableCssFloat()
    {
        return $this->enableCssFloat;
    }
    
    public function setResourceDirectory($directory)
    {
        $this->resourceDirectory = $directory;
        return $this;
    }
    
    public function getResourceDirectory()
    {
        return $this->resourceDirectory;
    }
    
    public function setEnableRemote($flag)
    {
        $this->enableRemote = (bool) $flag;
        return $this;
    }
    
    public function getEnableRemote()
    {
        return $this->enableRemote;
    }
    
    public function setFontHeightRatio($ratio)
    {
        $this->fontHeightRatio = (float) $ratio;
        return $this;
    }
    
    public function getFontHeightRatio()
    {
        return $this->fontHeightRatio;
    }
    
    public function setDpi($dpi)
    {
        $this->dpi = (int) $dpi;
        return $this;
    }
    
    public function getDpi()
    {
        return $this->dpi;
    }
    
    public function setEnableJavascript($flag)
    {
        $this->enableJavascript = (bool) $flag;
        return $this;
    }
    
    public function getEnableJavascript()
    {
        return $this->enableJavascript;
    }
}