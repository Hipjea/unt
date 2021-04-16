<?php

namespace Unt\Models;

class ThemeOptionsModel
{
    /** @var string */
    private $mainColor = "";

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

}