## Extensions Wordpress

* Advances Custom Fields
* Timber

## Configuration

### Réglages > Permaliens

Custom structure : `/%year%/%monthnum%/%day%/%postname%/`

### Pages nécessaires

* Créer une page **Accueil** avec ACF lien_newsletter vers `newsletter`
* Créer une page **Actualités** avec comme permalien `liste-actualites` et modèle `ListeActualites`
* Créer une page **Newsletter** avec comme permalien `newsletter` et modèle `Newsletter`


### Réglages ACF

#### Créer modèle **Paramètres spécifiques de la page d’accueil**

* Lien vers newsletter - lien_newsletter - Texte

Emplacement :
* Page est égal `Page d'accueil`
* Modèle de page est égal à `Home` (modèle du thème)

#### Créer modèle **Carte à la une**

* Description - description - Texte
* Image - image - Image (format de modèle : `URL de l'image`)
* URL - url - URL

#### Créer modèle **Actualité**

* Description - description - Texte
* Image - image - Image (format de modèle : `URL de l'image`)

Emplacement :
* Type de publication est égal `Article` __et__ Catégorie est égal à `Actualités`


## Compilation des assets

Depuis le répertoire `assets` :

### Préparation 

```yarn install```

### Mode watch

```yarn watch```

### Compilation des sources pour l'environnement dev

```yarn build:dev```
