<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    HEADER VIEW
-->

<?php
    // Set default navspecs
    $nav_specs = [
        'color' => 'primary-color',
        'links' => [],
        'actions' => [],
        'user' => null,
        'homelink' => ''
    ];

    // Check custom
    if(isset($primaryColor)){
        $nav_specs['color'] = $primaryColor;    
    }

    if(isset($links)){
        $nav_specs['links'] = $links;
    }

    if(isset($actions)){
        $nav_specs['actions'] = $actions;
    }

    if(isset($user)){
        $nav_specs['user'] = $user;
    }

    if(isset($homelink)){
        $nav_specs['homelink'] = $homelink;
    }
?>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark <?php echo $nav_specs['color']; ?>">
        <a href="<?php echo $nav_specs['homelink']; ?>">
            <img src="<?php echo base_url(); ?>assets/img/svg/logo.svg">
        </a>

        <div class="container">
            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <!-- Links for contents -->
                <ul class="navbar-nav mr-auto">

            <?php foreach($nav_specs['links'] as $link){ ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $link['url'] . '"title="' . $link['hulp']; ?>">
                        <?php echo $link['title']; ?>
                    </a>
                </li>
            <?php } ?>

                <!-- Dropdown for actions -->
                <?php if(count($nav_specs['actions']) > 0) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $user->username; ?>
                        </a>
                        
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach($nav_specs['actions'] as $action) { ?>
                                <a class="dropdown-item" href="<?php echo $action['url']; ?>">
                                    <?php echo $action['title']; ?>
                                </a>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item active">
                <a class="nav-link" data-toggle="modal" data-target="#helpModal">?</a>
                </li>
            </ul>
        </div>

    </nav>

<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="helpModalLabel">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
      <h2>1.	Administrator</h2>
<p>De administrator surft naar de indexpagina van de webapplicatie en krijgt een inlogscherm te zien. Hij of zij logt dan in met de credentials die hij/zij verkregen heeft toen de webapplicatie werd afgeleverd. Hij/zij krijgt een dashboard te zien waarbij hij verschillende mogelijkheden heeft: 
</p>
<h4>1.1	Administrator toevoegen</h4>
<p>De administrator heeft de mogelijkheid om andere administratoren die het personeelsfeest mee organiseren of in goede banen willen leiden, toe te voegen. De administrator klikt dan op het volgende icoon:
</p>
<p>Hier kan hij/zij dan kiezen voor ‘administratoren beheren’. Hier krijgt hij/zij een lijst te zien met alle administrator-accounts die in het systeem geregistreerd zijn. Bij het eerste gebruik ziet hij/zij dus enkel zijn/haar eigen account. De administrator kan dan op ‘edit’ drukken indien hij wenst de gebruikersnaam en/of het wachtwoord aan te passen. Hij/zij vult dan het oude wachtwoord in, vult de nieuwe gebruikersnaam en het nieuwe wachtwoord twee maal in en drukt op ‘pas admin aan’. Hij/zij kan ook kiezen om het administrator-account te verwijderen door op ‘verwijder’ te klikken.
</p>
<h4>1.2	Editiebeheer</h4>
<p>De personeelsfeesten worden per editie beheerd. Elke editie of jaargang staat opgelijst wanneer in het systeem. De administrator kan deze lijst raadplegen door op de knop ‘editiebeheer’ te klikken in de navigatiebalk bovenaan. Die knop ziet er zo uit:
</p>
<p>Hier wordt de naam van elk personeelsfeest opgelijst, alsook eventuele bijkomende informatie, het thema, de datum range (van wanneer tot wanneer het personeelsfeest plaatsvond), of het personeelsfeest al dan niet ‘actief’ is (dit zal het geval zijn als het personeelsfeest nog niet voorbij is). Als het personeelsfeest actief is, kan men hier op ‘afsluiten’ drukken als men de huidige jaargang wenst af te sluiten (als het feest bijvoorbeeld geannuleerd wordt bijvoorbeeld). Als het feest niet langer actief is (en dus al voorbij is of afgesloten), zal hier geen knop staan maar dan wordt ‘afgesloten’ weergegeven. 
</p>
<p>De administrator kan op de knop ‘open’ drukken om de variabelen van deze editie of jaargang aan te passen. Hier bevindt zich de knop ‘edit’ waarmee de administrator de naam, info, thema en de datum-range van de editie kan aanpassen. Dit is enkel mogelijk als de jaargang nog actief is. Hij/zij kan dus niet de variabelen van een feest aanpassen dat reeds afgelopen is. 
</p>
<p>De administrator kan op de knop ‘keuzemogelijkheden’ klikken om de verschillende keuzemogelijkheden aan te passen, toe te voegen of verwijderen. Hiertoe behoren de keuzemogelijkheden qua eten, vervoer, activiteiten en/of andere variabelen die de administrator wenst toe te voegen. 
</p>
<p>De administrator kan op de knop ‘vrijwilligers’ klikken. Hier krijgt hij/zij een lijst te zien met alle studenten en/of anderen die zich hebben opgegeven als vrijwilliger. Hij kan in deze lijst de informatie (naam, woonplaats, e-mailadres, enz…) aanpassen per vrijwilliger, een vrijwilliger verwijderen of een nieuwe vrijwilliger toevoegen.
</p>
<p>De administrator kan op de knop ‘deelnemers’ klikken, waar hij/zij analoog aan de lijst vrijwilligers een lijst te zien zal krijgen van alle deelnemers. Dit zijn alle mensen die bevestigd hebben dat ze het personeelsfeest zullen bijwonen. Ook hier kan de administrator de informatie (naam, woonplaats, e-mailadres, enz…) aanpassen per deelnemer, een deelnemer verwijderen of een nieuwe deelnemer toevoegen.
</p>
<p>Tot slot kan de administrator op ‘personeel importeren’ klikken om een CSV-bestand te importeren. Als hij/wij bijvoorbeeld over een excelbestand beschikt dat de informatie van alle docenten bevat, is het handiger om deze allemaal te importeren in plaats van ze één voor één toe te voegen via de ‘deelnemers’-knop. Hij exporteert het excelbestand dan naar de CSV-extentie waarna het herkend kan worden door de wepapplicatie. 
</p>
<h4>1.3	Locaties beheren</h4>
<p>De administrator heeft de mogelijkheid om de verschillende locaties die zullen gebruikt worden voor het personeelsfeest, te bewerken. Hij/zij klikt dan in de navigatiebalk op de knop ‘Locaties’. 
</p> 
<p>Hier worden alle locaties opgelijst die voor het personeelsfeest gebruikt worden. Per locatie wordt de naam en de plaats opgelijst. Onder plaats vind je dan een beschrijving van waar de locatie net gevonden kan worden. Voor aula 1 is dat bijvoorbeeld ‘de eerste deur rechts nadat men de school binnenkomt langs de hoofdingang’. 
</p>
<p>Per locatie kan de administrator op de ‘wijzig’-knop klikken als hij wenst de naam en/of de plaats(beschrijving) aan te passen. Als er op deze knop geklikt wordt, worden de veldjes ‘naam’ en ‘locatie’ onderaan ingevuld. Deze kunnen dan worden aangepast. Na het aanpassen drukt de administrator op ‘verzenden’. Hij/zij kan ook een locatie uit de lijst verwijderen door op de knop ‘verwijder’ te klikken. 
</p>
<h4>1.4	Mails beheren</h4>
<p>De administrator kan de mails beheren die automatisch dienen verzonden te worden (naar de helpers, personeelsleden, administratoren en/of iedereen). Hij/zij klikt dan op de knop ‘mails’.
</p>
<p>Hier krijgt de administrator een lijst te zien met alle mails die zullen worden verzonden. Per mail kan de administrator zien wanneer hij zal worden verzonden, het aantal ontvangers (waarop hij/zij kan klikken om te kijken wie die ontvangers zijn), het onderwerp van de mail, het sjabloon dat werd gebruikt om de mail op te stellen en de status (verstuurd of niet verstuurd). Rechts kan de administrator per mail op de knop ‘wijzig’ klikken om al deze variabelen aan te passen. Hij kan ook klikken op ‘verwijder’ als hij een mail uit de lijst wenst te verwijderen.
</p>
<h4>1.5	Sessie beëndigen0/<h4>
<p>De administrator kan – wanneer hij klaar is met werken aan het personeelsfeest – zijn/haar sessie beëindigen. Dit doet hij/zij door op het pijltje te klikken in de navigatiebalk:
</p>
<p>Hier klikt de administrator op ‘afmelden’. De sessie wordt beëindigd en de administrator wordt weer naar de startpagina gestuurd.
</p>
<h2>2.	Docent</h2>
<p>De docent die het personeelsfeest wenst bij te wonen, zal de webapplicatie ook gebruiken om zijn keuzen door te geven qua activiteiten, eten, enzovoort. Dit doet hij/zij door op de unieke link te klikken in de mail die hem/haar wordt toegezonden. Deze bevat een unieke token aan de hand waarvan de docent geïdentificeerd wordt. 
</p>
<h4>2.1	Inschrijven</h4>
<p>De docent dient zich in te schrijven voor bepaalde activiteiten waaraan hij/zij kan deelnemen op het personeelsfeest. Als de administrator bijvoorbeeld tennis en minigolf aan de activiteitenlijst heeft toegevoegd, kan de docent zich hiervoor inschrijven door in de navigatiebalk te klikken op ‘inschrijvingen’. Hier krijgt hij/zij een lijst te zien van alle activiteiten met daarnaast een knop ‘inschrijven’. Als hij/zij ingeschreven is, verschijnt er de knop ‘uitschrijven’ waarmee hij/zij zich weer kan uitschrijven.
</p>
<h4>2.2	Vrijwilligers toevoegen</h4>
<p>Er zijn een aantal vrijwilligers nodig die het personeelsfeest in goede banen leiden. Het is mogelijk dat docenten aan vrienden of familie vragen of ze eventueel een handje willen toesteken op het personeelsfeest. De docent klikt dan in de navigatiebalk op de knop ‘vrijwilligers toevoegen’. Hier vult hij/zij de gegevens van persoon in die zich wil opgeven als vrijwilliger. Als hij/zij op doorgaan klikt, zal de nieuwe vrijwilliger een mail toegezonden krijgen. Hierin kan hij analoog aan de docenten op de unieke link klikken zodat hij/zij het systeem ook kan gebruiken.
</p>
<h2>3.	Helper</h2>
<p>Ook de helpers zullen de webapplicatie gebruiken. Zij hebben deze nodig omdat ze online kunnen aanduiden wanneer ze kunnen en willen helpen alsook welke functie ze wensen uit te voeren.
</p>
<h4>3.1	Inschrijven voor shift<h4/>
<p>De helper klikt in de navigatiebalk op ‘inschrijven’. Hij/zij krijgt dan een pagina te zien waar alle activiteiten waarvoor men helpers nodig heeft, staan opgelijst. Ook voor het eten heeft men hulp nodig. Dit wordt ook op deze pagina weergegeven, onder de activiteiten. Analoog aan de docenten, kan de helper op ‘inschrijven’ klikken. Als hij dit doet, wordt de knop oranje en staat er ‘uitschrijven’ op vermeld. Hij/zij kan zich dus ook weer uitschrijven door hierop te klikken. 
</p>
<p>Wellicht is het voor de helper leuker om een shift te werken wanneer iemand bekend op dezelfde plek op hetzelfde uur werkt. Om die reden hebben we een knop geïmplementeerd ‘vrijwilligers’. Als hij/zij hierop klikt, kan hij kijken welke helpers allemaal ingeschreven zijn voor die bepaalde activiteit. 
</p>
      </div>
    </div>
  </div>
</div>
                </ul>
            </div>
        </div>
    </nav>
