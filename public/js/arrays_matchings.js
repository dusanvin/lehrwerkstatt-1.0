_feedback = [
    {value: 1, text: "ist sehr behutsam."},
    {value: 2, text: "ist eher behutsam."},
    {value: 3, text: "ist manchmal behutsam, manchmal direkt."},
    {value: 4, text: "ist eher direkt."},
    {value: 5, text: "ist sehr direkt."}
]

_zutreffend = [
    {value: 1, text: "Trifft überhaupt nicht zu."},
    {value: 2, text: "Trifft eher nicht zu."},
    {value: 3, text: "Teils, teils."},
    {value: 4, text: "Trifft eher zu."},
    {value: 5, text: "Trifft voll und ganz zu."}
]

_freiraum_lehr = [
    {value: 1, text: "eher Freiraum für eigene Ideen und Entscheidungen möchte."},
    {value: 2, text: "teils Freiraum, teils klare Anweisungen von mir möchte."},
    {value: 3, text: "eher klare Anweisungen von mir möchte."}
]

_freiraum_stud = [
    {value: 1, text: "mir eher Freiraum für eigene Ideen und Entscheidungen lässt."},
    {value: 2, text: "mir teils Freiraum lässt, teils klare Anweisungen gibt."},
    {value: 3, text: "mir eher klare Anweisungen gibt."}
]


_berufserfahrung = [
    {value: 1, text: "maximal einem Jahr."},
    {value: 2, text: "mehr als einem Jahr und maximal 3 Jahren."},
    {value: 3, text: "mehr als drei Jahren und maximal 10 Jahren."},
    {value: 4, text: "mehr als 10 Jahren."},
]


