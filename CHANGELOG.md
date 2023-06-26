# Change Log
Alle updates naar main worden hier bijgehouden. 
 
Dit format is gebaseerd op [Keep a Changelog](http://keepachangelog.com/) en dit project houdt zich aan [Semantic Versioning](http://semver.org/).

## [v1.5.0] - 23-06-2023

Deze update omvat alle functionaliteiten die zijn toegevoegd tijdens sprint 5. Middels deze sprint is het minimum viable product (MVP) afgerond. Dit is de laatste sprint, dus hierna zal er niet meer verder worden gewerkt aan het product door ons.
 
### Toegevoegd
- Als applicatiebeheerder, wil ik dat nieuwe gebruikers hun voor-/achternaam moeten opgeven bij registreren, zodat deze mogelijk op andere plaatsen in de applicatie getoond kan worden.
- Als competitiebeheerder, wil ik niet standaard als 'deelnemer' toegevoegd worden aan mijn competitie, zodat ik zelf kan bepalen of ik officieel mee doe.
- Als competitiebeheerder, wil ik dat competities die op 'concept' staan, door anderen niet bekeken kan worden.
- Als gebruiker, wil ik een aparte pagina - ook in de navbar - voor 'mijn competities', zodat ik gemakkelijker naar mijn eigen competities kan navigeren.
- Als applicatiebeheerder, wil ik dat er een limiet ingesteld wordt op de bestandsgrootte van een te uploaden inzending, zodat de website correct blijft werken.
- Als gebruiker, wil ik de afbeeldingen van inzendingen op 'volledig formaat' kunnen bekijken, zodat ik de inzending gedetailleerder kan bekijken.
- Als competitiedeelnemer, wil ik een beoordeling kunnen aanpassen, zodat ik mijn beoordeling kan corrigeren als ik een foutje heb gemaakt.
- Als competitiedeelnemer, wil ik een beoordeling kunnen verwijderen, zodat ik deze kan weghalen als deze per ongeluk is geplaatst.
- Als competitiebeheerder, wil ik - gebruikers die toegelaten zijn aan de competitie - nog kunnen verwijderen.
- Als applicatiebeheerder, wil ik dat alle relevante opties op de website, ook te gebruiken zijn via een API-call (post, update, delete), zodat de functionaliteiten ook extern te gebruiken zijn.
 
### Gewijzigd
- Als applicatiebeheerder, wil ik dat bepaalde onderdelen van de applicatie opgesplitst worden in componenten, zodat de applicatie meer modulaire is.
- Verschillende feedbackpunten verwerkt naar aanleiding van de sprint review
 
### Gefixt
- Verschillende fixes naar aanleiding van de Guerilla tests
- Gefixt dat weer een placeholder wordt getoond op o.a. 'competition.show' als er geen thumbnail meegegeven wordt aan de competitie.

## [v1.2.0] - 02-06-2023

Deze update omvat alle functionaliteiten die zijn toegevoegd tijdens sprint 4. Middels deze sprint is het minimum viable product (MVP) uitgebreid met enkele belangrijke functionaliteiten. Voornamelijk de user flows zijn beter gemaakt. Ook is er een basisversie toegevoegd voor API-toegang.
 
### Toegevoegd
- Als applicatiebeheerder, wil ik dat 'flash berichten' op een consistente manier getoond worden, zodat de code duidelijker is.
- Als gebruiker, wil ik duidelijkere userflows, zodat de applicatie gemakkelijk en beter in gebruik is.
- Als applicatiebeheerder, wil ik een consistent uiterlijk van de website, zodat mijn website er degelijk uit ziet.
- Als applicatiebeheerder, wil ik dat er een limiet ingesteld wordt op de bestandsgrootte van een te uploaden inzending, zodat de website correct blijft werken.
- Als competitiedeelnemer, wil ik mijn inzending kunnen verwijderen, zodat ik foute inzendingen kan terugdraaien.
- Als gebruiker, wil ik dat het duidelijk is welke vorm van 'afbeelding inzenden' voorrang heeft, zodat ik weet welke manier gebruikt wordt.
- Als gebruiker, wil ik dat alle verplichte velden (van alle forms op de website) met een '*' aangegeven worden, zodat duidelijk is welke velden ik leeg kan laten.
- Als competitiebeheerder, wil ik de inzendingen van anderen kunnen verwijderen, zodat ik inzendingen die ik niet in de competitie wil hebben weg kan halen.
- Als competitiedeelnemer, wil ik zien welke beoordelingen van inzendingen van mij zijn, zodat ik deze makkelijk terug kan vinden als er veel beoordelingen zijn.
- Als applicatiebeheerder, wil ik dat alle - relevante - opties op de website, ook beschikbaar gemaakt worden via een API (readonly), zodat deze door externe programma's te gebruiken zijn.
- Als applicatiebeheerder, wil ik dat alle API-calls correct beveiligd zijn, zodat enkel geautoriseerde gebruikers toegang hebben tot de API.
 
### Gewijzigd
- Als competitiedeelnemer, wil ik geen 'disabled knoppen' zien, maar gewoon een tekst die aangeeft dat ik al mee doe, zodat ik niet verward raak.
- Als gebruiker, wil ik mee kunnen doen aan een competitie via de desbetreffende 'competitie detailpagina' en niet via de 'overview', zodat ik eerst kan bekijken wat de competitie inhoudt.
- Als competitiebeheerder, wil ik dat enkel gebruikers die deelnemen aan de competitie acties binnen de competitie kunnen uitvoeren, zodat dit op een goede manier beveiligd is.
 
### Gefixt
- Bij een publieke competitie, komt er nu geen 'acceptatieverzoek' meer binnen bij de beheerder.
- De 'inzenden' knop wordt nu altijd getoond als dit wel de bedoeling is.

## [v1.0.0] - 10-04-2023

Deze update omvat alle functionaliteiten die zijn toegevoegd tijdens sprint 2. Middels deze sprint is het minimum viable product (MVP) uitgebreid met enkele belangrijke functionaliteiten.
 
### Toegevoegd
- Als gebruiker, wil ik kunnen inloggen, zodat ik geïdentificeerd kan worden op de website.
- Als competitiebeheerder, wil ik bij het aanmaken van de competitie, de competitie als concept kunnen opslaan, zodat ik een competitie kan aanmaken waar nog geen mensen aan mogen deelnemen.
- Als competitiedeelnemer, wil ik kunnen zien wat mijn beoordelingen zijn, zodat ik weet wat mijn score is.
- Als competitiebeheerder wil ik competities kunnen delen, zodat andere gebruikers mee kunnen doen aan een competitie.
- Als competitiedeelnemer, wil ik de details zien van een competitie, zodat ik meer informatie over de competitie kan vinden.
- Als gebruiker, wil ik naar een uitlegpagina kunnen navigeren, zodat ik weet hoe de website werkt.
- Als competitiebeheerder, wil ik de competitie kunnen stopzetten, zodat er een winnaar gekozen kan worden.
- Als competitiedeelnemer, wil ik kunnen zien wie de winnaar van de competitie is, zodat ik weet wie er heeft gewonnen.
- Als gebruiker, wil ik een aantrekkelijke en goedwerkende frontpage, zodat ik gemakkelijk de applicatie kan gebruiken.
- Als competitiedeelnemer, wil ik een opmerking kunnen plaatsen bij een beoordeling, zodat ik uitleg kan geven bij mijn beoordeling.
- Als gebruiker wil ik een account kunnen registreren, zodat ik geïdentificeerd kan worden op de website.
- Als competitiebeheerder, wil ik kunnen aangeven hoeveel inzendingen iedere gebruiker mag doen, zodat er een beperking gesteld kan worden op het aantal inzendingen.
- Realistische en relevante seeddata
 
### Gewijzigd
- Validatie op URL op competitie/inzending aanmaken verwijderd
- Datums worden consistent weergegeven
- Als een plaatje niet werkt, wordt er vanaf heden geen plaatje meer getoond.
- Enkel gepubliceerde competities worden getoond.
- De knop 'afgelopen' is weg bij het beoordelen van een competitie.
- Conceptstatus is weg uit het competitieoverzicht
- Einddatum is niet meer verplicht voor een competitie
 
### Gefixt
- Fout met het beoordelen van een inzending opgelost.
- Bepaalde pagina's die nog niet juist zijn gecentreerd, zijn dat nu wel.

## [v0.8.0] - 12-03-2023

Deze update omvat alle functionaliteiten die zijn toegevoegd tijdens sprint 1. Middels deze sprint is er een minimum viable product (MVP) opgeleverd van de applicatie.
 
### Toegevoegd
- Mogelijkheid om een competitie aan te maken.
- Mogelijkheid om te kunnen navigeren door de website.
- Mogelijkheid om deel te kunnen nemen aan competities.
- Mogelijkheid om een inzending te kunnen doen, in de vorm van een foto met een titel en omschrijving.
- Mogelijkheid om een inzending te kunnen beoordelen op basis van 5 sterren, met de mogelijkheid om ook halve sterren te geven
- Mogelijkheid om een tijdslimiet aan een competitie te geven.
- Mogelijkheid om handmatig een winnaar te kiezen, nadat de competitie is afgelopen.
 
### Gewijzigd
N.v.t.
 
### Gefixt
N.v.t.
 
## [v0.x.x] - DD-MM-YYYY

Beschrijving
 
### Toegevoegd
N.v.t.
 
### Gewijzigd
N.v.t.
 
### Gefixt
N.v.t.
