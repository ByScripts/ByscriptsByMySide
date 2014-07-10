<?php

namespace Byscripts\SmartBar;

use Byscripts\HtmlAttributes\HtmlAttributesTrait;

class SmartBarItem
{
    use HtmlAttributesTrait;

    /**
     * @var
     */
    private $label;

    /**
     * @var
     */
    private $icon;

    /**
     * @param string      $label
     * @param string|null $icon
     * @param string|null $url
     * @param array|null  $attributes
     */
    public function __construct($label, $icon = null, $url = null, array $attributes = null)
    {
        $this
            ->setLabel($label)
            ->setIcon(null !== $icon ? $icon : substr($this->label, 0, 1))
            ->setUrl($url)
            ->setAttributes($attributes)
            ->addClass('smartbar-item');
    }

    /**
     * @param $url
     *
     * @return SmartBarItem
     */
    public function setUrl($url)
    {
        $this->setAttribute('href', $url);

        return $this;
    }

    /**
     * @param $label
     *
     * @return SmartBarItem
     */
    public function setLabel($label)
    {
        $this->label = (string)$label;

        return $this;
    }

    /**
     * @param $icon
     *
     * @return SmartBarItem
     */
    public function setIcon($icon)
    {
        $this->icon = (string)$icon;

        return $this;
    }

    /**
     * @return SmartBarItem
     */
    public function highlight()
    {
        $this->addClass('smartbar-item-highlight');

        return $this;
    }

    /**
     * @return SmartBarItem
     */
    public function flagPrimary()
    {
        return $this->addClass('smartbar-item-primary');
    }

    /**
     * @return SmartBarItem
     */
    public function flagDanger()
    {
        return $this->addClass('smartbar-item-danger');
    }

    /**
     * @return SmartBarItem
     */
    public function flagSuccess()
    {
        return $this->addClass('smartbar-item-success');
    }

    /**
     * @return SmartBarItem
     */
    public function flagWarning()
    {
        return $this->addClass('smartbar-item-warning');
    }

    /**
     * @return SmartBarItem
     */
    public function flagInfo()
    {
        return $this->addClass('smartbar-item-info');
    }

    public function render()
    {
        $format = '<%1$s %2$s><span class="smartbar-item-icon">%3$s</span><span class="smartbar-item-label">%4$s</span></%1$s>';
        $tag = $this->hasAttribute('href') ? 'a' : 'span';

        return sprintf($format, $tag, $this->renderAttributes(), $this->icon, $this->label);
    }
}