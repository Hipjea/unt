$(document).ready(function(){
	$('#search-navbar').on('focus', function() {
		$('#search-navbar')[0].scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
	});

	var $searchWrapper = $('#search-wrapper');
	var solrEnabled = $searchWrapper.data('solrEnabled');
	var externalSearchUrl = $searchWrapper.data('externalSearchUrl');
	
	// Solr autocomplete
	if (solrEnabled) {
		$('#search-navbar').on('input',function() {
			var query = $('#search-navbar').val().toLowerCase();
			if(query.length > 1) {
				$.ajax({
					url: encodeURI(untConfig.siteLink + "/wp-json/app/v1/autocomp/"+query),
				}).done(function( data ) {
					var res = [];
					var docs = data.docs;
					for (var doc in docs) {
						res.push(docs[doc].pref_label);
					}
					$('#search-navbar').autocomplete({
						source: res,
						open: function() {
							$("#search-navbar").autocomplete("widget").css("width",($('#search-navbar').width() + 25) + "px");
						}
					});
					$('.ui-helper-hidden-accessible').remove();
				});
			}
		});
	}

    $('#launch-search-btn').on('click', function() {
        search();
    });

    $('#search-navbar').on('keypress',function(e) {
        if(e.which == 13) {
            search();
        }
    });

    function search() {
		let query = encodeURI($('#search-navbar').val());
		let lang = getURLParam('lang');
		if(lang == null) {
			lang = 'fr';
		}
		let sort = "score";
		if(query.trim().length == 0) {
			sort="date_publication"
		}
		let url;
    	if (solrEnabled) {
    		let page = "/resultats"+lang;
    		let baseUrl = untConfig.siteLink.split('?')[0];
    		url = baseUrl+page+"?lang="+lang+"&pagination=1&sort="+sort+"&query="+query;
    	} else {
    		let params = {"%q%":query, "%lang%": lang, "%sort%": sort};
	    	url = externalSearchUrl.replace(/%\w+%/g, function(arg) {
	    	   return params[arg] || arg;
	    	});
    	}
        window.location.href = url;
    }

    function getURLParam(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null){
            return null;
        }
        else {
            return decodeURI(results[1]);
        }
    }
});