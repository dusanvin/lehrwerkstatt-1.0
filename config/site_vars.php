<?php

/*

Access in Controller via: Config::get('site_vars.supportEmail') 
Access in view via: {{ Config::get('site_vars.welcomeString1') }}

Lookup:
https://stackoverflow.com/questions/25189427/global-variable-for-all-controller-and-views

return [
    'supportEmail' => 'email@gmail.com',
    'adminEmail' => 'admin@sitename.com'
];

*/

return [

	/* header.blade.php */
    'platformName1' => 'Lehr:',
    'platformName2' => 'werkstatt',

    /* maintenance */
    'jahrgang' => '2025/26',
    'host' => 'https://lehrwerkstatt.digillab.uni-augsburg.de',
    'datenschutzhinweise' => 'https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/datenschutzhinweise/',
    'datenschutz_einwilligung' => 'https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/datenschutzrechtliche-einwilligungserklarung/',
    'teilnahmebedingungen' => 'https://lehrwerkstatt.digillab.uni-augsburg.de/Verbindliche_TN-Bedingungen_UniA_2025.pdf',



    /* welcome.blade.php*/
    'welcomeString1' => 'Finden Sie Ihre*n',
    'welcomeString2' => 'Tandempartner*in',
    'welcomeImg' => '../img/Lehrwerkstatt_Puzzle.jpg',

    /* footer.blade.php */
    'adminEmail' => 'admin@sitename.com',

    /* navigation.blade.php */
    'meinBereich' => 'Visitenkarte',
    'meinBereichInfo' => 'Für Mitglieder öffentliche Informationen',

    'nachrichten' => 'Nachrichten',
    'nachrichtenInfo' => 'Gespräche und Kontakte',

    'stats' => 'Statistiken',
    'statsInfo' => 'Details zum Portal',

    'verwaltung' => 'Verwaltung',
    'verwaltungInfo' => 'Nutzende und Rollen',

    'angebote' => 'Lehrkräfte',
    'angeboteInfo' => 'von Lehrkräften',

    'bedarfe' => 'Student*innen',
    'bedarfeInfo' => 'von Student*innen',

    'vorschlaege' => 'Vorschläge',
    'vorschlaegeInfo' => 'mögliche Tandems',

    'paarungen' => 'Tandems',
    'paarungenInfo' => 'feste Tandems',

    /* MeinBereich */
    'meinBereichMotivation' => 'Bearbeiten Sie Ihre Daten und stellen Sie sich vor.',

    'meinBereichMotivationDetails' => 'Was hat Sie dazu bewogen, DaZ-Buddy zu werden?',
    'meinBereichMotivationDetailsPlaceholder' => 'Erläutern Sie Ihre Motivationsgründe.',

    'meinBereichStudiengang' => 'Welchen Studiengang studieren Sie?',
    'meinBereichStudiengangPlaceholder' => 'Geben Sie Ihren Studiengang an.',

    'meinBereichFachsemester' => 'Im wievielten (Fach-)Semester befinden Sie sich?',
    'meinBereichFachsemesterPlaceholder' => 'Geben Sie Ihr aktuelles (Fach-)Semester an.',

    'meinBereichFreizeit' => 'Was machen Sie gerne in ihrer Freizeit?',
    'meinBereichFreizeitPlaceholder' => 'Geben Sie Ihre Interessen an.',

    'meinBereichErfahrung' => 'Haben Sie schon Erfahrungen im DaZ/DaF-Bereich, im Rahmen von anderen Praktika, sammeln können?',
    'meinBereichErfahrungPlaceholder' => 'Nennen Sie Erfahrungen, die relevant sein könnten.',

    'meinBereichTreffen' => 'Was könnten Sie sich vorstellen mit dem/der Schüler*in während der Treffen zu machen?',
    'meinBereichTreffenPlaceholder' => 'Schlagen Sie Möglichkeiten der Zusammenarbeit vor.',

    'meinBereichGruesse' => 'Welche Grüße möchten Sie an Ihre Profilbesucher*innen richten?',
    'meinBereichGruessePlaceholder' => 'Hinterlegen Sie freundliche Grüße für Ihre Profilbesucher.',

    /* components/auth-card.blade.php */
    'backgroundImageAuth' => '../img/lehr_login.jpg',

    'adminEmail' => 'admin@sitename.com'
];

