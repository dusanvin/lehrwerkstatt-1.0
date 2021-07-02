<!-- General Inner Div -->

<div class="container px-5 pt-24 mx-auto">

    <!-- Heading -->

    <div class="flex flex-col text-center w-full mb-20">

        <h2 class="text-xs text-purple-500 tracking-widest font-medium title-font mb-1">FAQ</h2>

        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Sie haben Fragen? Wir geben Antworten!</em></h1>

        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">

            Erhalten Sie auf dieser Seite Antworten zu den häufigsten Fragen rund um das <em>digi:<strong>match</strong></em>. Melden Sie sich gerne bei Anregungen.

        </p>

    </div>    

    <!-- Heading -->

    <!-- Inhalt -->

    <div class="bg-gray-100 py-10">

        <div class="mx-auto max-w-6xl">

            <div class="p-2 bg-gray-100 rounded">

                <div class="flex flex-col md:flex-row">

                    <div class="md:w-1/3 p-4 text-sm">

                        <div class="text-3xl mb-4">Frequently asked <span class="font-medium">Questions</span></div>

                        <!-- <div class="my-2">Wie nutze ich die Plattform?</div> -->

                        <div class="text-xs text-gray-600">Nutzen Sie für nähere Informationen unser FAQ.<br>Kontaktieren Sie bei technischen Anliegen das <a href="mailto:digillab@zlbib.uni-augsburg.de" class="text-purple-500">DigiLLab</a>.</div>

                    </div>

                    <div class="md:w-2/3">

                        @include('faq.kontakt')

                        @include('faq.registrierung_anmeldung')

                        @include('faq.passwort')

                        @include('faq.portfolio')

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Inhalt -->

</div>

<!-- General Inner Div -->