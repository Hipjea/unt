<?php
/**
 * Created by PhpStorm.
 * User: cbonfre
 * Date: 11/03/2019
 * Time: 12:03
 */

namespace Unt\Models;

use Timber\Post;

class NoticeModel
{
    /** @var string */
    private $uuid;

    /** @var string */
    private $titre;

    /** @var string */
    private $description;

    /** @var string */
    private $auteur;

    /** @var string */
    private $image;

    /** @var string */
    private $video;

    /** @var string */
    private $ressource;

    /** @var string */
    private $ressource_type;

    /** @var bool */
    private $display_in_iframe = false;

    /** @var string */
    private $date;

    /** @var string */
    private $universite_productrice;

    /** @var string */
    private $universite_productrice_id;

    /** @var string */
    private $etablissements_co_editeurs;

    /** @var string[] */
    private  $disciplines;

    /** @var string[] */
    private  $domaines;

    /** @var string */
    private $types_pedagogiques;

    /** @var string */
    private $niveau;

    /** @var string[] */
    private $objectifs_pedagogiques;

    /** @var string */
    private $activite_induite;

    /** @var string[] */
    private $proposition_utilisation;

    /** @var string */
    private $duree_dapprentissage;

    /** @var string */
    private $langue_de_lapprenant;

    /** @var string[] */
    private $complements;

    /** @var string */
    private $contributeurs;

    /** @var string[] */
    private $mots_clefs;

    /** @var bool */
    private $exposition_oai;

    /** @var string */
    private $fiches_xml;

    /** @var string */
    private $indice_dewey;

    /** @var string */
    private $evaluation_form;

    /** @var string */
    private $droits;

    /** @var string */
    private $code_droits;

    /** @var string[] */
    private $aPourPrerequisUuid;

    /** @var string[] */
    private $estPrerequisDeUuid;

    /** @var string[] */
    private $contientUuid;

    /** @var string[] */
    private $estPartiDeUuid;

    /** @var string[] */
    private $referenceUuid;

    /** @var string[] */
    private $estReferenceParUuid;

    /** @var string[] */
    private $associeAUuid;

    /** @var string */
    private $associationType;

    /** @var string */
    private $entrepotNom;

    /** @var bool */
    private $externalResource;

    /** @var bool */
    private $coursComplet;

    /** @var string */
    private $serverDocument = SERVER_DOCUMENTS;

