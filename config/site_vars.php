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
    'platformName' => 'DaZ-Buddy',
    'adminEmail' => 'admin@sitename.com'
];

