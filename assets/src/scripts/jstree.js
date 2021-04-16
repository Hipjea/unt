$(document).ready(function(){
    let baseUrl = untConfig.siteLink.split('?')[0]+ "/resultats";
    $(function() {

        $('#estampillage-tree').jstree({
            "checkbox": { "three_state": false },
            "plugins" : ["checkbox"],
            "core" : {
                "themes" : {
                    "icons":false,
                    "dots": false
                }
            }
        }).on('ready.jstree', function() {
            $('#estampillage-tree .isSelected').each(function () {
                $('#estampillage-tree').jstree().check_node($(this)[0].id);
            });
            $("#estampillage-tree").bind("changed.jstree", function (e, data) {
                if(data.action == "select_node" || data.action == "deselect_node") {
                    $facetteValue = $('#'+data.node.id).data('facette');
                    $newurl = getNewUrl("estampillage", $facetteValue);
                    window.location.href = $newUrl;
                }
            });
        });

        $('#discipline-tree').jstree({
            "checkbox": { "three_state": false },
            "plugins" : ["checkbox"],
            "core" : {
                "themes" : {
                    "icons":false,
                    "dots": false
                }
            }
        }).on('ready.jstree', function() {
            $('#discipline-tree').jstree('open_all');
            $('#discipline-tree .isSelected').each(function () {
                $('#discipline-tree').jstree().check_node($(this)[0].id);
            });
            $('#discipline-tree .jstree-node').each(function () {
                $selectedChilden = $(this).find(".isSelected");
                if($selectedChilden == null || $selectedChilden.length == 0) {
                    $('#discipline-tree .jstree-node').jstree().close_node($(this)[0].id);;
                }
            });
            $("#discipline-tree").bind("changed.jstree", function (e, data) {
                if(data.action == "select_node" || data.action == "deselect_node") {
                    $facetteValue = $('#'+data.node.id).data('facette');
                    $newurl = getNewUrl("discipline_facet", $facetteValue);
                    window.location.href = $newUrl;
                }
            });
        });

        $('#niveau-tree').jstree({
            "checkbox": { "three_state": false },
            "plugins" : ["checkbox"],
            "core" : {
                "themes" : {
                    "icons":false,
                    "dots": false
                }
            }
        }).on('ready.jstree', function() {
            $('#niveau-tree .isSelected').each(function () {
                $('#niveau-tree').jstree().check_node($(this)[0].id);
            });
            $("#niveau-tree").bind("changed.jstree", function (e, data) {
                if(data.action == "select_node" || data.action == "deselect_node") {
                    $facetteValue = $('#'+data.node.id).data('facette');
                    $newurl = getNewUrl("niveaux_facet", $facetteValue);
                    window.location.href = $newUrl;
                }
            });
        });

        $('#type-ressource-tree').jstree({
            "checkbox": { "three_state": false },
            "plugins" : ["checkbox"],
            "core" : {
                "themes" : {
                    "icons":false,
                    "dots": false
                }
            }
        }).on('ready.jstree', function() {
            $('#type-ressource-tree .isSelected').each(function () {
                $('#type-ressource-tree').jstree().check_node($(this)[0].id);
            });
            $("#type-ressource-tree").bind("changed.jstree", function (e, data) {
                if(data.action == "select_node" || data.action == "deselect_node") {
                    $facetteValue = $('#'+data.node.id).data('facette');
                    $newurl = getNewUrl("types_pedagogiques_facet", $facetteValue);
                    window.location.href = $newUrl;
                }
            });
        });
    });

    $('.tree-title').on( "click", function() {
        $arrow = $(this).find('i');
        if($arrow.hasClass('fa-sort-up')) {
            $arrow.removeClass('fa-sort-up');
            $arrow.addClass('fa-sort-down');
        } else {
            $arrow.removeClass('fa-sort-dpwn');
            $arrow.addClass('fa-sort-up');
        }
    });

    $('.remove-facette-btn').on( "click", function() {
        $facetteName = $( this ).data('facettename');
        $facetteValue = $( this ).data('facettevalue');
        $newurl = getNewUrl($facetteName, $facetteValue);
        window.location.href = $newUrl;
    });

    $(".link-tri").on('click', function() {
        $newTri = $( this ).data('newtri');
        $query = getURLParam('query');
        if($query == null) {
            $query = '';
        }
        $pagination = 1;
        $sort = $newTri;
        $facettes = getURLParam('facettes');
        $lang = getURLParam('lang');
        if($lang != null && $lang !== 'fr') {
            $lang = 'lang='+$lang+"&";
        } else {
            $lang = '';
        }
        $newUrl = baseUrl + $lang + "?"+$lang+"query=" + $query + "&pagination=" + $pagination + "&sort=" + $sort;
        if($facettes !== null) {
            $newUrl = $newUrl+"&facettes="+$facettes;
        }
        window.location.replace($newUrl);
    });

    $(".link-pagination").on('click', function() {
        $newPage = $( this ).data('newpage');
        $query = getURLParam('query');
        if($query == null) {
            $query = '';
        }
        $pagination = $newPage;
        $sort = getURLParam('sort');
        if($sort == null) {
            $sort = 'score';
        }
        $facettes = getURLParam('facettes');

        $lang = getURLParam('lang');
        if($lang != null && $lang !== 'fr') {
            $lang = 'lang='+$lang+"&";
        } else {
            $lang = '';
        }
        $newUrl = baseUrl + $lang + "?"+$lang+"query=" + $query + "&pagination=" + $pagination + "&sort=" + $sort;
        if($facettes !== null) {
            $newUrl = $newUrl+"&facettes="+$facettes;
        }
        window.location.replace($newUrl);
    });

    function getNewUrl($facetteName, $facetteValue) {
        $query = getURLParam('query');
        if($query == null) {
            $query = '';
        }
        $pagination = 1;
        $sort = getURLParam('sort');
        if($sort == null) {
            $sort = 'score';
        }
        $facettes = getURLParam('facettes');
        $lang = getURLParam('lang');
        if($lang != null && $lang !== 'fr') {
            $lang = 'lang='+$lang+"&";
        } else {
            $lang = '';
        }
        $newUrl = baseUrl + $lang + "?"+$lang+"query=" + $query + "&pagination=" + $pagination + "&sort=" + $sort;
        if($facettes === null || $facettes === "" || !$facettes) {
            $facettes = [
                {
                    "name": $facetteName,
                    "value": [$facetteValue]
                }
            ];
        } else {
            $facettes = JSON.parse(b64DecodeUnicode(decodeURIComponent($facettes)));
            $exist = false;
            if($facetteName === "estampillage" || $facetteName === "etablissement_porteur") {
                $index = -1;
                $facettes.forEach(function(facette, i) {
                    if(facette.name === $facetteName) {
                        $index = i;
                    }
                });
                if($index === -1) {
                    $facettes.push(
                        {
                            "name": $facetteName,
                            "value": [$facetteValue]
                        }
                    );
                } else {
                    $facettes.splice($index, 1);
                }

            } else {
                $facettes.forEach(function(facette) {
                    if(facette.name === $facetteName) {
                        $exist = true;
                        if(facette.value.includes($facetteValue)) {
                            facette.value.splice(facette.value.indexOf($facetteValue), 1);
                        } else {
                            facette.value.push($facetteValue);
                        }
                    }
                });

                if(!$exist) {
                    $facettes.push(
                        {
                            "name": $facetteName,
                            "value": [$facetteValue]
                        }
                    );
                }
            }
        }
        $facettes = cleanFacettes($facettes);
        if($facettes.length !== 0) {
            $facettes = Buffer.from(JSON.stringify($facettes)).toString("base64");
            $newUrl = $newUrl + "&facettes=" + $facettes;
        }
        return $newUrl;
    }

    function cleanFacettes(facettes){
        $newFacettes = [];
        facettes.forEach(function(facette) {
            if(facette.value.length !== 0) {
                $newFacettes.push(facette);
            }
        });

        return $newFacettes;
    }

    function getURLParam(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results === null || results.length === 0){
            return null;
        }
        else {
            return decodeURI(results[1]);
        }
    }

    function b64DecodeUnicode(str) {
        // Going backwards: from bytestream, to percent-encoding, to original string.
        return decodeURIComponent(atob(str).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    }
});
