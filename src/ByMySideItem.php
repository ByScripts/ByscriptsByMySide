<?php

namespace Byscripts\ByMySide;

use Byscripts\HtmlAttributes\HtmlAttributesTrait;

/**
 * Class ByMySideItem
 *
 * @package Byscripts\ByMySide
 */
class ByMySideItem
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
    private $scheme;

    /**
     * @param string $label
     */
    public function __construct($label)
    {
        $this
            ->label($label)
            ->icon(substr($label, 0, 1), ByMySide::ICON_FORMAT_RAW)
            ->scheme('default')
            ->addClass('bymyside-item');
    }

    public static function addStyle($name, $scheme = null, $icon = null, $highlight = false, array $attributes = [])
    {
        self::$styles[ $name ] = compact('scheme', 'icon', 'highlight', 'attributes');
    }

    private static function applyStyle($name, ByMySideItem $item)
    {
        if (array_key_exists($name, self::$styles)) {

            extract(self::$styles[ $name ]);

            !empty($scheme) && $item->scheme($scheme);
            !empty($icon) && $item->icon($icon);
            !empty($highlight) && $item->highlight();
            !empty($attributes) && $item->setAttributes($attributes);
        }
    }

    /**
     * @param $url
     *
     * @return ByMySideItem
     */
    public function url($url)
    {
        $this->setAttribute('href', htmlspecialchars($url));

        return $this;
    }

    /**
     * @param $label
     *
     * @return ByMySideItem
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
     * @return ByMySideItem
     */
    public function icon($icon = null, $format = null)
    {
        $this->icon = ByMySide::buildIcon($icon ?: $this->scheme, $format);

        return $this;
    }

    public function red()
    {
        return $this->scheme('red');
    }

    public function green()
    {
        return $this->scheme('green');
    }

    public function blue()
    {
        return $this->scheme('blue');
    }

    public function yellow()
    {
        return $this->scheme('yellow');
    }

    /**
     * @return ByMySideItem
     */
    public function highlight()
    {
        return $this->addClass('bymyside-item-highlight');
    }

    public function scheme($scheme)
    {
        $this->removeClass('bymyside-item-scheme-' . $this->scheme);
        $this->scheme = $scheme;

        return $this->addClass('bymyside-item-scheme-' . $scheme);
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
        $icon  = sprintf('<span class="bymyside-item-icon">%s</span>', $this->icon);
        $label = sprintf('<span class="bymyside-item-label">%s</span>', $this->label);
        $tag   = $this->hasAttribute('href') ? 'a' : 'span';

        if (ByMySideBlock::LEFT === $this->horizontalPosition) {
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
     * @return ByMySideItem
     */
    public function setPosition($horizontalPosition, $verticalPosition)
    {
        $this->horizontalPosition = $horizontalPosition;
        $this->verticalPosition   = $verticalPosition;

        return $this;
    }
}