function exportMatchingsCSV() {

    let csv = [
        
        [
            'Liste aller Matchings nach Status aufgelistet. (L): Spalte nur für Lehrkräfte, (S): Spalte nur für Studenten'
        ],

        [],
            
        [
            'Matchingnummer',
            'Rolle',
            'Anrede',
            'Nachname',
            'Vorname',
            'E-Mail-Adresse',
            'Telefonnummer',
    
            'Wunschtandem',

            'Schulart',
            'Nur Realschule und Gymnasium: Fächer',

            'Matchingstatus',

            // nur lehrer
            '(L) Landkreis der Schule',
            '(L) Name der Schule',
            '(L) Straße',
            '(L) Hausnummer',
            '(L) Postleitzahl',
            '(L) Ort',
    
            '(L) Zustimmung der Schulleitung',
            '(L) Vor- und Nachname der Schulleitung',
            '(L) E-Mail-Adresse der Schulleitung',

            '(L) Registrierungscode:',

            '(L) Ihre Berufserfahrung: Ich bin Lehrer*in seit',

            // nur studenten
            '(S) Wunschorte', 
            '(S) Pflichtpraktika',
            '(S) Ich befinde mich im Wintersemester 2024/25 in meinen für das Matching gewählten Fächern mindestens in folgendem Fachsemester:',
            '(S) Nur Realschule und Gymnasium: Ehemalige Schule',
            '(S) Nur Realschule und Gymnasium: Ehemaliger Schulort',
            '(S) Nur Grundschule: Studieren Sie das Didaktikfach ev./kath. Religionslehre?',
            '(S) Ich kann die Lehr:werkstatt in folgenden Landkreisen ableisten (Mehrfachauswahl möglich)',
            '(S) Bitte geben Sie an, welche Verkehrsmittel Ihnen zur Verfügung stehen (Mehrfachauswahl möglich)',
            '(S) Welche(s) der folgenden Praktika haben Sie im Rahmen Ihres Lehramtsstudiums bereits absolviert?',
    
            'Bereits teilgenommen',
            'Bestätigung: Verbindliche Teilnahmebedingungen',
            'Bestätigung: Datenschutzhinweise und datenschutzrechtliche Einwilligungserklärung',
            'Bestätigung: Teilnahmebedingungen',
    
            'Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe / Das Feedback, das mir mein*e Lehr:mentor*in gibt, sollte,',
            'Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht / Beim Feedback, das ich meinem Lehr:mentor bzw. meiner Lehr:mentorin gebe, sage ich ganz direkt, was ich von seinem bzw. ihrem Unterricht halte',
            'Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen / Ich möchte langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen',
            'Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden',
            'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der / Ich wünsche mir eine*n Lehr:mentor*in, die bzw. der',
            'Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren / Ein großer Erfahrungsschatz ist mir bei meinem Lehr:mentor bzw. meiner Lehr:mentorin wichtiger als die Neigung, Neues auszuprobieren',
            'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut / Ich traue mir zu, mit meinem Lehr:mentor bzw. meiner Lehr:mentorin in „schwierigen“ oder höheren Klassen zu unterrichten.',
            'Wodurch sind Sie auf das Projekt aufmerksam geworden? (Mehrfachauswahl möglich)',
            'Ich freue mich im Rahmen der Lehr:werkstatt besonders auf (Mehrfachauswahl möglich)',
            'Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?',

        ],

        [],

        ['Angenommene Matchings'],
    
    ];
    
    index = 0;
    window['matchings'].forEach(user => {

        if(index == window['accepted_matchings_count']*2) {
            csv.push([]);
            csv.push(['Ausstehende Matchings']);
        }

        if(index == (parseInt(window['accepted_matchings_count']) + parseInt(window['notified_matchings_count']))*2) {
            csv.push([]);
            csv.push(['Abgelehnte Matchings']);
        }

        if(user.role == 'Lehr') {
            if(user.survey_data) {
                row = [
                    user.matchingnummer,
                    user.role,
                    user.survey_data.anrede, 
                    user.nachname, 
                    user.vorname, 
                    user.email, 
                    user.survey_data.telefonnummer,
        
                    user.survey_data.wunschtandem,
                    
                    user.survey_data.schulart,
                    user.survey_data.faecher,
    
                    user.matching_status,
    
                    // nur lehrer
                    user.survey_data.landkreis,
                    user.survey_data.schulname,
                    user.survey_data.strasse,
                    user.survey_data.hausnummer,
                    user.survey_data.postleitzahl,
                    user.survey_data.ort,
                    
                    user.survey_data.zustimmung_schul,
                    user.survey_data.name_schul,
                    user.survey_data.email_schul,
                    
                    user.survey_data.registrierungscode,
                    _berufserfahrung[user.survey_data.berufserfahrung - 1].text,
    
                    // nur studenten, 9 spalten freilassen
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
    
                    user.survey_data.bereits_teilgenommen,
                    user.nutzungsbedingungen,
                    user.datenschutz,
                    user.survey_data.teilnahmebedingungen,
        
                    _feedback[user.survey_data.feedback_an - 1].text,
                    _feedback[user.survey_data.feedback_von- 1].text,
                    _zutreffend[user.survey_data.eigenstaendigkeit - 1].text,
                    _zutreffend[user.survey_data.improvisation - 1].text,
                    _freiraum_lehr[user.survey_data.freiraum - 1].text,
                    _zutreffend[user.survey_data.innovationsoffenheit - 1].text,
                    _zutreffend[user.survey_data.belastbarkeit - 1].text,
                    user.survey_data.aufmerksam_geworden,
                    user.survey_data.freue_auf,
                    user.survey_data.anmerkungen,
                ];
                csv.push(row);
                index++;
            }
        } else if(user.role == 'Stud') {
            if(user.survey_data) {
                row = [
                    user.matchingnummer,
                    user.role,
                    user.survey_data.anrede, 
                    user.nachname, 
                    user.vorname, 
                    user.email, 
                    user.survey_data.telefonnummer,
        
                    user.survey_data.wunschtandem,
                    
                    user.survey_data.schulart,
                    user.survey_data.faecher,
    
                    user.matching_status,
    
                    // nur lehrer
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    
                    '',
                    '',
                    '',

                    
                    '',
                    '',
    
                    // nur studenten
                    user.survey_data.wunschorte,
                    user.survey_data.pflichtpraktika,
                    user.survey_data.fachsemester,
                    user.survey_data.ehem_schulname,
                    user.survey_data.ehem_schulort,
                    user.survey_data.religionslehre,
                    user.survey_data.landkreise,
                    user.survey_data.verkehrsmittel,
                    user.survey_data.praktika,
    
                    user.survey_data.bereits_teilgenommen,
                    user.nutzungsbedingungen,
                    user.datenschutz,
                    user.survey_data.teilnahmebedingungen,
        
                    _feedback[user.survey_data.feedback_an - 1].text,
                    _feedback[user.survey_data.feedback_von- 1].text,
                    _zutreffend[user.survey_data.eigenstaendigkeit - 1].text,
                    _zutreffend[user.survey_data.improvisation - 1].text,
                    _freiraum_stud[user.survey_data.freiraum - 1].text,
                    _zutreffend[user.survey_data.innovationsoffenheit - 1].text,
                    _zutreffend[user.survey_data.belastbarkeit - 1].text,
                    user.survey_data.aufmerksam_geworden,
                    user.survey_data.freue_auf,
                    user.survey_data.anmerkungen,
                ];
                csv.push(row);
                index++;
            }
        }
    });


    _file = '';
    csv.forEach( row => _file += row.join(";") + "\n" )
    file = new Blob([_file], {type: 'text/csv;charset=utf-8'})

    url = URL.createObjectURL(file);
    csv_link = document.getElementById('csv_link_matchings');
    csv_link.setAttribute('href', url);
    csv_link.setAttribute('download', 'Matchings.csv');

}