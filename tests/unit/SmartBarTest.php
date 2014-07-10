<?php

use Byscripts\SmartBar\SmartBar;
use Byscripts\SmartBar\SmartBarItem;

class SmartBarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SmartBar
     */
    private $smartBar;

    protected function setUp()
    {
        $this->smartBar = new SmartBar();
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
        $item = new SmartBarItem('Hello World');

        $this->assertEquals(
            '<span class="smartbar-item"><span class="smartbar-item-icon">H</span><span class="smartbar-item-label">Hello World</span></span>',
            $item->render()
        );

        $smartBar = new SmartBar();
        $smartBar->addItem($item);
        $this->assertEquals(
            '<div class="smartbar"><span class="smartbar-item"><span class="smartbar-item-icon">H</span><span class="smartbar-item-label">Hello World</span></span></div>',
            $smartBar->render()
        );
    }
}