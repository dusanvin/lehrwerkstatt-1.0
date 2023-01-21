<div x-data="{ modalOpen: false }" class="flex flex-wrap mr-2 mb-2">

    <button @click="modalOpen =!modalOpen"
        class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 max-h-9 hover:scale-105 transform">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6">
            </path>
        </svg>

        <span>{{ $text }}</span>

    </button>

    <!-- modalOpen -->

    <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true" style="display: none;">

        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

            <div @click="modalOpen = false" x-show="modalOpen"
                x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                style="display: none;">
            </div>

            <!-- modalOpen -->

            <!-- modalOpen x-cloak -->

            <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-gray-700 inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                style="display: none;">

                <!-- modalOpen x-cloak -->

                <!-- ModelInner -->

                <h3 class="text-xs font-medium text-white uppercase mt-4">
                    Student*in ({{ $stud->data()->schulart }})
                </h3>

                <div class="w-96 mt-2">

                    <div class="text-xs sm:text-sm leading-5 font-medium text-white w-64 text-gray-400">

                        <p>{{ $stud->vorname }} {{ $stud->nachname }}</p>
                        <a href="mailto:stark.jennie@example.net"
                            class="text-gray-400 hover:text-gray-100 break-words">{{ $stud->email }}</a>
                        <br>
                        <br>
                        <p> Wunschtandem:
                            {{ $stud->data()->wunschtandem ?? '-' }}
                        </p>
                        <p> Wunschorte:
                            {{ $stud->data()->wunschorte ?? '-' }}
                        </p>
                        <p> Ehem. Schulort:
                            {{ $stud->data()->ehem_schulort ?? '-' }}
                        </p>
                        <br>
                        <p> Anmerkungen:
                            {{ $stud->data()->anmerkungen ?? '-' }}
                        </p>

                    </div>

                </div>

                <h3 class="text-xs font-medium text-white uppercase mt-4">
                    Lehrer*in ({{ $lehr->data()->schulart }})
                </h3>

                <div class="w-96 mt-2">

                    <div class="text-xs sm:text-sm leading-5 font-medium text-white w-64 text-gray-400">

                        <p>{{ $lehr->vorname }} {{ $lehr->nachname }}</p>
                        <a href="mailto:hermiston.karianne@example.com"
                            class="text-gray-400 hover:text-gray-100 break-words">hermiston.karianne@example.com</a>
                        <br>
                        <br>
                        <p> Wunschtandem:
                            {{ $lehr->data()->wunschtandem ?? '-' }}
                        </p>
                        <p> Bereits teilgenommen:
                            {{ $lehr->data()->bereits_teilgenommen ?? '-' }}
                        </p>
                        <br>
                        <p> Name der Schule:</p>
                        <p>
                            {{ $lehr->data()->schulname ?? '-' }}
                        </p>
                        <p> Ort:
                            {{ $lehr->data()->ort ?? '-' }}
                        </p>
                        <p> Landkreis:
                            {{ $lehr->data()->landkreis ?? '-' }}
                        </p>

                    </div>

                </div>

                <div class="mt-4">

                    <h3 class="text-xs font-medium text-white uppercase">Mean
                        Square
                        Error (MSE)</h3>

                    <div class="pb-2 w-96 mt-2">

                        <div class="text-xs sm:text-sm leading-5 font-medium text-white w-64 text-gray-400">

                            {{ $mse }}

                        </div>

                    </div>

                    <div>

                        <h3 class="text-xs font-medium text-white uppercase">
                            Attribute zur Berechnung
                            des MSE</h3>

                        <div class="pb-2 w-96 text-sm text-gray-400 mt-2">

                            <p>

                                Feedback Lehrkraft zu Student*in [Abweichung 0
                                bis
                                5]:
                                {{ abs($lehr->data()->feedback_an - $stud->data()->feedback_von) }}

                            </p>

                            <p>

                                Feedback Student*in zu Lehrkraft [Abweichung 0
                                bis
                                5]:
                                {{ abs($lehr->data()->feedback_von - $stud->data()->feedback_an) }}

                            </p>

                            <p>

                                Eigenstaendigkeit [Abweichung 0 bis 5]**:
                                {{ abs($lehr->eigenstaendigkeit - $stud->data()->eigenstaendigkeit) }}

                            </p>

                            <p>

                                Improvisation [Abweichung 0 bis 5]:
                                {{ abs($lehr->data()->improvisation - $stud->data()->improvisation) }}

                            </p>

                            <p>

                                Freiraum [Abweichung 0 bis 3]:
                                {{ abs($lehr->data()->freiraum - $stud->data()->freiraum) }}

                            </p>

                            <p>

                                Innovationsoffenheit [Abweichung 0 bis 5]:
                                {{ abs($lehr->data()->innovationsoffenheit - $stud->data()->innovationsoffenheit) }}

                            </p>

                            <p>

                                Belastbarkeit [Abweichung 0 bis 5]:**
                                {{ abs($lehr->data()->belastbarkeit - $stud->data()->belastbarkeit) }}

                            </p>

                        </div>

                    </div>

                    <p class="text-gray-400 text-xs mt-2">Umso kleiner der
                        Wert,
                        umso geringer die
                        Abweichung. Attribute mit ** fließen stärker in die
                        Gewichtung mit ein.</p>

                </div>



                <div class="flex justify-end mt-6">

                    <button @click="modalOpen =!modalOpen"
                        class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:bg-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50 max-h-9 transform duration-150 hover:scale-105 transition-colors">
                        <p>Schließen</p>

                    </button>

                </div>



                <!-- ModelInner -->

            </div>

        </div>

    </div>

</div>
