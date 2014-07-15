<?php

use Byscripts\ByMySide\ByMySide;

class ByMySideTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $bms = new ByMySide();

        $bms->topLeft()->addItem(
            $bms->item('Hello')->blue(),
            $bms->item('World')->scheme('twitter')
        );

        $bms->topRight()->addItem(
            $bms->item('Hello')->red()->icon('X')->highlight(),
            $bms->item('World')
        );

        $bms->bottomLeft()->addItem(
            $bms->item('Hello')->url('http://foobar'),
            $bms->item('World')
        );

        $bms->bottomRight()->addItem(
            $bms->item('Hello'),
            $bms->item('World')
        );

        $this->assertEquals(
            '<div class="bymyside-container bymyside-container-left"><div class="bymyside-block bymyside-block-top"><span class="bymyside-item bymyside-item-scheme-blue"><span class="bymyside-item-icon">H</span><span class="bymyside-item-label">Hello</span></span><span class="bymyside-item bymyside-item-scheme-twitter"><span class="bymyside-item-icon">W</span><span class="bymyside-item-label">World</span></span></div><div class="bymyside-block bymyside-block-bottom"><a class="bymyside-item-scheme-default bymyside-item" href="http://foobar"><span class="bymyside-item-icon">H</span><span class="bymyside-item-label">Hello</span></a><span class="bymyside-item-scheme-default bymyside-item"><span class="bymyside-item-icon">W</span><span class="bymyside-item-label">World</span></span></div></div><div class="bymyside-container bymyside-container-right"><div class="bymyside-block bymyside-block-top"><span class="bymyside-item bymyside-item-scheme-red bymyside-item-highlight"><span class="bymyside-item-label">Hello</span><span class="bymyside-item-icon">X</span></span><span class="bymyside-item-scheme-default bymyside-item"><span class="bymyside-item-label">World</span><span class="bymyside-item-icon">W</span></span></div><div class="bymyside-block bymyside-block-bottom"><span class="bymyside-item-scheme-default bymyside-item"><span class="bymyside-item-label">Hello</span><span class="bymyside-item-icon">H</span></span><span class="bymyside-item-scheme-default bymyside-item"><span class="bymyside-item-label">World</span><span class="bymyside-item-icon">W</span></span></div></div>',
            $bms->render()
        );
    }

    public function testCustomStyles()
    {
        ByMySide::addStyle('foobar', 'red', 'foobar', true, ['id' => 'foobar']);
        $bms = new ByMySide();

        $bms->topLeft()->addItem($bms->item('Hello World')->style('foobar'));

        $this->assertEquals('<div class="bymyside-container bymyside-container-left"><div class="bymyside-block bymyside-block-top"><span class="bymyside-item bymyside-item-scheme-red bymyside-item-highlight" id="foobar"><span class="bymyside-item-icon">foobar</span><span class="bymyside-item-label">Hello World</span></span></div></div>', $bms->render());
    }
}