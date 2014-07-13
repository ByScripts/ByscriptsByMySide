<?php

namespace Byscripts\SmartBar;

class SmartBar
{
    const ICON_FORMAT_RAW = '%s';
    const ICON_FORMAT_BOOTSTRAP = '<span class="glyphicon glyphicon-%s"></span>';
    const ICON_FORMAT_FONTAWESOME = '<span class="fa fa-%s"></span>';

    private static $iconFormat = self::ICON_FORMAT_FONTAWESOME;

    public static function setIconFormat($format)
    {
        self::$iconFormat = $format;
    }

    public static function buildIcon($icon, $format = null)
    {
        return sprintf($format ?: self::$iconFormat, $icon);
    }

    /**
     * @var SmartBarContainer
     */
    private $leftContainer;

    /**
     * @var SmartBarContainer
     */
    private $rightContainer;

    /**
     * @return SmartBarContainer
     */
    public function left()
    {
        if (null === $this->leftContainer) {
            $this->leftContainer = new SmartBarContainer(SmartBarContainer::LEFT);
        }

        return $this->leftContainer;
    }

    /**
     * @return SmartBarContainer
     */
    public function right()
    {
        if (null === $this->rightContainer) {
            $this->rightContainer = new SmartBarContainer(SmartBarContainer::RIGHT);
        }

        return $this->rightContainer;
    }

    /**
     * @return SmartBarBlock
     */
    public function topLeft()
    {
        return $this->left()->top();
    }

    /**
     * @return SmartBarBlock
     */
    public function bottomLeft()
    {
        return $this->left()->bottom();
    }

    /**
     * @return SmartBarBlock
     */
    public function topRight()
    {
        return $this->right()->top();
    }

    /**
     * @return SmartBarBlock
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
     * @return SmartBarItem
     */
    public function item($label)
    {
        return new SmartBarItem($label);
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