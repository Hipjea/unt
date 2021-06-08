<?php

namespace Unt\Managers;

use Unt\Models\ThemeOptionsModel;
use Unt\Services\AssetService;

class CustomizeManager
{
    /** @var AssetService */
    private $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
        add_action('customize_register', [$this, 'customizeRegister']);
        add_action('customize_preview_init', [$this, 'enqueueCustomizePreviewJs'] );
    }

    public function enqueueCustomizePreviewJs() {
        $src = $this->assetService->getUri() . '/scripts/customize-preview.js';
        wp_enqueue_script('unt-customize-preview', $src, ['customize-preview'], '', true);
    }

    public function customizeRegister(\WP_Customize_Manager $wp_customize){

        $wp_customize->add_section('unt_themes', [
            'title'      => __('Paramètres du Thème', 'unt'),
            'priority'   => 30,
        ]);

        $this->controlMainColor($wp_customize);
        $this->controlSecondaryColor($wp_customize);
        $this->controlTertiaryColor($wp_customize);
        $this->controlTitleMainColor($wp_customize);
        $this->controlTitleSecColor($wp_customize);
        $this->controlHeaderTitle($wp_customize);
        $this->controlHeaderSubTitle($wp_customize);
        $this->controlFaviconImage($wp_customize);
        $this->controlHeaderBackgroundImage($wp_customize);
        $this->controlHeaderLogo($wp_customize);
        $this->controlHeaderLogoOnScroll($wp_customize);
        $this->controlFooterCopyright($wp_customize);
        $this->controlSolrEnabled($wp_customize);
        $this->controlZoomSolrRequest($wp_customize);
        $this->controlFacetDiciplineVisibility($wp_customize);
        $this->controlFacetNiveauVisibility($wp_customize);
        $this->controlFacetTypeVisibility($wp_customize);
        $this->controlFacetEstampillageVisibility($wp_customize);
        $this->controlExternalSearchUrl($wp_customize);
        $this->controlRecommandationVisibility($wp_customize);
        $this->controlMatomoScript($wp_customize);
    }

    public function controlMainColor(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[main-color]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[main-color]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'unt_theme[main-color]',
                array(
                    'label'      => __( 'Couleur principale', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[main-color]',
                ) )
        );
    }

    public function controlSecondaryColor(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[secondary-color]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[secondary-color]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'unt_theme[secondary-color]',
                array(
                    'label'      => __( 'Couleur secondaire', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[secondary-color]',
                ) )
        );
    }

    public function controlTertiaryColor(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[tertiary-color]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[tertiary-color]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'unt_theme[tertiary-color]',
                array(
                    'label'      => __( 'Couleur tertiaire', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[tertiary-color]',
                ) )
        );
    }

    public function controlTitleMainColor(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[title-main-color]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[title-main-color]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'unt_theme[title-main-color]',
                array(
                    'label'      => __( 'Couleur des titres principaux', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[title-main-color]',
                ) )
        );
    }

    public function controlTitleSecColor(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[title-sec-color]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[title-sec-color]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'unt_theme[title-sec-color]',
                array(
                    'label'      => __( 'Couleur des titres secondaires', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[title-sec-color]',
                ) )
        );
    }

    public function controlHeaderTitle(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[header-title]', [
            'default'        => 'L\'UNIVERSITÉ NUMERIQUE',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[header-title]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_header_title', [
            'label'      => __('Entête : Titre principal', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[header-title]',
        ]);
    }

    public function controlHeaderSubTitle(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[header-sub-title]', [
            'default'        => 'Des ressources pour l\'enseignement supérieur',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[header-sub-title]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_header_subtitle', [
            'label'      => __('Entête : Sous titre', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[header-sub-title]',
        ]);
    }

    public function controlFaviconImage(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[favicon-image]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[favicon-image]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Image_Control(
                $wp_customize,
                'unt_theme[favicon-image]',
                [
                    'label'      => __( 'Onglet de navigateur : Icon', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[favicon-image]',
                ]
            )
        );
    }

    public function controlHeaderBackgroundImage(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[header-bg-image]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[header-bg-image]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Image_Control(
                $wp_customize,
                'unt_theme[header-bg-image]',
                [
                    'label'      => __( 'Entête : Image de fond', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[header-bg-image]',
                ]
            )
        );
    }

    public function controlHeaderLogo(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[header-logo]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[header-logo]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Image_Control(
                $wp_customize,
                'unt_theme[header-logo]',
                [
                    'label'      => __( 'Entête : Logo', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[header-logo]',
                ]
            )
        );
    }

    public function controlHeaderLogoOnScroll(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[header-logo-scroll]', [
            'default'        => '',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[header-logo-scroll]' )->transport = 'postMessage';

        $wp_customize->add_control(
            new \WP_Customize_Image_Control(
                $wp_customize,
                'unt_theme[header-logo-scroll]',
                [
                    'label'      => __( 'Entête : Logo (on scroll)', 'unt' ),
                    'section'    => 'unt_themes',
                    'settings'   => 'unt_theme[header-logo-scroll]',
                ]
            )
        );
    }

    public function controlFooterCopyright(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[footer-copyright]', [
            'default'        => 'Copyright UNT - tous droits réservés',
            'capability'     => 'edit_theme_options',
        ]);
        $wp_customize->get_setting( 'unt_theme[footer-copyright]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_footer_copyright', [
            'label'      => __('Pied de page : Copyright', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[footer-copyright]',
        ]);
    }

    public function controlSolrEnabled(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[solr-enabled]', [
            'default'        => true,
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[solr-enabled]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_solr_enabled', [
            'label'      => __('Utiliser le moteur de recherche SOLR', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[solr-enabled]',
            'type'       => 'checkbox'
        ]);
    }

    public function controlZoomSolrRequest(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[zoom-solr-request]', [
            'default'        => '',
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[zoom-solr-request]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_zoom_solr_request', [
            'label'      => __('Zoom sur : requête Solr', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[zoom-solr-request]'
        ]);
    }

    public function controlFacetDiciplineVisibility(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[facet-discipline-visibility]', [
            'default'        => true,
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[facet-discipline-visibility]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_facet_discipline_visibility', [
            'label'      => __('Affichage de la facette discipline', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[facet-discipline-visibility]',
            'type'       => 'checkbox'
        ]);
    }

    public function controlFacetNiveauVisibility(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[facet-niveau-visibility]', [
            'default'        => true,
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[facet-niveau-visibility]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_facet_niveau_visibility', [
            'label'      => __('Affichage de la facette niveaux', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[facet-niveau-visibility]',
            'type'       => 'checkbox'
        ]);
    }

    public function controlFacetTypeVisibility(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[facet-type-visibility]', [
            'default'        => true,
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[facet-type-visibility]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_facet_type_visibility', [
            'label'      => __('Affichage de la facette type de ressource', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[facet-type-visibility]',
            'type'       => 'checkbox'
        ]);
    }

    public function controlFacetEstampillageVisibility(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[facet-estampillage-visibility]', [
            'default'        => true,
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[facet-estampillage-visibility]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_facet_estampillage_visibility', [
            'label'      => __('Affichage de la facette estampillage', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[facet-estampillage-visibility]',
            'type'       => 'checkbox'
        ]);
    }

    public function controlExternalSearchUrl(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[external-search-url]', [
            'default'        => '',
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[external-search-url]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_external_search_url', [
            'label'      => __('Adresse du service de recherche externe', 'unt'),
            'description'=> __('L\'adresse peut contenir des paramètres qui seront remplacés à la recherche : %q% par les mots-clés entrés par l\'utilisateur, %lang% par la langue de l\'utilisateur, %sort% par le tri', 'unt'),
            'input_attrs' => array(
	            'placeholder' => 'http://my-site.com/search?request=%q%',
	        ),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[external-search-url]'
        ]);
    }

    public function controlRecommandationVisibility(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[recommandation-visibility]', [
            'default'        => true,
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[recommandation-visibility]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_recommandation_visibility', [
            'label'      => __('Affichage des recommandations', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[recommandation-visibility]',
            'type'       => 'checkbox'
        ]);
    }
    
    public function controlMatomoScript(\WP_Customize_Manager $wp_customize) {
        $wp_customize->add_setting('unt_theme[matomo-script]', [
            'default'        => '',
            'capability'     => 'edit_theme_options'
        ]);
        $wp_customize->get_setting( 'unt_theme[matomo-script]' )->transport = 'postMessage';

        $wp_customize->add_control('unt_matomo_script', [
            'label'      => __('Script Matomo', 'unt'),
            'section'    => 'unt_themes',
            'settings'   => 'unt_theme[matomo-script]'
        ]);
    }

    /**
     * @return ThemeOptionsModel
     */
    public function getThemeOptions(): ThemeOptionsModel
    {
        $options = get_theme_mod('unt_theme');

        $model = new ThemeOptionsModel();
        if (isset($options['main-color'])) {
            $model->setMainColor($options['main-color']);
        }
        if (isset($options['secondary-color'])) {
            $model->setSecondaryColor($options['secondary-color']);
        }
        if (isset($options['tertiary-color'])) {
            $model->setTertiaryColor($options['tertiary-color']);
        }
        if (isset($options['header-title'])) {
            $model->setHeaderTitle($options['header-title']);
        }
        if (isset($options['header-sub-title'])) {
            $model->setHeaderSubtitle($options['header-sub-title']);
        }
        if (isset($options['favicon-image'])) {
            $model->setFaviconImage($options['favicon-image']);
        }
        if (isset($options['header-bg-image'])) {
            $model->setHeaderBackgroundImage($options['header-bg-image']);
        }
        if (isset($options['header-logo'])) {
            $model->setHeaderLogo($options['header-logo']);
        }
        if (isset($options['header-logo-scroll'])) {
            $model->setHeaderLogoOnScroll($options['header-logo-scroll']);
        }
        if (isset($options['footer-copyright'])) {
            $model->setFooterCopyright($options['footer-copyright']);
        }
        if (isset($options['solr-enabled'])) {
            $model->setSolrEnabled($options['solr-enabled']);
        }
        if (isset($options['zoom-solr-request'])) {
            $model->setZoomSolrRequest($options['zoom-solr-request']);
        }
        if (isset($options['facet-discipline-visibility'])) {
            $model->setFacetDisciplineVisibility($options['facet-discipline-visibility']);
        }
        if (isset($options['facet-niveau-visibility'])) {
            $model->setFacetNiveauVisibility($options['facet-niveau-visibility']);
        }
        if (isset($options['facet-type-visibility'])) {
            $model->setFacetTypeVisibility($options['facet-type-visibility']);
        }
        if (isset($options['facet-estampillage-visibility'])) {
            $model->setFacetLangueVisibility($options['facet-estampillage-visibility']);
        }
        if (isset($options['external-search-url'])) {
            $model->setExternalSearchUrl($options['external-search-url']);
        }
        if (isset($options['recommandation-visibility'])) {
            $model->setRecommandationVisibility($options['recommandation-visibility']);
        }
        if (isset($options['matomo-script'])) {
            $model->setMatomoScript($options['matomo-script']);
        }

        return $model;
    }

}