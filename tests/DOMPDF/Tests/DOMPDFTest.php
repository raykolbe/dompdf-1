<?php

namespace DOMPDF\Tests;

use DOMPDF\Tests\DOMPDFTestCase as TestCase;
use DOMPDF\DOMPDF;
use DOMPDF\Config;

class DOMPDFTest extends TestCase
{
    public function setUp()
    {
        $this->config = new Config();
        $this->config->setDefaultStylesheetPath(__DIR__ . '/../../../resources/html.css');
        $this->config->setResourceDirectory(__DIR__ . '/../../../resources');
        $this->config->setFontCacheDirectory(__DIR__ . '/../../../data/fonts');
        
        $this->dompdf = new DOMPDF($this->config);
        $this->testResourceDirectory = __DIR__ . '/../../resources';
        $this->testTempDirectory = __DIR__ . '/../../temp';
        
        foreach (new \DirectoryIterator($this->testTempDirectory) as $file) {
            if ($file->isDot()) {
                continue;
            }
            unlink($file->getPathname());
        }
    }
    
    public function testInstantiateSingleInstance()
    {
        $config = new Config();
        $dompdf = new DOMPDF($config);
    }
    
    public function testInstantiateMultipleInstancesWithSameConfig()
    {
        $config = new Config();
        $dompdf1 = new DOMPDF($config);
        $dompdf2 = new DOMPDF($config);
        
        $this->assertSame($config, $dompdf1->getConfig());
        $this->assertSame($config, $dompdf2->getConfig());
        $this->assertNotSame($dompdf1, $dompdf2);
    }
    
    public function testRenderPrintHeaderFooter()
    {
        $html = file_get_contents($this->testResourceDirectory . '/print-header-footer.html');
        $controlPdf = file_get_contents($this->testResourceDirectory . '/print-header-footer.pdf');
        $pdfCompareFile = $this->testTempDirectory . '/print-header-footer.pdf';
        
        $dompdf = $this->dompdf;
        $dompdf->load_html($html);
        $dompdf->render();

        file_put_contents($pdfCompareFile, $dompdf->output());
        
        $this->assertFileEquals($controlPdf, $pdfCompareFile);
    }
}