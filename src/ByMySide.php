<?php

namespace Byscripts\ByMySide;

class ByMySide
{
    const ICON_FORMAT_RAW = '%s';
    const ICON_FORMAT_BOOTSTRAP = '<span class="glyphicon glyphicon-%s"></span>';
    const ICON_FORMAT_FONTAWESOME = '<span class="fa fa-%s"></span>';

    private static $iconFormat = self::ICON_FORMAT_RAW;

    public static function setIconFormat($format)
    {
        self::$iconFormat = $format;
    }

    public static function buildIcon($icon, $format = null)
    {
        return sprintf($format ?: self::$iconFormat, $icon);
    }

    /**
     * @var ByMySideContainer
     */
    private $leftContainer;

    /**
     * @var ByMySideContainer
     */
    private $rightContainer;

    /**
     * @return ByMySideContainer
     */
    public function left()
    {
        if (null === $this->leftContainer) {
            $this->leftContainer = new ByMySideContainer(ByMySideContainer::LEFT);
        }

        return $this->leftContainer;
    }

    /**
     * @return ByMySideContainer
     */
    public function right()
    {
        if (null === $this->rightContainer) {
            $this->rightContainer = new ByMySideContainer(ByMySideContainer::RIGHT);
        }

        return $this->rightContainer;
    }

    /**
     * @return ByMySideBlock
     */
    public function topLeft()
    {
        return $this->left()->top();
    }

    /**
     * @return ByMySideBlock
     */
    public function bottomLeft()
    {
        return $this->left()->bottom();
    }

    /**
     * @return ByMySideBlock
     */
    public function topRight()
    {
        return $this->right()->top();
    }

    /**
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
     * @return string
     */
    public function render()
    {
        $output = '';

        if(null !== $this->leftContainer) {
            $output .= $this->leftContainer->render();
        }

        if(null !== $this->rightContainer) {
            $output .= $this->rightContainer->render();
        }

        return $output;
    }
}