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

_freiraum = [
    {value: 1, text: "mir eher Freiraum für eigene Ideen und Entscheidungen lässt."},
    {value: 2, text: "mir teils Freiraum lässt, teils klare Anweisungen gibt."},
    {value: 3, text: "mir eher klare Anweisungen gibt."}
]


function exportStudCSV(schulart) {

    let csv = [

        [
            'Liste aller Studierenden mit vollständigem Bewerbungsformular, die im aktuellen Matchingverfahren teilnehmen und einen Vorschlag erwarten.'
        ],
        
        [
        // 'Bewerbungsformular ist vollständig ausgefüllt und für das aktuelle Schuljahr ist eine Teilnahme weiterhin erwünscht',
        // 'Der Student/Die Studentin befindet sich in keiner Vorauswahl und steht zur Verfügung',

        'Anrede',
        'Nachname',
        'Vorname',
        'Universitäre E-Mail-Adresse',
        'Telefonnummer',

        'Optional: Name des Wunschtandempartners bzw. der Wunschtandempartnerin',
        'Optional: Wunschort/e',

        'Pflichtpraktika',
        'Schulart', 
        'Ich befinde mich im Wintersemester 2023/24 in meinen für das Matching gewählten Fächern mindestens in folgendem Fachsemester:',
        'Nur Realschule und Gymnasium: Fächer',
        'Nur Realschule und Gymnasium: Ehemalige Schule',
        'Nur Realschule und Gymnasium: Ehemaliger Schulort',
        'Nur Grundschule: Studieren Sie das Didaktikfach ev./kath. Religionslehre?',
        'Ich kann die Lehr:werkstatt in folgenden Landkreisen ableisten (Mehrfachauswahl möglich)',
        'Bitte geben Sie an, welche Verkehrsmittel Ihnen zur Verfügung stehen (Mehrfachauswahl möglich)',
        
        'Bereits teilgenommen',
        'Bestätigung: Datenschutz',
        'Bestätigung: Verbindliche Teilnahmebedingungen',    

        'Das Feedback, das mir mein*e Lehr:mentor*in gibt, sollte',
        'Beim Feedback, das ich meinem Lehr:mentor bzw. meiner Lehr:mentorin gebe, sage ich ganz direkt, was ich von seinem bzw. ihrem Unterricht halte',
        'Ich möchte langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen',
        'Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden',
        'Ich wünsche mir eine*n Lehr:mentor*in, die bzw. der',
        'Ein großer Erfahrungsschatz ist mir bei meinem Lehr:mentor bzw. meiner Lehr:mentorin wichtiger als die Neigung, Neues auszuprobieren',
        'Ich traue mir zu, mit meinem Lehr:mentor bzw. meiner Lehr:mentorin in „schwierigen“ oder höheren Klassen zu unterrichten.',
        'Welche(s) der folgenden Praktika haben Sie im Rahmen Ihres Lehramtsstudiums bereits absolviert?',
        'Wodurch sind Sie auf das Projekt aufmerksam geworden? (Mehrfachauswahl möglich)',
        'Ich freue mich im Rahmen der Lehr:werkstatt besonders darauf, (Mehrfachauswahl möglich)',
        'Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?',
    ]];

    window['stud_' + schulart.toLowerCase()].forEach(user => {
        
        row = [
            // user.is_evaluable ? 'Ja' : 'Nein',
            // user.is_available ? 'Ja' : 'Nein',

            user.survey_data.anrede, 
            user.nachname, 
            user.vorname, 
            user.email, 
            user.survey_data.telefonnummer,

            user.survey_data.wunschtandem,
            user.survey_data.wunschorte,

            user.survey_data.pflichtpraktika,
            user.survey_data.schulart,
            user.survey_data.fachsemester,
            user.survey_data.faecher,
            user.survey_data.ehem_schulname,
            user.survey_data.ehem_schulort,
            user.survey_data.religionslehre,
            user.survey_data.landkreise,
            user.survey_data.verkehrsmittel,

            user.survey_data.bereits_teilgenommen,
            user.survey_data.datenschutz,
            user.survey_data.teilnahmebedingungen,

            _feedback[user.survey_data.feedback_an - 1].text,
            _feedback[user.survey_data.feedback_von- 1].text,
            _zutreffend[user.survey_data.eigenstaendigkeit - 1].text,
            _zutreffend[user.survey_data.improvisation - 1].text,
            _freiraum[user.survey_data.freiraum - 1].text,
            _zutreffend[user.survey_data.innovationsoffenheit - 1].text,
            _zutreffend[user.survey_data.belastbarkeit - 1].text,
            user.survey_data.praktika,
            user.survey_data.aufmerksam_geworden,
            user.survey_data.freue_auf,
            user.survey_data.anmerkungen
        ]

        csv.push(row);
    })

    _file = '';
    csv.forEach( row => _file += row.join(";") + "\n" )
    file = new Blob([_file], {type: 'text/csv;charset=utf-8'})

    url = URL.createObjectURL(file);
    csv_link = document.getElementById('csv_link_stud_' + schulart);
    csv_link.setAttribute('href', url);
    csv_link.setAttribute('download', 'Studierende' + schulart + '.csv')

}