# Evaluation PHP-POO

## Installation du projet
`composer install`

Permet d'installer les dépendances PHP

`yarn install` ou `npm install`

Permet d'installer les dépendances CSS/JS

`yarn dev` ou `npm run dev`

Permet de compiler les assets

## Enoncé
Réaliser un site permettant de créer des personnages, puis de choisir 2 personnages pour effectuer un combat.

### Règles métiers
- Un personnage doit posséder, à minima, un **nom**, une **description**, une **santé**, une **force**, une **photo d'illustration**, une **date de création** et une **date de modification**.


- Un personnage doit être, obligatoirement et au choix, un **Magicien**, un **Guerrier** ou un **Voleur**.


- Un personnage doit avoir la _capacité_ de **frapper** un autre personnage, en lui occasionnant des dégats _(par défaut à hauteur de sa force)_.


- Un **combat** entre A et B, se déroule au tour à tour : A tape B, puis B tape A.


- Lors de la **création d'un personnage**, ses données (santé, force, etc.) sont générées **aléatoirement** _(d'après les règles métiers spécifiques)_ et doivent rester les mêmes d'un combat à l'autre.

Il n'y a pas besoin d'une gestion d'utilisateurs (pas d'inscription / connexion).

Il n'y a pas besoin d'enregistrer la sélection des personnages en base de données.

### Règles métiers spécifiques
- Un **magicien** aura 
 une **santé** comprise entre 50 et 75,
 une **force** comprise entre 10 et 20, 
 une _capacité supplémentaire_ **mana** permettant de jeter des sorts comprise entre 100 et 200.
Lors d'un combat, le magicien aura **1 chance sur 3** de se **soigner de 25 points de vie** _(pour un coût de 25 mana)_. Cette jauge de mana ne remonte pas lors d'un combat.


- Un **guerrier** aura 
 une **santé** comprise entre 100 et 200, 
 une **force** comprise entre 20 et 30. 
Lors d'un combat, le guerrier aura **1 chance sur 4** de **taper une seconde fois**.


- Un **voleur** aura
 une **santé** comprise entre 50 et 75, 
 une **force** comprise entre 10 et 20.
Lors d'un combat, le voleur a **1 chance sur 2** de pouvoir **esquiver le coup reçu**.

## Etapes à faire
Le côté graphique (CSS) n'est pas évalué

### Etape 1 _(temps estimé : 3h)_
- prendre connaissance du modèle de données SQL fourni
- (4 pts) créer les entités PHP et les règles métiers
- (3 pts) finaliser le repository CharacterRepository (save / hydrate / buildCriterias)

### Etape 2 _(temps estimé : 3h)_
- pouvoir filtrer les personnages (par classe et via une recherche multi-critères sur le nom et/ou la description)
- (2 pts) pouvoir consulter la fiche d'un personnage
- (2 pts) pouvoir choisir des personnages (2 obligatoirement pour un combat)
- (1 pts) actualiser la valeur dans le header en AJAX
- (3 pts) pouvoir effectuer un combat (en AJAX) dès 2 personnages choisis et suivre les actions effectuées

## Barême _(sur 20 points)_
- (15 points) Respect des consignes et programme fonctionnel
- (3 points) Utilisation des concepts vus en cours (constantes, fonctions, robustesse du langage, etc.)
- (2 points) Documentation et lisibilité du code
