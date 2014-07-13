<?php

namespace Byscripts\SmartBar;

class SmartBarContainer
{
    const LEFT = 'left';
    const RIGHT = 'right';

    /**
     * @var string
     */
    private $horizontalPosition = false;

    /**
     * @var SmartBarBlock
     */
    private $topBlock;

    /**
     * @var SmartBarBlock
     */
    private $bottomBlock;

    public function __construct($horizontalPosition)
    {
        $this->horizontalPosition = $horizontalPosition;
    }

    /**
     * @return SmartBarBlock
     */
    public function top()
    {
        if(null === $this->topBlock) {
            $this->topBlock = new SmartBarBlock($this->horizontalPosition, SmartBarBlock::TOP);
        }

        return $this->topBlock;
    }

    /**
     * @return SmartBarBlock
     */
    public function bottom()
    {
        if(null === $this->bottomBlock) {
            $this->bottomBlock = new SmartBarBlock($this->horizontalPosition, SmartBarBlock::BOTTOM);
        }

        return $this->bottomBlock;
    }

    /**
     * @return string
     */
    public function render()
    {
        $content = '';

        if (null !== $this->topBlock) {
            $content .= $this->topBlock->render();
        }

        if (null !== $this->bottomBlock) {
            $content .= $this->bottomBlock->render();
        }

        if (!empty($content)) {
            return sprintf('<div class="smartbar-container smartbar-container-%s">%s</div>', $this->horizontalPosition, $content);
        }

        return '';
    }
}