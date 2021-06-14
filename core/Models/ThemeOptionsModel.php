<?php

namespace Unt\Models;

use Unt\Models\FontSettingsModel;

class ThemeOptionsModel
{
    /** @var string */
    private $mainColor = "";

    /** @var string */
    private $secondaryColor = "";

    /** @var string */
    private $tertiaryColor = "";

    /** @var string */
    private $headerTitle = "";

    /** @var string */
    private $headerSubtitle = "";

    /** @var string */
    private $faviconImage = "";

    /** @var string */
    private $headerBackgroundImage = "";

    /** @var string */
    private $headerLogo = "";

    /** @var string */
    private $headerLogoOnScroll = "";

    /** @var string */
    private $footerCopyright = "";

    /** @var bool */
    private $solrEnabled = false;
    
    /** @var string */
    private $zoomSolrRequest = "";

    /** @var bool */
    private $facetEstampillageVisibility = true;

    /** @var bool */
    private $facetDisciplineVisibility = true;

    /** @var bool */
    private $facetNiveauVisibility = true;

    /** @var bool */
    private $facetTypeVisibility = true;

    /** @var bool */
    private $facetLangueVisibility = true;

    /** @var string */
    private $externalSearchUrl = "";

    /** @var bool */
    private $recommandationVisibility = true;

    /** @var string */
    private $matomoScript = "";

    /** @var array */
    private $gfontsImports;
    
    /** @var FontSettingsModel */
    private $baseFontSettings;
    
    /** @var FontSettingsModel */
    private $h1FontSettings;
    
    /** @var FontSettingsModel */
    private $h2FontSettings;
    
    /** @var FontSettingsModel */
    private $h3FontSettings;
    
    /** @var FontSettingsModel */
    private $h4FontSettings;
    
    /** @var FontSettingsModel */
    private $h5FontSettings;
    
    /** @var FontSettingsModel */
    private $h6FontSettings;

    /**
     * @return string
     */
    public function getMainColor(): string
    {
        return $this->mainColor;
    }

