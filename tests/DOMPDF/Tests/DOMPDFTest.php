<?php

namespace DOMPDF\Tests;

use DOMPDF\Tests\DOMPDFTestCase as TestCase;
use DOMPDF\DOMPDF;

class DOMPDFTest extends TestCase
{
    public function testInstantiateSingleInstance()
    {
        $dompdf = new DOMPDF();
    }
}