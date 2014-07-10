<?php

namespace Byscripts\SmartBar;

class SmartBar
{
    /**
     * @var SmartBarItem[]
     */
    private $items = [];

    /**
     * Add one or more items
     *
     * @param SmartBarItem $item
     * @param              SmartBarItem ...
     *
     * @return SmartBar
     */
    public function addItem(SmartBarItem $item)
    {
        $this->items = array_merge($this->items, func_get_args());

        return $this;
    }

    /**
     * Add one or more items to the top of bar
     *
     * @param SmartBarItem $item
     * @param              SmartBarItem ...
     *
     * @return SmartBar
     */
    public function addItemToTop(SmartBarItem $item)
    {
        $this->items = array_merge(func_get_args(), $this->items);

        return $this;
    }

    /**
     * Create and return a new item
     * (don't add it to the stack)
     *
     * @param string      $label
     * @param string|null $icon
     * @param string|null $url
     * @param array       $attributes
     *
     * @return \Byscripts\SmartBar\SmartBarItem
     */
    public function item($label, $icon = null, $url = null, $attributes = [])
    {
        return new SmartBarItem($label, $icon, $url, $attributes);
    }

    public function render()
    {
        $output = '<div class="smartbar">';

        foreach ($this->items as $item) {
            $output .= $item->render();
        }

        return $output . '</div>';
    }
}
