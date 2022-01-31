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
    'platformName1' => 'daz-',
    'platformName2' => 'buddies',

    /* welcome.blade.php*/
    'welcomeString1' => 'Finden Sie Ihre*n',
    'welcomeString2' => 'DaZ-Buddy',
    'welcomeVideo' => '../img/welcome_start.mp4',

    /* footer.blade.php */
    'adminEmail' => 'admin@sitename.com',

    /* navigation.blade.php */
    'meinBereich' => 'Mein Bereich',
    'meinBereichInfo' => 'Persönliche Informationen',

    'nachrichten' => 'Nachrichten',
    'nachrichtenInfo' => 'Gespräche und Kontakte',

    'stats' => 'Statistiken',
    'statsInfo' => 'Details zum Portal',

    'verwaltung' => 'Verwaltung',
    'verwaltungInfo' => 'Nutzende und Rollen',

    'angebote' => 'Angebote',
    'angeboteInfo' => 'Hilfsangebot anbieten',

    'bedarfe' => 'Bedarfe',
    'bedarfeInfo' => 'Hilfsangebot ersuchen',

    /* MeinBereich */
    'meinBereichMotivation' => 'Bearbeiten Sie die Daten zu Ihrer Person und stellen Sie sich vor.',
    'meinBereichMotivationDetails' => 'Was hat Sie dazu bewogen, DaZ-Buddy zu werden?',
    'meinBereichStudiengang' => 'Welchen Studiengang studieren Sie?',

    /* components/auth-card.blade.php */
    'backgroundImageAuth' => '../img/welcome_picture.jpg',

    'adminEmail' => 'admin@sitename.com'
];

