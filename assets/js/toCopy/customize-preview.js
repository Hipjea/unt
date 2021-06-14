/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var WebFont = require('webfontloader');

(function($) {
	// Header Title
	wp.customize( 'unt_theme[header-title]', function( value ) {
		value.bind( function( to ) {
			$('#header-title').html(to);
		});
	});

	// Header sub Title
	wp.customize( 'unt_theme[header-sub-title]', function( value ) {
		value.bind( function( to ) {
			$('#header-sub-title').html(to);
		});
	});

	// Header Background Image
	wp.customize( 'unt_theme[header-bg-image]', function( value ) {
		value.bind( function( to ) {
			$('#home-header').css('background', 'url('+ to +') no-repeat top');
		});
	});

	// Header Logo
	wp.customize( 'unt_theme[header-logo]', function( value ) {
		value.bind( function( to ) {
			$('#logo-header-menu').prop('src', to);
		});
	});

	// Header Logo on scroll
	wp.customize( 'unt_theme[header-logo-scroll]', function( value ) {
		value.bind( function( to ) {
			$('.menu-header.cloned').find('#logo-header-menu').prop('src', to);
		});
	});

	// Header sub Title
	wp.customize( 'unt_theme[footer-copyright]', function( value ) {
		value.bind( function( to ) {
			$('#footer-copyright').html(to);
		});
	});

	// Zoom Solr request
    wp.customize( 'unt_theme[zoom-solr-request]', function( value ) {
        value.bind( function( to ) {
            // Update JS request
            var script = $('#zoom-sur-carousel-inner'),
                zoomSolrQuery = script.data( 'zoom-solr-request' ),
                js = script.html();

            js = js.replace(zoomSolrQuery, to);
            script.html( js ).data( 'zoom-solr-request', to );
        });
    });
    
    // Show Solr settings only if Solr is enabled
    var solrEnabled;
    var externalSearchUrl;
    wp.customize( 'unt_theme[solr-enabled]', function ( solr_enabled_setting) { 
    	solrEnabled = solr_enabled_setting.get();
    	setTimeout(function() {
    		showOrHideSolrFields();
    	}, 3000);
    	solr_enabled_setting.bind( function ( updated_value_of_solr_enabled_setting) {
    		solrEnabled = updated_value_of_solr_enabled_setting;
    		showOrHideSolrFields();
    	});
    });
    wp.customize( 'unt_theme[external-search-url]', function ( external_search_url_setting) { 
    	externalSearchUrl = external_search_url_setting.get();
    	external_search_url_setting.bind( function ( updated_value_of_external_search_url_setting) {
    		externalSearchUrl = updated_value_of_external_search_url_setting;
    		showOrHideSolrFields();
    	});
    });
    
    function showOrHideSolrFields() {
    	// Search: solr
		$.each(['unt_zoom_solr_request', 'unt_facet_discipline_visibility', 'unt_facet_niveau_visibility', 
			'unt_facet_type_visibility', 'unt_facet_estampillage_visibility'], function(i, controlId) {
			if (solrEnabled) {
				parent.wp.customize.control(controlId).activate();
			} else {
				parent.wp.customize.control(controlId).deactivate();
			}
		});
		// Search: external
		$.each(['unt_external_search_url'], function(i, controlId) {
			if (solrEnabled) {
				parent.wp.customize.control(controlId).deactivate();
			} else {
				parent.wp.customize.control(controlId).activate();
			}
		});
		$('.a-la-une-wrapper').toggle(solrEnabled);
		$('.research').toggle(solrEnabled || (externalSearchUrl && externalSearchUrl.trim() != ''));
    }

	// Google imports
	wp.customize( 'uoh_theme[gfonts-imports]', function( value ) {
		value.bind( function( to ) {
			var googleFonts = to ? to.replace(/\r/g, "").split(/\n/) : [];
			try {
				WebFont.load({
					google: {
						families: googleFonts
					}
				});
			} catch (e) {
				console.dir(e);
			}
		});
	});
	
	// Fonts settings
	var stylesheet = document.styleSheets[document.styleSheets.length - 1];
	var rulesIndexMap = {};
	$.each(['base', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'], function(idx, prefix) {
		var settingFontFamily = 'uoh_theme[' + prefix + '-fontfamily]';
		var settingColor = 'uoh_theme[' + prefix + '-color]';
		var settingFontSize = 'uoh_theme[' + prefix + '-fontsize]';
		var settingLineHeight = 'uoh_theme[' + prefix + '-lineheight]';
		
		var selector = prefix === 'base' ? '.content-wrapper' : prefix;
		
		wp.customize( settingFontFamily, function( value ) {
			value.bind( function( to ) {
				bindFontRuleChange(stylesheet, rulesIndexMap, settingFontFamily, selector, to, 'font-family');
			});
		});
		wp.customize( settingColor, function( value ) {
			value.bind( function( to ) {
				bindFontRuleChange(stylesheet, rulesIndexMap, settingColor, selector, to, 'color');
			});
		});
		wp.customize( settingFontSize, function( value ) {
			value.bind( function( to ) {
				bindFontRuleChange(stylesheet, rulesIndexMap, settingFontSize, selector, to, 'font-size');
			});
		});
		wp.customize( settingLineHeight, function( value ) {
			value.bind( function( to ) {
				bindFontRuleChange(stylesheet, rulesIndexMap, settingLineHeight, selector, to, 'line-height');
			});
		});
	});

})(jQuery);


function bindFontRuleChange(stylesheet, rulesIndexMap, setting, selector, cssValue, cssRule) {
	$.each(stylesheet.rules, function(idx, rule) {
		if (rule.selectorText === selector && rule.cssText.indexOf(cssRule) > 0) {
			stylesheet.deleteRule(idx);
			console.dir('removed rule : ' + idx);
			return false;
		}
	});
	if (cssValue) {
		rulesIndexMap[setting] = stylesheet.insertRule(selector + ' { ' + cssRule + ': ' + cssValue + '; }');
	} else {
		rulesIndexMap[setting] = -1;
	}
}
