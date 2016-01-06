<?php

namespace PhantomPdf\Test;

use PhantomPdf\Options;

class OptionTest extends \PHPUnit_Framework_TestCase
{
    public function testOptionsToArray()
    {
        $options = new Options();
        $options->setFormat('MockFormat');
        $options->setMargin('MockMargin');
        $options->setOrientation('MockOrientation');

        $actualOptionArray = $options->toArray();
        $expectedOptionArray = [
            'format' => 'MockFormat',
            'margin' => 'MockMargin',
            'orientation' => 'MockOrientation',
        ];

        $this->assertEquals($expectedOptionArray, $actualOptionArray);
    }
}
