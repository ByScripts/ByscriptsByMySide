<?php

use Byscripts\SmartBar\SmartBarBlock;
use Byscripts\SmartBar\SmartBarItem;

class SmartBarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SmartBarBlock
     */
    private $smartBar;

    protected function setUp()
    {
        $this->smartBar = new SmartBarBlock();
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

        $smartBar = new SmartBarBlock();
        $smartBar->addItem($item);
        $this->assertEquals(
            '<div class="smartbar"><span class="smartbar-item"><span class="smartbar-item-icon">H</span><span class="smartbar-item-label">Hello World</span></span></div>',
            $smartBar->render()
        );
    }
}