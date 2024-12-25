# WP Stay Planner

WP Stay Planner is een WordPress-plugin ontworpen om het plannen en beheren van verblijven te vereenvoudigen.

**Let op: Dit project is nog in ontwikkeling (Work In Progress).**

## Installatie

1. **Plugin downloaden**: [Download de nieuwste versie van de plugin](https://github.com/nsmeele/wp-stay-planner/archive/refs/heads/main.zip) vanaf GitHub.
2. **Uploaden naar WordPress**: Ga in het WordPress-dashboard naar 'Plugins' > 'Nieuwe plugin' en klik op 'Plugin uploaden'. Selecteer het gedownloade ZIP-bestand en klik op 'Nu installeren'.
3. **Activeren**: Na succesvolle installatie, activeer de plugin via het WordPress-dashboard.

## Gebruik

Na activatie is er een nieuw menu-item 'WP Stay Planner' beschikbaar in het WordPress-dashboard. Hier kun je verblijven toevoegen, bewerken en beheren

## Gutenberg

### Blocks
De plugin bevat een aantal Gutenberg blocks die je kunt gebruiken om verblijven weer te geven op je website. De volgende blocks zijn beschikbaar:

- Zoekbar: `wp-stay-planner/search-bar`

### Templates
De plugin bevat een aantal Gutenberg templates die je kunt gebruiken om verblijven weer te geven op je website. De volgende templates zijn beschikbaar:

| Beschrijving | Uri           | Template name                    | Controller                               |
|----------------|---------------|----------------------------------|------------------------------------------|
| Zoekresultaten | /search-room  | `wp-stay-planner/search-results` | `\Wordpress\Controller\SearchController` |

De uri's worden geregisteerd middels de add_rewrite_rule functie.

## Post types

De plugin voegt de volgende post types toe aan WordPress:

- Reservering: `booking`
- Coupon: `coupon`
- Aanbieding: `offer`
- Eigen afwezigheid (vakantie): `out-of-office`
- Kamer: `room`
- Seizoen: `season`

## Installatievereisten

- Wordpress: `^6.7`
- PHP: `^8.2`

De plugin zal niet werken op oudere versies van WordPress, en je krijgt een melding als je probeert deze te installeren of activeren op een niet-ondersteunde versie.

## Contributie

Bijdragen zijn welkom!

## Licentie

Dit project is gelicentieerd onder de Apache License, Version 2.0.

## Contact

Voor vragen of suggesties, open een issue op GitHub.
