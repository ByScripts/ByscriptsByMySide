<?php

namespace Byscripts\ByMySide;

class ByMySideBlock
{
    const TOP = 'top';
    const BOTTOM = 'bottom';

    /**
     * @var ByMySideItem[]
     */
    private $items = [];

    /**
     * @var string The vertical position (top or bottom block)
     */
    private $verticalPosition;

    function __construct($verticalPosition)
    {
        $this->verticalPosition  = $verticalPosition;
    }

    /**
     * Add one or more items
     *
     * @param ByMySideItem $item
     * @param ByMySideItem ...
     *
     * @return $this
     */
    public function addItem(ByMySideItem $item)
    {
        $this->items = array_merge($this->items, func_get_args());

        return $this;
    }

    /**
     * Add one or more items to the top of bar
     *
     * @param ByMySideItem $item
     * @param ByMySideItem ...
     *
     * @return ByMySideBlock
     */
    public function addItemToTop(ByMySideItem $item)
    {
        $this->items = array_merge(func_get_args(), $this->items);

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $content = '';

        foreach ($this->items as $item) {
            $content .= $item->render();
        }

        if (!empty($content)) {
            return sprintf('<div class="bymyside-block bymyside-block-%s">%s</div>', $this->verticalPosition, $content);
        }

        return '';
    }
}
