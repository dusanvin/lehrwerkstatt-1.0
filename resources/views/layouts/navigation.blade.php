<style type="text/css">
    #navigation-digillab {
        transition: width 0.2s
    }
</style>

<nav class="bg-top bg-gray-700 w-80 justify-between flex flex-col sm:rounded-l-lg shadow-b transition ease-in-out duration-150"
    id="navigation-digillab">

    <div class="mt-10 mb-10">

        <!-- Toggle-Menu -->

        <script type="text/javascript">
            function menufunction() {

                if (document.getElementById("navigation-digillab").style.width != "67px") {

                    var elements = document.getElementsByClassName('navigation-element'),
                        i, len;

                    for (i = 0, len = elements.length; i < len; i++) {
                        elements[i].style.display = 'none';
                    }

                    document.getElementById("navigation-digillab").style.width = "67px";
                    localStorage.setItem('menu', 'false');
                    return;

                } else if (document.getElementById("navigation-digillab").style.width == "67px") {

                    var elements = document.getElementsByClassName('navigation-element'),
                        i, len;

                    setTimeout(function() {
                        for (i = 0, len = elements.length; i < len; i++) {
                            elements[i].style.display = 'block';
                        }
                    }, 100)

                    document.getElementById("navigation-digillab").style.width = "322px";
                    localStorage.setItem('menu', 'true');
                    return;
                }
            }
        </script>

        <button onclick="menufunction()" class="float-right text-white focus:outline-none hover:text-gray-400"
            id="testcolor">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 float-right mr-5" viewBox="0 0 20 20"
                fill="currentColor">

                <path
                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />

            </svg>

        </button>

        <!-- Toggle-Menu -->

        <div class="mt-10 pt-3">

            <p
                class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">
                Allgemeines</p>

            <ul>

                <!-- Bewerbungsformular -->

                <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                    @php
                        $route_name = 'profile.edit';
                    @endphp

                    <a href="{{ route($route_name) }}"
                        class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                        <div>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>


                        </div>

                        <div class="pl-3">
                            @role('Admin|Moderierende')
                                <p class="navigation-element text-sm font-semibold">Mitgliedsdaten</p>
                            @endrole
                            @role('Lehr|Stud')
                                <p class="navigation-element text-sm font-semibold">Bewerbungsformular</p>
                            @endrole
                            <!--<p class="navigation-element text-xs">Jahrgang 2022/2023</p>-->

                        </div>

                    </a>

                </li>

                <!-- Bewerbungsformular -->

                <!-- Account -->

                <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                    @php
                        $route_name = 'profile.account';
                    @endphp

                    <a href="{{ route($route_name) }}"
                        class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                        <div>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>


                        </div>

                        <div class="pl-3">

                            <p class="navigation-element text-sm font-semibold">Account</p>

                            <!--<p class="navigation-element text-xs">E-Mail und Passwort</p>-->

                        </div>

                    </a>

                </li>

                <!-- Account -->

                <!-- Vorschläge -->

                @role('Lehr|Stud')
                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'profile.matchings';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <!-- 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                </svg>
                            -->

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                </svg>


                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">Tandemvorschläge
                                    ({{ isset(Auth::user()->notified_user) ? 1 : 0 }})</p>

                                <!--<p class="navigation-element text-xs">E-Mail und Passwort</p>-->

                            </div>

                        </a>

                    </li>
                @endrole

                <!-- Vorschläge -->

                <!-- Nachrichten -->

                <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                    @php
                        $route_name = 'messages';
                    @endphp

                    <a href="{{ route($route_name) }}"
                        class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                        <div>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                            </svg>

                        </div>

                        <div class="pl-3">

                            <p class="navigation-element text-sm font-semibold">
                                {{ Config::get('site_vars.nachrichten') }}</p>

                            <!--<p class="navigation-element text-xs">{{ Config::get('site_vars.nachrichtenInfo') }}</p>-->

                        </div>

                    </a>

                </li>

                <!-- Nachrichten -->

            </ul>

            @role('Admin|Moderierende')
                <p
                    class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">
                    Administration</p>

                <ul>

                    <!-- Statistiken -->

                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'stats';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">{{ Config::get('site_vars.stats') }}</p>

                                <!--<p class="navigation-element text-xs">{{ Config::get('site_vars.statsInfo') }}</p>-->

                            </div>

                        </a>

                    </li>

                    <!-- Statistiken -->

                    <!-- Verwaltung -->

                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'users.index';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">
                                    {{ Config::get('site_vars.verwaltung') }}</p>

                                <!--<p class="navigation-element text-xs">{{ Config::get('site_vars.verwaltungInfo') }}</p>-->

                            </div>

                        </a>

                    </li>

                    <!-- Verwaltung -->

                    <!-- Vorschläge -->

                    <!-- <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'users.matchings';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zm-7.518-.267A8.25 8.25 0 1120.25 10.5M8.288 14.212A5.25 5.25 0 1117.25 10.5" />
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">
                                    {{ Config::get('site_vars.vorschlaege') }}</p>

                            </div>

                        </a>

                    </li> -->

                    <!-- Vorschläge -->

                    <!-- Vorschläge NEU -->

                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'users.matchable';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zm-7.518-.267A8.25 8.25 0 1120.25 10.5M8.288 14.212A5.25 5.25 0 1117.25 10.5" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">Tandemvorschläge</p>

                            </div>

                        </a>

                    </li>

                    <!-- Vorschläge NEU -->

                    <!-- Tandems -->

                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'acceptedMatchings';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">
                                    Tandems</p>

                                <!--<p class="navigation-element text-xs">{{ Config::get('site_vars.vorschlaegeInfo') }}</p>-->

                            </div>

                        </a>

                    </li>

                    <!-- Tandems -->

                </ul>
            @endrole

            @role('Admin|Moderierende')
                <p
                    class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">
                    Angebote</p>

                <!-- Lehrkräfte -->

                <ul>

                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'users.lehr';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">
                                    {{ Config::get('site_vars.angebote') }}</p>

                                <!--<p class="navigation-element text-xs">{{ Config::get('site_vars.angeboteInfo') }}</p>-->

                            </div>

                        </a>

                    </li>

                    <!-- Lehrkräfte -->

                    <!-- Student*innen -->

                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'users.stud';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">{{ Config::get('site_vars.bedarfe') }}
                                </p>

                                <!--<p class="navigation-element text-xs">{{ Config::get('site_vars.bedarfeInfo') }}</p>-->

                            </div>

                        </a>

                    </li>

                    <!-- Student*innen -->

                    <!-- Wunschpaarungen -->

                    <li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">
                        @php
                            $route_name = 'matchings.preferences';
                        @endphp

                        <a href="{{ route($route_name) }}"
                            class="text-gray-300 hover:text-white px-4 py-2 flex items-center rounded-l-md rounded-r-md transition-colors duration-200 transform duration-150 hover:scale-105 @if (Request::routeIs($route_name)) { text-yellow-400 } @endif">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zm-7.518-.267A8.25 8.25 0 1120.25 10.5M8.288 14.212A5.25 5.25 0 1117.25 10.5" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="navigation-element text-sm font-semibold">
                                    {{ Config::get('site_vars.grundschule') ?? 'Wunschpaarungen' }}</p>

                                <!--<p class="navigation-element text-xs">{{ Config::get('site_vars.vorschlaegeInfo') }}</p>-->

                            </div>

                        </a>

                    </li>

                    <!-- Wunschpaarungen -->

                </ul>
            @endrole

        </div>

    </div>

    <!-- Ausloggen Button -->

    <form action="{{ route('logout') }}" method="post" class="mb-2 mx-auto">

        @csrf

        <button
            class="mx-auto flex text-xs items-center p-1 md:p-3 text-gray-300 hover:text-yellow-400 focus:border-transparent focus:outline-none transition-colors duration-200 transform duration-150 hover:scale-105"
            type="submit">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            <span class="navigation-element ml-1">Ausloggen</span>

        </button>

    </form>

    <!-- Ausloggen Button -->

    <script>
        if (localStorage.getItem('menu') == null) {
            localStorage.setItem('menu', 'true');
        }

        if (localStorage.getItem('menu') == 'false') {
            menufunction();
        }
    </script>

</nav>