    /**
     * @param string $mainColor
     * @return ThemeOptionsModel
     */
    public function setMainColor(string $mainColor): ThemeOptionsModel
    {
        $this->mainColor = $mainColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryColor(): string
    {
        return $this->secondaryColor;
    }

    /**
     * @param string $secondaryColor
     * @return ThemeOptionsModel
     */
    public function setSecondaryColor(string $secondaryColor): ThemeOptionsModel
    {
        $this->secondaryColor = $secondaryColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getTertiaryColor(): string
    {
        return $this->tertiaryColor;
    }

    /**
     * @param string $tertiaryColor
     * @return ThemeOptionsModel
     */
    public function setTertiaryColor(string $tertiaryColor): ThemeOptionsModel
    {
        $this->tertiaryColor = $tertiaryColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeaderTitle(): string
    {
        return $this->headerTitle;
    }

    /**
     * @param string $headerTitle
     * @return ThemeOptionsModel
     */
    public function setHeaderTitle(string $headerTitle): ThemeOptionsModel
    {
        $this->headerTitle = $headerTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeaderSubtitle(): string
    {
        return $this->headerSubtitle;
    }

    /**
     * @param string $headerSubtitle
     * @return ThemeOptionsModel
     */
    public function setHeaderSubtitle(string $headerSubtitle): ThemeOptionsModel
    {
        $this->headerSubtitle = $headerSubtitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getFaviconImage(): string
    {
        return $this->faviconImage;
    }

    /**
     * @param string $faviconImage
     */
    public function setFaviconImage(string $faviconImage): void
    {
        $this->faviconImage = $faviconImage;
    }

    /**
     * @return string
     */
    public function getHeaderBackgroundImage(): string
    {
        return $this->headerBackgroundImage;
    }

    /**
     * @param string $headerBackgroundImage
     */
    public function setHeaderBackgroundImage(string $headerBackgroundImage): void
    {
        $this->headerBackgroundImage = $headerBackgroundImage;
    }

    /**
     * @return string
     */
    public function getHeaderLogo(): string
    {
        return $this->headerLogo;
    }

    /**
     * @param string $headerLogo
     */
    public function setHeaderLogo(string $headerLogo): void
    {
        $this->headerLogo = $headerLogo;
    }

    /**
     * @return string
     */
    public function getHeaderLogoOnScroll(): string
    {
        return $this->headerLogoOnScroll;
    }

    /**
     * @param string $headerLogoOnScroll
     * @return ThemeOptionsModel
     */
    public function setHeaderLogoOnScroll(string $headerLogoOnScroll): ThemeOptionsModel
    {
        $this->headerLogoOnScroll = $headerLogoOnScroll;
        return $this;
    }

    /**
     * @return string
     */
    public function getFooterCopyright(): string
    {
        return $this->footerCopyright;
    }

    /**
     * @param string $footerCopyright
     * @return ThemeOptionsModel
     */
    public function setFooterCopyright(string $footerCopyright): ThemeOptionsModel
    {
        $this->footerCopyright = $footerCopyright;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSolrEnabled(): bool
    {
        return $this->solrEnabled;
    }

    /**
     * @param bool $solrEnabled
     * @return ThemeOptionsModel
     */
    public function setSolrEnabled(string $solrEnabled): ThemeOptionsModel
    {
        $this->solrEnabled = $solrEnabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getZoomSolrRequest(): string
    {
        return $this->zoomSolrRequest;
    }

    /**
     * @param string $zoomSolrRequest
     * @return ThemeOptionsModel
     */
    public function setZoomSolrRequest(string $zoomSolrRequest): ThemeOptionsModel
    {
        $this->zoomSolrRequest = $zoomSolrRequest;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFacetEstampillageVisibility(): bool
    {
        return $this->facetEstampillageVisibility;
    }

    /**
     * @param bool $facetEstampillageVisibility
     */
    public function setFacetEstampillageVisibility(bool $facetEstampillageVisibility): void
    {
        $this->facetEstampillageVisibility = $facetEstampillageVisibility;
    }

    /**
     * @return bool
     */
    public function isFacetDisciplineVisibility(): bool
    {
        return $this->facetDisciplineVisibility;
    }

    /**
     * @param bool $facetDisciplineVisibility
     */
    public function setFacetDisciplineVisibility(bool $facetDisciplineVisibility): ThemeOptionsModel
    {
        $this->facetDisciplineVisibility = $facetDisciplineVisibility;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFacetNiveauVisibility(): bool
    {
        return $this->facetNiveauVisibility;
    }

    /**
     * @param bool $facetNiveauVisibility
     */
    public function setFacetNiveauVisibility(bool $facetNiveauVisibility): ThemeOptionsModel
    {
        $this->facetNiveauVisibility = $facetNiveauVisibility;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFacetTypeVisibility(): bool
    {
        return $this->facetTypeVisibility;
    }

    /**
     * @param bool $facetTypeVisibility
     */
    public function setFacetTypeVisibility(bool $facetTypeVisibility): ThemeOptionsModel
    {
        $this->facetTypeVisibility = $facetTypeVisibility;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFacetLangueVisibility(): bool
    {
        return $this->facetLangueVisibility;
    }

    /**
     * @param bool $facetLangueVisibility
     */
    public function setFacetLangueVisibility(bool $facetLangueVisibility): ThemeOptionsModel
    {
        $this->facetLangueVisibility = $facetLangueVisibility;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalSearchUrl(): string
    {
        return $this->externalSearchUrl;
    }

    /**
     * @param string $externalSearchUrl
     */
    public function setExternalSearchUrl(string $externalSearchUrl): void
    {
        $this->externalSearchUrl = $externalSearchUrl;
    }

    /**
     * @return bool
     */
    public function isRecommandationVisibility(): bool
    {
        return $this->recommandationVisibility;
    }

    /**
     * @param bool $recommandationVisibility
     */
    public function setRecommandationVisibility(bool $recommandationVisibility): ThemeOptionsModel
    {
        $this->recommandationVisibility = $recommandationVisibility;
        return $this;
    }

    /**
     * @return string
     */
    public function getMatomoScript(): string
    {
        return $this->matomoScript;
    }

    /**
     * @param string $matomoScript
     */
    public function setMatomoScript(string $matomoScript): void
    {
        $this->matomoScript = $matomoScript;
    }

    /**
     * @return string
     */
    public function getGfontsImports()
    {
        return $this->gfontsImports;
    }

    /**
     * @param string $gfontsImports
     */
    public function setGfontsImports(array $gfontsImports): ThemeOptionsModel
    {
        $this->gfontsImports = $gfontsImports;
        return $this;
    }

    /**
     * @return FontSettingsModel
     */
    public function getBaseFontSettings(): FontSettingsModel
    {
        return $this->baseFontSettings;
    }

    /**
     * @param FontSettingsModel $baseFontSettings
     * @return ThemeOptionsModel
     */
    public function setBaseFontSettings(FontSettingsModel $baseFontSettings): ThemeOptionsModel
    {
        $this->baseFontSettings = $baseFontSettings;
        return $this;
    }

    /**
     * @return FontSettingsModel
     */
    public function getH1FontSettings(): FontSettingsModel
    {
        return $this->h1FontSettings;
    }

    /**
     * @param FontSettingsModel $h1FontSettings
     * @return ThemeOptionsModel
     */
    public function setH1FontSettings(FontSettingsModel $h1FontSettings): ThemeOptionsModel
    {
        $this->h1FontSettings = $h1FontSettings;
        return $this;
    }

    /**
     * @return FontSettingsModel
     */
    public function getH2FontSettings(): FontSettingsModel
    {
        return $this->h2FontSettings;
    }

    /**
     * @param FontSettingsModel $h2FontSettings
     * @return ThemeOptionsModel
     */
    public function setH2FontSettings(FontSettingsModel $h2FontSettings): ThemeOptionsModel
    {
        $this->h2FontSettings = $h2FontSettings;
        return $this;
    }

    /**
     * @return FontSettingsModel
     */
    public function getH3FontSettings(): FontSettingsModel
    {
        return $this->h3FontSettings;
    }

    /**
     * @param FontSettingsModel $h3FontSettings
     * @return ThemeOptionsModel
     */
    public function setH3FontSettings(FontSettingsModel $h3FontSettings): ThemeOptionsModel
    {
        $this->h3FontSettings = $h3FontSettings;
        return $this;
    }

    /**
     * @return FontSettingsModel
     */
    public function getH4FontSettings(): FontSettingsModel
    {
        return $this->h4FontSettings;
    }

    /**
     * @param FontSettingsModel $h4FontSettings
     * @return ThemeOptionsModel
     */
    public function setH4FontSettings(FontSettingsModel $h4FontSettings): ThemeOptionsModel
    {
        $this->h4FontSettings = $h4FontSettings;
        return $this;
    }

    /**
     * @return FontSettingsModel
     */
    public function getH5FontSettings(): FontSettingsModel
    {
        return $this->h5FontSettings;
    }

    /**
     * @param FontSettingsModel $h5FontSettings
     * @return ThemeOptionsModel
     */
    public function setH5FontSettings(FontSettingsModel $h5FontSettings): ThemeOptionsModel
    {
        $this->h5FontSettings = $h5FontSettings;
        return $this;
    }

    /**
     * @return FontSettingsModel
     */
    public function getH6FontSettings(): FontSettingsModel
    {
        return $this->h6FontSettings;
    }

    /**
     * @param FontSettingsModel $h6FontSettings
     * @return ThemeOptionsModel
     */
    public function setH6FontSettings(FontSettingsModel $h6FontSettings): ThemeOptionsModel
    {
        $this->h6FontSettings = $h6FontSettings;
        return $this;
    }

}