    public function __construct($solrNotice)
    {
        if(isset($solrNotice)) {
            $this->uuid = $solrNotice->{'uuid'};
            $this->titre = $solrNotice->{'titre'};
            $this->description = $solrNotice->{'description'};
            if(isset($solrNotice->{'contributions'})) {
                $contributeurs = json_decode($solrNotice->{'contributions'});
                $this->auteur = "";
                foreach($contributeurs as $contributeur) {
                    if($contributeur->{'codeRole'} == 'auteur') {
                        $this->auteur = $this->auteur.$contributeur->{'nom'}." ".$contributeur->{'prenom'}.", ";
                    }
                }
                if($this->auteur != "") {
                    $this->auteur = substr($this->auteur, 0, strlen($this->auteur)-2);
                }
            }
            if(isset($solrNotice->{'video_vignette'})) {
                $this->video = $solrNotice->{'video_vignette'};
            }
            if(isset($solrNotice->{'vignette'})) {
                $this->image = $this->serverDocument.explode('-', $solrNotice->{'vignette'})[0].'/'.explode('-', $solrNotice->{'vignette'})[1].'/'.explode('-', $solrNotice->{'vignette'})[2].'/'.$solrNotice->{'vignette'};
            }
            if(isset($solrNotice->{'ressource_lien'})) {
                $this->ressource_type = 'url';
                $this->ressource = json_decode($solrNotice->{'ressource_lien'})->{'url'};
            } else if(isset($solrNotice->{'ressource_contenu_html'})) {
                $this->ressource_type = 'html';
                $this->ressource = $solrNotice->{'ressource_contenu_html'};
            } else if(isset($solrNotice->{'fichiers_attaches'})) {
                $this->ressource_type = 'file';
                $fichierAttache = json_decode($solrNotice->{'fichiers_attaches'});
                if (count($fichierAttache) > 0) {
                    // on ne prend que le premier fichier
                    $fichierAttache = $fichierAttache[0];

                    $fichierArray = explode('-', $fichierAttache->{'filename'});
                    $fichierPath = $fichierArray[0].'/'.$fichierArray[1].'/'.$fichierArray[2].'/'.$fichierAttache->{'filename'};

                    $this->ressource = $this->serverDocument.$fichierPath;
                }
            }

            if(isset($solrNotice->{'display_in_iframe'})) {
                $this->display_in_iframe = $solrNotice->{'display_in_iframe'};
            } else {
                $this->display_in_iframe = false;
            }
            if(isset($solrNotice->{'date_creation'})) {
                $this->date = $solrNotice->{'date_creation'};
            }
            if(isset($solrNotice->{'etablissement_porteur'})) {
                $this->universite_productrice = (json_decode($solrNotice->{'etablissement_porteur'}))->{'libelle'};
                if(isset((json_decode($solrNotice->{'etablissement_porteur'}))->{'id'})) {
                    $this->universite_productrice_id = (json_decode($solrNotice->{'etablissement_porteur'}))->{'id'};
                }
            } else {
                $this->universite_productrice = '';
            }
            if(isset($solrNotice->{'etablissements_co_editeurs'})) {
                $this->etablissements_co_editeurs = self::getStringLibelleFromArray(json_decode($solrNotice->{'etablissements_co_editeurs'}));
            }
            if(isset($solrNotice->{'specialites'})) {
                $this->disciplines = json_decode($solrNotice->{'specialites'});
            }
            if(isset($solrNotice->{'domaines'})) {
                $this->domaines = json_decode($solrNotice->{'domaines'});
            }
            if(isset($solrNotice->{'niveaux'})) {
                $this->niveau = self::getStringFromArray(json_decode($solrNotice->{'niveaux'}));
            }
            if(isset($solrNotice->{'objectifs_pedagogiques'})) {
                $this->objectifs_pedagogiques = json_decode($solrNotice->{'objectifs_pedagogiques'});
            }
            if(isset($solrNotice->{'types_pedagogiques'})) {
                $this->types_pedagogiques = self::getStringFromArray(json_decode($solrNotice->{'types_pedagogiques'}));
            }
            if(isset($solrNotice->{'activites_induites'})) {
                $this->activite_induite = self::getStringFromArray(json_decode($solrNotice->{'activites_induites'}));
            }
            if(isset($solrNotice->{'proposition_utilisation'})) {
                $this->proposition_utilisation = json_decode($solrNotice->{'proposition_utilisation'});
            }
            if(isset($solrNotice->{'duree_apprentissage'})) {
                $this->duree_dapprentissage = $solrNotice->{'duree_apprentissage'};
            }
            if(isset($solrNotice->{'langues_utilisateur'})) {
                $this->langue_de_lapprenant = self::getStringFromArray(json_decode($solrNotice->{'langues_utilisateur'}));
            }
            if(isset($solrNotice->{'proposition_utilisation'})) {
                $this->complements = json_decode($solrNotice->{'proposition_utilisation'});
            }
            if(isset($solrNotice->{'contributions'})) {
                $this->contributeurs = $solrNotice->{'contributions'};
            }
            if(isset($solrNotice->{'mots_cles'})) {
                $this->mots_clefs = json_decode($solrNotice->{'mots_cles'});
            }
            if(isset($solrNotice->{'droit'})) {
                $this->droits = $solrNotice->{'droit'};
            }
            if(isset($solrNotice->{'evaluation_form_url'})) {
                $this->evaluation_form = $solrNotice->{'evaluation_form_url'};
            }
            if(isset($solrNotice->{'exposition_oai'})) {
                $this->exposition_oai = $solrNotice->{'exposition_oai'};
            } else {
                $this->exposition_oai = false;
            }
            if(isset($solrNotice->{'droit'})) {
                $this->code_droits = self::generateCodeDroits($solrNotice->{'droit'});
            }
            if(isset($solrNotice->{'associations_requires'})) {
                $this->aPourPrerequisUuid = self::getRelations($solrNotice->{'associations_requires'});
            }
            if(isset($solrNotice->{'associations_is_required_by'})) {
                $this->estReferenceParUuid = self::getRelations($solrNotice->{'associations_is_required_by'});
            }
            if(isset($solrNotice->{'associations_has_part'})) {
                $this->contientUuid = self::getRelations($solrNotice->{'associations_has_part'});
            }
            if(isset($solrNotice->{'associations_is_part_of'})) {
                $this->estPartiDeUuid = self::getRelations($solrNotice->{'associations_is_part_of'});
            }
            if(isset($solrNotice->{'associations_references'})) {
                $this->referenceUuid = self::getRelations($solrNotice->{'associations_references'});
            }
            if(isset($solrNotice->{'associations_is_referenced_by'})) {
                $this->estReferenceParUuid = self::getRelations($solrNotice->{'associations_is_referenced_by'});
            }
            if(isset($solrNotice->{'associations_associate'})) {
                $this->associeAUuid = self::getRelations($solrNotice->{'associations_associate'});
            }
            if(isset($solrNotice->{'entrepot_nom'})) {
                $this->entrepotNom = $solrNotice->{'entrepot_nom'};
            }
            if(isset($solrNotice->{'external_resource'})) {
                $this->externalResource = $solrNotice->{'external_resource'};
            } else {
                $this->externalResource = false;
            }
            if(isset($solrNotice->{'macro_ressource'})) {
                $this->coursComplet = $solrNotice->{'macro_ressource'};
            } else {
                $this->coursComplet = false;
            }
        }
    }

