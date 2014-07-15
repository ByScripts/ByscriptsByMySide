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
     * Set an URL
     *
     * @param $url
     *
     * @return $this
     */
    public function url($url)
    {
        $this->setAttribute('href', htmlspecialchars($url));

        return $this;
    }

    /**
     * Set a label
     *
     * @param $label
     *
     * @return $this
     */
    public function label($label)
    {
        $this->label = (string)$label;

        return $this;
    }

    /**
     * Set an icon
     *
     * @param string      $icon   The icon to set
     * @param string|null $format The format (printf)
     *
     * @return $this
     */
    public function icon($icon = null, $format = null)
    {
        $this->icon = ByMySide::buildIcon($icon ?: $this->scheme, $format);

        return $this;
    }

    /**
     * Alias for setAttributes
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function attributes(array $attributes)
    {
        return $this->setAttributes($attributes);
    }

    /**
     * Apply "red" scheme
     *
     * @return $this
     */
    public function red()
    {
        return $this->scheme('red');
    }

    /**
     * Apply "green" scheme
     *
     * @return $this
     */
    public function green()
    {
        return $this->scheme('green');
    }

    /**
     * Apply "blue" scheme
     *
     * @return $this
     */
    public function blue()
    {
        return $this->scheme('blue');
    }

    /**
     * Apply "blue" scheme
     *
     * @return $this
     */
    public function yellow()
    {
        return $this->scheme('yellow');
    }

    /**
     * Highlight the item icon
     *
     * @return $this
     */
    public function highlight()
    {
        return $this->addClass('bymyside-item-highlight');
    }

    /**
     * Apply a scheme
     *
     * @param $scheme
     *
     * @return $this
     */
    public function scheme($scheme)
    {
        $this->removeClass('bymyside-item-scheme-' . $this->scheme);
        $this->scheme = $scheme;

        return $this->addClass('bymyside-item-scheme-' . $scheme);
    }

    /**
     * Apply a style
     *
     * @param $style
     *
     * @return $this
     */
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