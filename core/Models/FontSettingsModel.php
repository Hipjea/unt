<?php

namespace Unt\Models;

class FontSettingsModel
{
    /** @var string */
    private $fontFamily = "";

    /** @var string */
    private $color = "";

    /** @var string */
    private $fontSize = "";

    /** @var string */
    private $lineHeight = "";

    /**
     * @return string
     */
    public function getFontFamily(): string
    {
        return $this->fontFamily;
    }

    /**
     * @param string $fontFamily
     * @return FontSettingsModel
     */
    public function setFontFamily(string $fontFamily): FontSettingsModel
    {
        $this->fontFamily = $fontFamily;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return FontSettingsModel
     */
    public function setColor(string $color): FontSettingsModel
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function getFontSize(): string
    {
        return $this->fontSize;
    }

    /**
     * @param string $fontSize
     * @return FontSettingsModel
     */
    public function setFontSize(string $fontSize): FontSettingsModel
    {
        $this->fontSize = $fontSize;
        return $this;
    }

    /**
     * @return string
     */
    public function getLineHeight(): string
    {
        return $this->lineHeight;
    }

    /**
     * @param string $lineHeight
     * @return FontSettingsModel
     */
    public function setLineHeight(string $lineHeight): FontSettingsModel
    {
        $this->lineHeight = $lineHeight;
        return $this;
    }
}