    private function getStringFromArray(array $list): string
    {
        return implode(", ", $list);
    }

    private function getStringLibelleFromArray(array $list): string
    {
        $stringValue = "";
        if($list != null AND count($list) > 0) {
            if(count($list) > 1) {
                for ($i = 0; $i <= count($list)-2; $i++) {
                    if (count($list) > 1) {
                        $stringValue = $stringValue.$list[$i]->{'libelle'}.", ";
                    }
                }
            }
            $stringValue = $stringValue.$list[count($list)-1]->{'libelle'};
        }
        return $stringValue;
    }

    private function generateCodeDroits($valeurDroits) : string
    {
        $droits = "";
        if($valeurDroits != null) {
            $droitNDen = 'Attribution-NonCommercial-NoDerivs 2.0 France';
            $droitNDfr = 'Licence Creative Commons : Paternité-Pas d\'Utilisation Commerciale-Pas de Modification 2.0 France';
            $droitSAen = 'Creative Commons Licence: Attribution-NonCommercial-ShareAlike 2.0 Generic';
            $droitSAfr = 'Licence Creative Commons : Paternité - Pas d\'Utilisation Commerciale - Partage à l\'Identique 2.0 France';
            $droitsNc4fr = 'Licence Creative Commons : Paternité - Pas d\'Utilisation Commerciale -Partage à l\'identique 4.0 France';
            $droitsNc2fr = 'Licence Creative Commons : Paternité - Pas d\'Utilisation Commerciale 2.0 France';
            $droitAuteuren = 'Rights management reserved to publishers';
            $droitAuteurfr = 'Gestion des droits réservée aux éditeurs';
            if($valeurDroits == $droitNDen || $valeurDroits == $droitNDfr) {
                $droits = 'CC_BY_NC_ND_2.0';
            } elseif ($valeurDroits == $droitSAen || $valeurDroits == $droitSAfr) {
                $droits = 'CC_BY_NC_SA_2.0';
            } elseif ($valeurDroits == $droitAuteuren || $valeurDroits == $droitAuteurfr) {
                $droits = 'gestion-editeurs';
            } elseif ($valeurDroits == $droitsNc4fr) {
            	$droits = 'CC_BY_NC_4.0';
            } elseif ($valeurDroits == $droitsNc2fr) {
            	$droits = 'CC_BY_NC_2.0';
            }
        }
        return $droits;
    }

