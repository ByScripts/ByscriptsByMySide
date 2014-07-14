<?php

namespace Byscripts\ByMySide;

class ByMySideContainer
{
    const LEFT = 'left';
    const RIGHT = 'right';

    /**
     * @var string
     */
    private $horizontalPosition = false;

    /**
     * @var ByMySideBlock
     */
    private $topBlock;

    /**
     * @var ByMySideBlock
     */
    private $bottomBlock;

    public function __construct($horizontalPosition)
    {
        $this->horizontalPosition = $horizontalPosition;
    }

    /**
     * @return ByMySideBlock
     */
    public function top()
    {
        if(null === $this->topBlock) {
            $this->topBlock = new ByMySideBlock($this->horizontalPosition, ByMySideBlock::TOP);
        }

        return $this->topBlock;
    }

    /**
     * @return ByMySideBlock
     */
    public function bottom()
    {
        if(null === $this->bottomBlock) {
            $this->bottomBlock = new ByMySideBlock($this->horizontalPosition, ByMySideBlock::BOTTOM);
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
            return sprintf('<div class="bymyside-container bymyside-container-%s">%s</div>', $this->horizontalPosition, $content);
        }

        return '';
    }
}