<!-- Footer -->

<footer class="footer relative pt-1 sm:pt-5 md:pt-10 max-w-7xl mx-auto">

    <!-- Container Grid -->

    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto divide-y divide-gray-200 px-4 sm:px-6 md:px-8 mt-8">

        <!-- Grid -->

        <ul class="text-center Footer_nav__2rFid text-xs md:text-sm font-medium pb-6 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-6 sm:gap-y-10">

            <!-- Informationen -->

            <li class="space-y-2 sm:space-y-3 row-span-2 px-4">

                <p class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                    Informationen

                </p>

                <ul class="space-y-1">

                    <li>

                        <p class="text-gray-500 transition-colors duration-200 font-normal">

                            ALPHA-Version 0.1: 06/2022

                        </p>

                        <p class="text-gray-500 transition-colors duration-200 font-normal mt-2">

                            <em>{{ Config::get('site_vars.platformName1') }}{{ Config::get('site_vars.platformName2') }}</em> ist eine Plattform des DigiLLab der Uni Augsburg, um Tandems im Rahmen des Projekts <em>Augsburger {{ Config::get('site_vars.platformName1') }}{{ Config::get('site_vars.platformName2') }}</em> zu bilden.

                        </p>

                        <p class="text-gray-500 transition-colors duration-200 font-normal mt-2 mr-2">

                            <em>{{ Config::get('site_vars.platformName1') }}{{ Config::get('site_vars.platformName2') }}</em> von <strong>Vincent Dusanek</strong> und <strong>Norman Szabo</strong> für <strong>DigiLLab</strong>, 2022. MIT-Lizenz.

                        </p>

                    </li>

                </ul>

            </li>

            <!-- Informationen -->

            <!-- Organisation -->

            <li class="space-y-2 sm:space-y-3 row-span-2 px-4">

                <p class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                    Organisation
                </p>

                <ul class="space-y-1">

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://digillab.zlbib.uni-augsburg.de" target="_blank">

                            DigiLLab

                        </a>

                    </li>

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://www.uni-augsburg.de/zlbib/lehrwerkstatt" target="_blank">

                        {{ Config::get('site_vars.platformName1') }}{{ Config::get('site_vars.platformName2') }}

                        </a>

                    </li>

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://www.uni-augsburg.de/de/" target="_blank">

                        Univeristät Augsburg

                        </a>

                    </li>

                </ul>

            </li>

            <!-- Organisation -->

            <!-- Über -->

            <li class="space-y-2 sm:space-y-3 row-span-2 px-4">

                <p class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                    Über

                </p>

                <ul class="space-y-1">

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://digillab.zlbib.uni-augsburg.de/impressum/" target="_blank">

                            Impressum

                        </a>

                    </li>

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://www.uni-augsburg.de/de/impressum/datenschutz/" target="_blank">

                            Datenschutz
                        </a>

                    </li>

                </ul>

            </li>

            <!-- Über -->

            <!-- Allgemein -->

            <li class="space-y-2 sm:space-y-3 row-span-2 px-4">

                <p class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                    Allgemein

                </p>

                <ul class="space-y-1">

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="/about" target="_blank">

                            Näheres zum <em>digi:match</em>

                        </a>

                    </li>

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-bold" href="/faq" target="_blank">

                            FAQ zum <em>digi:match</em>

                        </a>

                    </li>

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="{{ $mail_to_digillab }}">

                            Kontakt

                        </a>

                    </li>

                    <li>

                        <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="/log" target="_blank">

                            Log

                        </a>

                    </li>

                </ul>

            </li>

            <!-- Allgemein -->

        </ul>

        <!-- Grid -->

    </div>

    <!-- Container Grid -->

</footer>

<!-- Footer -->