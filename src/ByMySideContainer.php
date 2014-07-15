<?php

namespace Byscripts\ByMySide;

class ByMySideContainer
{
    const LEFT = 'left';
    const RIGHT = 'right';

    /**
     * @var string
     */
    private $horizontalPosition;

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
            $this->topBlock = new ByMySideBlock($this->horizontalPosition, ByMySideBlock::TOP);
        if(!$this->hasTopBlock()) {
        }

        return $this->topBlock;
    }

    /**
     * @return ByMySideBlock
     */
    public function bottom()
    {
            $this->bottomBlock = new ByMySideBlock($this->horizontalPosition, ByMySideBlock::BOTTOM);
        if(!$this->hasBottomBlock()) {
        }

        return $this->bottomBlock;
    }

    /**
     * @return bool
     */
    public function hasTopBlock()
    {
        return null !== $this->topBlock;
    }

    /**
     * @return bool
     */
    public function hasBottomBlock()
    {
        return null !== $this->bottomBlock;
    }

    /**
     * @return string
     */
    public function render()
    {
        $content = '';

        if ($this->hasTopBlock()) {
            $content .= $this->topBlock->render();
        }

        if ($this->hasBottomBlock()) {
            $content .= $this->bottomBlock->render();
        }

        if (!empty($content)) {
            return sprintf('<div class="bymyside-container bymyside-container-%s">%s</div>', $this->horizontalPosition, $content);
        }

        return '';
    }
}