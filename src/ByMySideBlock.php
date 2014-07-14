<?php

namespace Byscripts\ByMySide;

class ByMySideBlock
{
    const LEFT = 'left';
    const RIGHT = 'right';
    const TOP = 'top';
    const BOTTOM = 'bottom';

    /**
     * @var ByMySideItem[]
     */
    private $items = [];

    private $horizontalPosition = false;
    private $verticalPosition = false;

    function __construct($horizontalPosition, $verticalPosition)
    {
        $this->horizontalPosition = $horizontalPosition;
        $this->verticalPosition  = $verticalPosition;
    }

    /**
     * Add one or more items
     *
     * @param ByMySideItem $item
     * @param ByMySideItem ...
     *
     * @return ByMySideBlock
     */
    public function addItem(ByMySideItem $item)
    {
        $this->items = array_merge(
            $this->items,
            $this->setItemCollectionPosition(func_get_args())
        );

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
        $this->items = array_merge(
            $this->setItemCollectionPosition(func_get_args()),
            $this->items
        );

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

    /**
     * @param array $items
     *
     * @return array
     */
    private function setItemCollectionPosition(array $items)
    {
        return array_map(
            function (ByMySideItem $item) {
                return $item->setPosition($this->horizontalPosition, $this->verticalPosition);
            },
            $items
        );
    }
}
