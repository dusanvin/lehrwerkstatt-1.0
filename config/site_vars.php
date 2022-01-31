<?php

/*

Access in Controller via: Config::get('site_vars.supportEmail') 
Access in view via: {{ Config::get('site_vars.supportEmail') }}

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
    'adminEmail' => 'admin@sitename.com'
];

