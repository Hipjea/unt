<?php

namespace Unt\Services;

use Unt\Models\NoticeModel;

class SolrService
{
    /** @var string */
    private $solrUrl = SOLR_URL;

    /** @var string */
    private $noticeIndex = NOTICE_INDEX;
    /** @var string */
    private $autocompIndex = AUTOCOMPLETE_INDEX;

    /**
     * @return string
     */
    public function getSolrUrl(): string
    {
        return $this->solrUrl;
    }

    /**
     * @return string
     */
    public function getNoticeIndex(): string
    {
        return $this->noticeIndex;
    }

    /**
     * @return string
     */
    public function getAutocompIndex(): string
    {
        return $this->autocompIndex;
    }

    public function automplete(string $query) : ?object {
        $staticUrlParam = "q=".$query."*&rows=10&wt=json&fq=type:AUTEUR_UNT";
        $solrResults = wp_remote_get($this->solrUrl."/".$this->autocompIndex."/select/?".$staticUrlParam);
        $httpResponse = $solrResults['http_response']->to_array();
        $results = json_decode($httpResponse['body']);
        if(isset($results)) {
            return $results->{'response'};
        } else {
            return null;
        }
    }

    public function getFacettes($query, $filtres) : object
    {
        $staticUrlParam = "q=".$query."&start=0&rows=1&wt=json&indent=on&facet=true&facet.mincount=1&facet.limit=-1";
        $staticUrlParam = $staticUrlParam."&facet.field=niveaux_facet&facet.field=estampillage";
        $staticUrlParam = $staticUrlParam."&facet.field=types_pedagogiques_facet";
        $staticUrlParam = $staticUrlParam."&facet.field=discipline_facet&f.discipline_facet.facet.sort=index";

        $dynamicUrlParam = self::getFiltresInQuery($filtres);

        $solrResults = wp_remote_get($this->solrUrl."/".$this->noticeIndex."/select/?".$staticUrlParam.$dynamicUrlParam);
        $httpResponse = $solrResults['http_response']->to_array();
        $results = json_decode($httpResponse['body'])->{'facet_counts'};
        return $results;
    }

    public function getNoticeDetail($uuid) : ?object
    {
        $staticUrlParam = "wt=json&qt=standard&q=uuid:".$uuid."&fq=uuid:".$uuid;
        $solrResult = wp_remote_get($this->solrUrl."/".$this->noticeIndex."/select/?".$staticUrlParam);
        $httpResponse = $solrResult['http_response']->to_array();
        $responses = json_decode($httpResponse['body']);
        if(isset($responses->{'response'}) && isset($responses->{'response'}->{'docs'}) && !empty (json_decode($httpResponse['body'])->{'response'}->{'docs'})) {
            $notice = json_decode($httpResponse['body'])->{'response'}->{'docs'}[0];
            return $notice;
        } else {
            return null;
        }
    }

    public function getNoticesDetail($uuids) : ?array
    {
        if(isset($uuids)) {
            $joinsUuids = urlencode("uuid:".join(" OR uuid:",$uuids));
            $staticUrlParam = "wt=json&qt=standard&q=".$joinsUuids."&fq=".$joinsUuids;
            $solrResult = wp_remote_get($this->solrUrl."/".$this->noticeIndex."/select/?".$staticUrlParam);
            $httpResponse = $solrResult['http_response']->to_array();
            $notices = json_decode($httpResponse['body'])->{'response'}->{'docs'};
            return $notices;
        }
        return null;
    }

    /**
     * @param $query
     * @param $rows
     * @param $start
     * @param $nbMotCle
     * @param $filtres format name - value
     * @return array
     */
    public function getResults($query, $start, $filtres, $sort) : ?object
    {
        // Début d'un terme surligné Solr.
        $SOLR_HL_TAG_BEGIN = ":solr.hl:";
        // Fin d'un terme surligné Solr.
        $SOLR_HL_TAG_END = ":/solr.hl:";

        // Variable a passer en config
        $rows = 9;
        $descriptionTruncature = 250;

        $staticUrlParam = "&rows=".$rows."&wt=json&start=".$start;

        $staticUrlParam = $staticUrlParam."&spellcheck=true&spellcheck.collate=true";

        $staticUrlParam = $staticUrlParam."&hl=true&hl.fl=titre,description_text&hl.mergeContiguous=true&hl.simple.pre=".$SOLR_HL_TAG_BEGIN."&hl.simple.post=".$SOLR_HL_TAG_END;
        $staticUrlParam = $staticUrlParam."&hl.fragsize=".$descriptionTruncature;

        $dynamicUrlParam = self::getFiltresInQuery($filtres);
        if(isset($sort)) {
            $dynamicUrlParam = $dynamicUrlParam."&sort=".$sort."%20desc";
        }

        $queryUrl = "q=".$query.$staticUrlParam.$dynamicUrlParam;

        $solrResults = wp_remote_get($this->solrUrl."/".$this->noticeIndex."/select/?".$queryUrl);
        $httpResponse = $solrResults['http_response']->to_array();

        $results = json_decode($httpResponse['body']);
        if(isset($results)) {
            return $results->{'response'};
        } else {
            return null;
        }

    }

    private function getFiltresInQuery($filtres) {
        $dynamicUrlParam = "";
        if(isset($filtres)) {
            for($i=0; $i<count($filtres); $i++)
            {
                if(isset($filtres[$i]->{'value'}) && count($filtres[$i]->{'value'}) > 0) {
                    if($filtres[$i]->{'name'} == "etablissement_porteur") {
                        $facetteValue = json_encode(($filtres[$i]->{'value'}[0]));
                        $facetteValue = "\"".str_replace("\"", "\\\"", $facetteValue)."\"";
                    } else {
                        $facetteValue = "\"".$filtres[$i]->{'value'}[0]."\"";
                    }

                    if(count($filtres[$i]->{'value'}) > 1) {
                        $facetteValue = '('.$facetteValue;
                        for($j=1; $j<count($filtres[$i]->{'value'}); $j++) {
                            $facetteValue = $facetteValue.' AND "'.$filtres[$i]->{'value'}[$j]."\"";
                        }
                        $facetteValue = $facetteValue.')';
                    }
                    $dynamicUrlParam = $dynamicUrlParam."&fq=".$filtres[$i]->{'name'}.":".self::escapeSolrQueryComponent($facetteValue);

                }
            }
        }
        return $dynamicUrlParam;
    }

    public function getZoomSurResults($fullQuery) {
        $solrResults = wp_remote_get($this->solrUrl."/".$this->noticeIndex."/select/?".$fullQuery."&wt=json");
        $httpResponse = $solrResults['http_response']->to_array();

        $results = json_decode($httpResponse['body']);
        if(isset($results)) {
            return $results->{'response'};
        } else {
            return null;
        }
    }

    /**
     * Échappe les caractères spéciaux d'une clause fq Solr.
     *
     * @param {String} val Valeur à échapper
     *
     * @return {String} Valeur échappée
     */
    private function escapeSolrQueryComponent($val) {
        // Pour l'instant, on suppose que seuls les guillemets et apostrophes ont besoin d'être échappés.
        $val = str_replace('\"', "\\\"", $val);
        return urlencode(str_replace('\'', "\\'", $val));
    }
}