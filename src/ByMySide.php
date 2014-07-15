<?php

namespace Byscripts\ByMySide;

class ByMySide
{
    const ICON_FORMAT_RAW = '%s';
    const ICON_FORMAT_BOOTSTRAP = '<span class="glyphicon glyphicon-%s"></span>';
    const ICON_FORMAT_FONTAWESOME = '<span class="fa fa-%s"></span>';

    /**
     * Icon format (printf compatible format)
     *
     * @var string
     */
    private static $iconFormat = self::ICON_FORMAT_RAW;

    /**
     * Predefined styles
     *
     * @var array
     */
    private static $styles = [];

    /**
     * @var ByMySideContainer
     */
    private $leftContainer;

    /**
     * @var ByMySideContainer
     */
    private $rightContainer;

    /**
     * Set the icon format (printf compatible format)
     *
     * @param $format
     */
    public static function setIconFormat($format)
    {
        self::$iconFormat = $format;
    }

    /**
     * Generate an icon
     *
     * @param string      $icon
     * @param null|string $format
     *
     * @return string
     */
    public static function buildIcon($icon, $format = null)
    {
        return sprintf($format ?: self::$iconFormat, $icon);
    }

    /**
     * Add a predefined style
     *
     * @param string $name       The name of the style
     * @param null   $scheme     The color scheme to use
     * @param null   $icon       The icon to use
     * @param bool   $highlight  Highlight the icon?
     * @param array  $attributes HTML attributes
     */
    public static function addStyle($name, $scheme = null, $icon = null, $highlight = false, array $attributes = [])
    {
        self::$styles[ $name ] = compact('scheme', 'icon', 'highlight', 'attributes');
    }

    /**
     * Apply a predefined style to an item
     *
     * @param string       $name The name of the style to apply
     * @param ByMySideItem $item The item to style
     */
    public static function applyStyle($name, ByMySideItem $item)
    {
        if (array_key_exists($name, self::$styles)) {

            extract(self::$styles[ $name ]);

            !empty($scheme) && $item->scheme($scheme);
            !empty($icon) && $item->icon($icon);
            !empty($highlight) && $item->highlight();
            !empty($attributes) && $item->attributes($attributes);
        }
    }

    /**
     * @return bool
     */
    public function hasLeftContainer()
    {
        return null !== $this->leftContainer;
    }

    /**
     * @return bool
     */
    public function hasRightContainer()
    {
        return null !== $this->rightContainer;
    }

    /**
     * Get the left container (created on first call)
     *
     * @return ByMySideContainer
     */
    public function left()
    {
        if (!$this->hasLeftContainer()) {
            $this->leftContainer = new ByMySideContainer(ByMySideContainer::LEFT);
        }

        return $this->leftContainer;
    }

    /**
     * Get the right container (created on first call)
     *
     * @return ByMySideContainer
     */
    public function right()
    {
        if (!$this->hasRightContainer()) {
            $this->rightContainer = new ByMySideContainer(ByMySideContainer::RIGHT);
        }

        return $this->rightContainer;
    }

    /**
     * Shortcut to get the top left block
     *
     * @return ByMySideBlock
     */
    public function topLeft()
    {
        return $this->left()->top();
    }

    /**
     * Shortcut to get the bottom left block
     *
     * @return ByMySideBlock
     */
    public function bottomLeft()
    {
        return $this->left()->bottom();
    }

    /**
     * Shortcut to get the top right block
     *
     * @return ByMySideBlock
     */
    public function topRight()
    {
        return $this->right()->top();
    }

    /**
     * Shortcut to get the bottom right block
     *
     * @return ByMySideBlock
     */
    public function bottomRight()
    {
        return $this->right()->bottom();
    }

    /**
     * Shortcut to create a new item
     *
     * @param string      $label
     *
     * @return ByMySideItem
     */
    public function item($label)
    {
        return new ByMySideItem($label);
    }

    /**
     * Render the containers
     *
     * @return string
     */
    public function render()
    {
        $output = '';

        if ($this->hasLeftContainer()) {
            $output .= $this->leftContainer->render();
        }

        if ($this->hasRightContainer()) {
            $output .= $this->rightContainer->render();
        }

        return $output;
    }
}