    private function getRelations($association) : ?array
    {
        $notices = json_decode($association);
        $result = [];
        foreach($notices as $notice) {
            array_push($result, $notice->{'uuid'});
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getVideo(): ?string
    {
        return $this->video;
    }

    /**
     * @param string $video
     */
    public function setVideo(string $video): void
    {
        $this->video = $video;
    }

    /**
     * @return string
     */
    public function getRessource(): ?string
    {
        return $this->ressource;
    }

    /**
     * @param string $ressource
     */
    public function setRessource(string $ressource): void
    {
        $this->ressource = $ressource;
    }

    /**
     * @return string
     */
    public function getRessourceType(): ?string
    {
        return $this->ressource_type;
    }

    /**
     * @param string $ressource_type
     */
    public function setRessourceType(string $ressource_type): void
    {
        $this->ressource_type = $ressource_type;
    }

    /**
     * @return bool
     */
    public function getDisplayInIframe(): bool
    {
        return $this->display_in_iframe;
    }

    /**
     * @param bool $display_in_iframe
     */
    public function setDisplayInIframe(bool $display_in_iframe): void
    {
        $this->display_in_iframe = $display_in_iframe;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getUniversiteProductrice(): ?string
    {
        return $this->universite_productrice;
    }

    /**
     * @param string $universite_productrice
     */
    public function setUniversiteProductrice(string $universite_productrice): void
    {
        $this->universite_productrice = $universite_productrice;
    }

    /**
     * @return string
     */
    public function getUniversiteProductriceId(): ?string
    {
        return $this->universite_productrice_id;
    }

    /**
     * @param string $universite_productrice_id
     */
    public function setUniversiteProductriceId(string $universite_productrice_id): void
    {
        $this->universite_productrice_id = $universite_productrice_id;
    }

    /**
     * @return string
     */
    public function getEtablissementsCoEditeurs(): ?String
    {
        return $this->etablissements_co_editeurs;
    }

    /**
     * @param string $etablissements_co_editeurs
     */
    public function setEtablissementsCoEditeurs(String $etablissements_co_editeurs): void
    {
        $this->etablissements_co_editeurs = $etablissements_co_editeurs;
    }



    /**
     * @return string[]
     */
    public function getDisciplines(): ?array
    {
        return $this->disciplines;
    }

    /**
     * @param string[] $disciplines
     */
    public function setDisciplines(array $disciplines): void
    {
        $this->disciplines = $disciplines;
    }

    /**
     * @return string[]
     */
    public function getDomaines(): array
    {
        return $this->domaines;
    }

    /**
     * @param string[] $domaines
     */
    public function setDomaines(array $domaines): void
    {
        $this->domaines = $domaines;
    }

    /**
     * @return string
     */
    public function getTypesPedagogiques(): ?string
    {
        return $this->types_pedagogiques;
    }

    /**
     * @param string $types_pedagogiques
     */
    public function setTypesPedagogiques(string $types_pedagogiques): void
    {
        $this->types_pedagogiques = $types_pedagogiques;
    }

    /**
     * @return string
     */
    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    /**
     * @param string $niveau
     */
    public function setNiveau(string $niveau): void
    {
        $this->niveau = $niveau;
    }

    /**
     * @return string[]
     */
    public function getObjectifsPedagogiques(): ?array
    {
        return $this->objectifs_pedagogiques;
    }

    /**
     * @param string[] $objectifs_pedagogiques
     */
    public function setObjectifsPedagogiques(array $objectifs_pedagogiques): void
    {
        $this->objectifs_pedagogiques = $objectifs_pedagogiques;
    }

    /**
     * @return string
     */
    public function getActiviteInduite(): ?string
    {
        return $this->activite_induite;
    }

    /**
     * @param string $activite_induite
     */
    public function setActiviteInduite(string $activite_induite): void
    {
        $this->activite_induite = $activite_induite;
    }

    /**
     * @return string[]
     */
    public function getPropositionUtilisation(): ?array
    {
        return $this->proposition_utilisation;
    }

    /**
     * @param string[] $proposition_utilisation
     */
    public function setPropositionUtilisation(array $proposition_utilisation): void
    {
        $this->proposition_utilisation = $proposition_utilisation;
    }

    /**
     * @return string
     */
    public function getDureeDapprentissage(): ?string
    {
        return $this->duree_dapprentissage;
    }

    /**
     * @param string $duree_dapprentissage
     */
    public function setDureeDapprentissage(string $duree_dapprentissage): void
    {
        $this->duree_dapprentissage = $duree_dapprentissage;
    }

    /**
     * @return string
     */
    public function getLangueDeLapprenant(): ?string
    {
        return $this->langue_de_lapprenant;
    }

    /**
     * @param string $langue_de_lapprenant
     */
    public function setLangueDeLapprenant(string $langue_de_lapprenant): void
    {
        $this->langue_de_lapprenant = $langue_de_lapprenant;
    }

    /**
     * @return string[]
     */
    public function getComplements(): ?array
    {
        return $this->complements;
    }

    /**
     * @param string[] $complement
     */
    public function setComplements(array $complements): void
    {
        $this->complements = $complements;
    }

    /**
     * @return string
     */
    public function getContributeurs(): ?string
    {
        return $this->contributeurs;
    }

    /**
     * @param string $contributeurs
     */
    public function setContributeurs(string $contributeurs): void
    {
        $this->contributeurs = $contributeurs;
    }

    /**
     * @return string[]
     */
    public function getMotsClefs(): ?array
    {
        return $this->mots_clefs;
    }

    /**
     * @param string[] $mots_clefs
     */
    public function setMotsClefs(array $mots_clefs): void
    {
        $this->mots_clefs = $mots_clefs;
    }

    /**
     * @return bool
     */
    public function isExpositionOai(): bool
    {
        return $this->exposition_oai;
    }

    /**
     * @param bool $exposition_oai
     */
    public function setExpositionOai(bool $exposition_oai): void
    {
        $this->exposition_oai = $exposition_oai;
    }

    /**
     * @return string
     */
    public function getFichesXml(): ?string
    {
        return $this->fiches_xml;
    }

    /**
     * @param string $fiches_xml
     */
    public function setFichesXml(string $fiches_xml): void
    {
        $this->fiches_xml = $fiches_xml;
    }

    /**
     * @return string
     */
    public function getIndiceDewey(): ?string
    {
        return $this->indice_dewey;
    }

    /**
     * @param string $indice_dewey
     */
    public function setIndiceDewey(string $indice_dewey): void
    {
        $this->indice_dewey = $indice_dewey;
    }

    /**
     * @return string
     */
    public function getEvaluationForm(): ?string
    {
        return $this->evaluation_form;
    }

    /**
     * @param string $evaluation_form
     */
    public function setEvaluationForm(string $evaluation_form): void
    {
        $this->evaluation_form = $evaluation_form;
    }

    /**
     * @return string
     */
    public function getDroits(): string
    {
        return $this->droits;
    }

    /**
     * @param string $droits
     */
    public function setDroits(string $droits): void
    {
        $this->droits = $droits;
    }

    /**
     * @return string
     */
    public function getCodeDroits(): string
    {
        return $this->code_droits;
    }

    /**
     * @param string $code_droits
     */
    public function setCodeDroits(string $code_droits): void
    {
        $this->code_droits = $code_droits;
    }

    /**
     * @return string[]
     */
    public function getAPourPrerequisUuid(): ?array
    {
        return $this->aPourPrerequisUuid;
    }

    /**
     * @param string[] $aPourPrerequisUuid
     */
    public function setAPourPrerequisUuid(array $aPourPrerequisUuid): void
    {
        $this->aPourPrerequisUuid = $aPourPrerequisUuid;
    }

    /**
     * @return string[]
     */
    public function getEstPrerequisDeUuid(): ?array
    {
        return $this->estPrerequisDeUuid;
    }

    /**
     * @param string[] $estPrerequisDeUuid
     */
    public function setEstPrerequisDeUuid(array $estPrerequisDeUuid): void
    {
        $this->estPrerequisDeUuid = $estPrerequisDeUuid;
    }

    /**
     * @return string[]
     */
    public function getContientUuid(): ?array
    {
        return $this->contientUuid;
    }

    /**
     * @param string[] $contientUuid
     */
    public function setContientUuid(array $contientUuid): void
    {
        $this->contientUuid = $contientUuid;
    }

    /**
     * @return string[]
     */
    public function getEstPartiDeUuid(): ?array
    {
        return $this->estPartiDeUuid;
    }

    /**
     * @param string[] $estPartiDeUuid
     */
    public function setEstPartiDeUuid(array $estPartiDeUuid): void
    {
        $this->estPartiDeUuid = $estPartiDeUuid;
    }

    /**
     * @return string[]
     */
    public function getReferenceUuid(): ?array
    {
        return $this->referenceUuid;
    }

    /**
     * @param string[] $referenceUuid
     */
    public function setReferenceUuid(array $referenceUuid): void
    {
        $this->referenceUuid = $referenceUuid;
    }

    /**
     * @return string[]
     */
    public function getEstReferenceParUuid(): ?array
    {
        return $this->estReferenceParUuid;
    }

    /**
     * @param string[] $estReferenceParUuid
     */
    public function setEstReferenceParUuid(array $estReferenceParUuid): void
    {
        $this->estReferenceParUuid = $estReferenceParUuid;
    }

    /**
     * @return string[]
     */
    public function getAssocieAUuid(): ?array
    {
        return $this->associeAUuid;
    }

    /**
     * @param string[] $associeAUuid
     */
    public function setAssocieAUuid(array $associeAUuid): void
    {
        $this->associeAUuid = $associeAUuid;
    }

    /**
     * @return string
     */
    public function getAssociationType(): string
    {
        return $this->associationType;
    }

    /**
     * @param string $associationType
     */
    public function setAssociationType(string $associationType): void
    {
        $this->associationType = $associationType;
    }

    /**
     * @return string
     */
    public function getEntrepotNom(): ?string
    {
        return $this->entrepotNom;
    }

    /**
     * @param string $entrepotNom
     */
    public function setEntrepotNom(string $entrepotNom): void
    {
        $this->entrepotNom = $entrepotNom;
    }

    /**
     * @return bool
     */
    public function isExternalResource(): bool
    {
        return $this->externalResource;
    }

    /**
     * @param bool $external_resource
     */
    public function setExternalResource(bool $externalResource): void
    {
        $this->externalResource = $externalResource;
    }

    /**
     * @return bool
     */
    public function isCoursComplet(): bool
    {
        return $this->coursComplet;
    }

    /**
     * @param bool $coursComplet
     */
    public function setCoursComplet(bool $coursComplet): void
    {
        $this->coursComplet = $coursComplet;
    }
}