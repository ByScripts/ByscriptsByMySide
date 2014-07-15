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
    private $scheme;

    /**
     * @param string $label
     * @param null   $style
     */
    public function __construct($label, $style = null)
    {
        $this
            ->label($label)
            ->icon(mb_substr($label, 0, 1), ByMySide::ICON_FORMAT_RAW)
            ->scheme('default')
            ->addClass('bymyside-item');

        if (null !== $style) {
            $this->style($style);
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
        ByMySide::applyStyle($style, $this);

        return $this;
    }

    /**
     * Render the item
     *
     * @return string
     */
    public function render()
    {
        return sprintf(
            '<%s %s>' .
            '<span class="bymyside-item-icon">%s</span>' .
            '<span class="bymyside-item-label">%s</span>' .
            '</%s>',
            $tag = $this->hasAttribute('href') ? 'a' : 'span',
            $this->renderAttributes(),
            $this->icon,
            $this->label,
            $tag
        );
    }
}