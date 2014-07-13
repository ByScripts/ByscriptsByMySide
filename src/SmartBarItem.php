<?php

namespace Byscripts\SmartBar;

use Byscripts\HtmlAttributes\HtmlAttributesTrait;

/**
 * Class SmartBarItem
 *
 * @package Byscripts\SmartBar
 */
class SmartBarItem
{
    use HtmlAttributesTrait;

    /**
     * @var array
     */
    private static $styles = [];

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $horizontalPosition;

    /**
     * @var string
     */
    private $verticalPosition;

    /**
     * @var string
     */
    private $color;

    /**
     * @param string $label
     */
    public function __construct($label)
    {
        $this
            ->label($label)
            ->icon(substr($label, 0, 1), SmartBar::ICON_FORMAT_RAW)
            ->addClass('smartbar-item');
    }

    public static function addStyle($name, $color = null, $icon = null, $highlight = false, array $attributes = [])
    {
        self::$styles[ $name ] = compact('color', 'icon', 'highlight', 'attributes');
    }

    private static function applyStyle($name, SmartBarItem $item)
    {
        if (array_key_exists($name, self::$styles)) {

            extract(self::$styles[ $name ]);

            !empty($color) && $item->color($color);
            !empty($icon) && $item->icon($icon);
            !empty($highlight) && $item->highlight();
            !empty($attributes) && $item->setAttributes($attributes);
        }
    }

    /**
     * @param $url
     *
     * @return SmartBarItem
     */
    public function url($url)
    {
        $this->setAttribute('href', htmlspecialchars($url));

        return $this;
    }

    /**
     * @param $label
     *
     * @return SmartBarItem
     */
    public function label($label)
    {
        $this->label = (string)$label;

        return $this;
    }

    /**
     * Set a raw icon
     *
     * @param string $icon
     * @param null   $format
     *
     * @return SmartBarItem
     */
    public function icon($icon = null, $format = null)
    {
        $this->icon = SmartBar::buildIcon($icon ?: $this->color, $format);

        return $this;
    }

    public function red()
    {
        return $this->style('red');
    }

    public function green()
    {
        return $this->style('green');
    }

    public function blue()
    {
        return $this->style('blue');
    }

    public function yellow()
    {
        return $this->style('yellow');
    }

    /**
     * @return SmartBarItem
     */
    public function highlight()
    {
        return $this->addClass('smartbar-item-highlight');
    }

    public function color($color)
    {
        $this->removeClass('smartbar-item-color-' . $this->color);
        $this->color = $color;

        return $this->addClass('smartbar-item-color-' . $color);
    }

    public function style($style)
    {
        self::applyStyle($style, $this);

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $icon  = sprintf('<span class="smartbar-item-icon">%s</span>', $this->icon);
        $label = sprintf('<span class="smartbar-item-label">%s</span>', $this->label);
        $tag   = $this->hasAttribute('href') ? 'a' : 'span';

        if (SmartBarBlock::LEFT === $this->horizontalPosition) {
            $format = '<%1$s %2$s>%3$s%4$s</%1$s>';
        } else {
            $format = '<%1$s %2$s>%4$s%3$s</%1$s>';
        }

        return sprintf($format, $tag, $this->renderAttributes(), $icon, $label);
    }

    /**
     * @param $horizontalPosition
     * @param $verticalPosition
     *
     * @return SmartBarItem
     */
    public function setPosition($horizontalPosition, $verticalPosition)
    {
        $this->horizontalPosition = $horizontalPosition;
        $this->verticalPosition   = $verticalPosition;

        return $this;
    }
}