$(document).ready(function() {
    var imgHeight =  $('#notice-img').height();
    var descriptionHeight = $('#notice-description').height();
    var uuid = getURLParam('uuid');

    metadataNoticeObject.id = uuid;
    if (metadataNoticeObject.id) {
        metadataNoticeObject.titre = $.trim($("#notice-titre").text());
        metadataNoticeObject.description = $("#notice-description").text();
        metadataNoticeObject.lienRessource = extractLink($("#notice-link_ressource").attr("href"));
        metadataNoticeObject.urlVignette = extractLink($("#notice-img-value").attr("src"));
        metadataNoticeObject.dateCreation = $.trim($("#notice-dateCreation").text());
        metadataNoticeObject.etablissementPorteur = $.trim($("#notice-etablissementPorteurLibelle").text());
        metadataNoticeObject.urlSumplomfr = extractLink($("#notice-suplom").attr("href"));
        metadataNoticeObject.auteurs = extractListValues($("#notice-auteurs-list").html());
        metadataNoticeObject.typesPedagogiques = extractListValues($("#notice-typesPedagogiques").html());
        metadataNoticeObject.niveaux = extractListValues($("#notice-niveaux").html());
        metadataNoticeObject.objectifsPedagogiques = extractHtmlListValues($("#notice-objectifsPedagogiques li"));
        metadataNoticeObject.activitesInduites = extractListValues($("#notice-activitesInduites").html());
        metadataNoticeObject.dureeApprentissage = extractListValues($("#notice-dureeApprentissage").html());
        metadataNoticeObject.languesUtilisateur = extractListValues($("#notice-languesUtilisateur").html());
        metadataNoticeObject.etablissementsCoEditeurs = extractListValues($("#notice-etablissementsCoEditeurs").html());
        metadataNoticeObject.motsCles = extractHtmlListValues($("#notice-motCle a"));
        metadataNoticeObject.domaines = extractHtmlListValues($("#notice-discipline a"));

        // Champs n'existant plus sur le nouveau site
        /*
        * metadataNoticeObject.structure = $.trim($("#notice-structure").text());
        * metadataNoticeObject.langueRessource = extractListValues($("#notice-languesRessource span"));
        * metadataNoticeObject.datePublication = $.trim($("#notice-datePublication").text());
        * metadataNoticeObject.contributeurs = extractListObjectValues($("#notice-contributeurs .notice-contributeur"),{"role":".notice-contributeurRole","name":".notice-contributeurName"});
        * metadataNoticeObject.typeDocumentaire = extractListValues($("#notice-typeDocumentaires .notice-typeDocumentaire"));
        * */

        metadataNotice = JSON.stringify(metadataNoticeObject);
        // Gestion des recommandations
        Sailsense.identify();
        var location = "product-ressourcefooter";
        var params = {};
        params._id = metadataNoticeObject.id;

        Sailsense.recommend(location, params, function(recommendations){
            displaySailsenseRecommendations(recommendations, location);
        });
        //Suivi des actions de navigation
        SailsenseUNT.setNoticeEventListeners();
    }

    if (descriptionHeight > imgHeight) {
        $('#notice-description').css('height', imgHeight  + "px");
        masquerSuite();
    } else {
        $('#notice-lire-la-suite').removeClass('notice-lire-la-suite');
    }

    function getURLParam(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null) {
            return null;
        }
        else {
            return decodeURI(results[1]);
        }
    }

    function montrerSuite() {
        $('#notice-description').css('height', descriptionHeight + "px");
        $('#notice-lire-la-suite').empty();
        $('#notice-lire-la-suite').append("<a id=\"lien-masquer-la-suite\">Masquer la description <i class=\"fa fa-angle-up\" aria-hidden=\"true\"></i></a>");
        $('#notice-lire-la-suite').css('background-image', 'none');
        $('#lien-masquer-la-suite').on('click', function(){
            masquerSuite();
        });
    }

    function masquerSuite() {
        var imgHeight = $('#notice-img').height();
        $('#notice-description').css('height', imgHeight.toString() + "px");
        $('#notice-lire-la-suite').empty();
        $('#notice-lire-la-suite').append("<a id=\"lien-lire-la-suite\">Lire la suite <i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i></a>");
        $('#notice-lire-la-suite').css('background-image', 'linear-gradient(transparent, #F2F2F2 75%, #F2F2F2)');
        $('#lien-lire-la-suite').on('click', function() {
            montrerSuite();
        });
    }

    function extractLink($link){
        if ($link.indexOf("/") == 0) {
            if (!window.location.origin) {
                window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
            }
            return window.location.origin + $link;
        }
        else {
            return $link;
        }
    }

    function extractListValues($datas) {
        if ($datas !== undefined) {
            return $datas.split(", ");
        }
        return [];
    }

    function extractHtmlListValues($datas) {
        var result = [];
        if ($datas !== undefined) {
            $($datas).each(function() {
                result.push($(this).html());
            });
        }
        return result;
    }
});
