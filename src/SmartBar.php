<?php

namespace Byscripts\SmartBar;

class SmartBar
{
    private $items = [];

    public function add($label, $icon = null, $url = null, array $attributes = [])
    {
        return $this->items[] = new SmartbarItem($label, $icon, $url, $attributes);
    }
}
