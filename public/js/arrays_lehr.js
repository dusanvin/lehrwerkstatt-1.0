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
    {value: 1, text: "eher Freiraum für eigene Ideen und Entscheidungen möchte."},
    {value: 2, text: "teils Freiraum, teils klare Anweisungen von mir möchte."},
    {value: 3, text: "eher klare Anweisungen von mir möchte."}
]

_berufserfahrung = [
    {value: 1, text: "maximal einem Jahr."},
    {value: 2, text: "mehr als einem Jahr und maximal 3 Jahren."},
    {value: 3, text: "mehr als drei Jahren und maximal 10 Jahren."},
    {value: 4, text: "mehr als 10 Jahren."},
]


function exportCSV() {

    let csv = [[
        'Bestätigung: Datenschutz',
        'Bestätigung: Verbindliche Teilnahmebedingungen',
        'Registrierungscode:',                             
        'Bereits teilgenommen',
        'Bewerbungsformular ist vollständig ausgefüllt und für das aktuelle Schuljahr ist eine Teilnahme weiterhin erwünscht',
        'Die Lehrkraft befindet sich in keiner Vorauswahl und steht zur Verfügung',
        'Anrede',
        'Nachname',
        'Vorname',
        'E-Mail-Adresse',
        'Telefonnummer',
        'Zustimmung der Schulleitung',
        'Vor- und Nachname der Schulleitung',
        'E-Mail-Adresse der Schulleitung',
        'Schulart',
        'Nur Realschule und Gymnasium: Fächer',
        'Landkreis der Schule',
        'Name der Schule',
        'Straße',
        'Hausnummer',
        'Postleitzahl',
        'Ort',
        'Wunschtandem',
        'Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe,',
        'Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht',
        'Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen',
        'Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden',
        'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der',
        'Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren',
        'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut',
        'Ihre Berufserfahrung: Ich bin Lehrer*in seit',
        'Wodurch sind Sie auf das Projekt aufmerksam geworden? (Mehrfachauswahl möglich)',
        'Ich freue mich im Rahmen der Lehr:werkstatt besonders auf (Mehrfachauswahl möglich)',
        // 'Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?',
    ]];

    users.forEach(user => {
        
        row = [
            user.survey_data.datenschutz,
            user.survey_data.teilnahmebedingungen,
            user.survey_data.registrierungscode,
            user.survey_data.bereits_teilgenommen,
            user.is_evaluable ? 'Ja' : 'Nein',
            user.is_available ? 'Ja' : 'Nein',
            user.survey_data.anrede, 
            user.nachname, 
            user.vorname, 
            user.email, 
            user.survey_data.telefonnummer,
            user.survey_data.zustimmung_schul,
            user.survey_data.name_schul,
            user.survey_data.email_schul,
            user.survey_data.schulart,
            user.survey_data.faecher,
            user.survey_data.landkreis,
            user.survey_data.schulname,
            user.survey_data.strasse,
            user.survey_data.hausnummer,
            user.survey_data.postleitzahl,
            user.survey_data.ort,
            user.survey_data.wunschtandem,
            _feedback[user.survey_data.feedback_an - 1].text,
            _feedback[user.survey_data.feedback_von- 1].text,
            _zutreffend[user.survey_data.eigenstaendigkeit - 1].text,
            _zutreffend[user.survey_data.improvisation - 1].text,
            _freiraum[user.survey_data.freiraum - 1].text,
            _zutreffend[user.survey_data.innovationsoffenheit - 1].text,
            _zutreffend[user.survey_data.belastbarkeit - 1].text,
            _berufserfahrung[user.survey_data.berufserfahrung - 1].text,
            user.survey_data.aufmerksam_geworden,
            user.survey_data.freue_auf,
            // user.survey_data.anmerkungen
        ]

        csv.push(row);
    })

    _file = '';
    csv.forEach( row => _file += row.join(";") + "\n" )
    file = new Blob([_file], {type: 'text/csv;charset=utf-8'})

    url = URL.createObjectURL(file);
    csv_link = document.getElementById('csv_link');
    csv_link.setAttribute('href', url);
    csv_link.setAttribute('download', 'Lehrer.csv')

}


function exportLehrCSV(schulart) {

    let csv = [
        
    [
        'Liste aller Lehrkräfte mit vollständigem Bewerbungsformular, die im aktuellen Matchingverfahren teilnehmen und einen Vorschlag erwarten.'
    ],
        
    [
        // 'Bewerbungsformular ist vollständig ausgefüllt und für das aktuelle Schuljahr ist eine Teilnahme weiterhin erwünscht',
        // 'Die Lehrkraft wurde noch für kein Matching vorgeschlagen',
        'Anrede',
        'Nachname',
        'Vorname',
        'E-Mail-Adresse',
        'Telefonnummer',

        'Wunschtandem',

        'Schulart',
        'Nur Realschule und Gymnasium: Fächer',
        'Landkreis der Schule',
        'Name der Schule',
        'Straße',
        'Hausnummer',
        'Postleitzahl',
        'Ort',

        'Zustimmung der Schulleitung',
        'Vor- und Nachname der Schulleitung',
        'E-Mail-Adresse der Schulleitung',

        'Bereits teilgenommen',
        'Registrierungscode:',
        'Bestätigung: Datenschutz',
        'Bestätigung: Verbindliche Teilnahmebedingungen',

        'Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe,',
        'Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht',
        'Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen',
        'Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden',
        'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der',
        'Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren',
        'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut',
        'Ihre Berufserfahrung: Ich bin Lehrer*in seit',
        'Wodurch sind Sie auf das Projekt aufmerksam geworden? (Mehrfachauswahl möglich)',
        'Ich freue mich im Rahmen der Lehr:werkstatt besonders auf (Mehrfachauswahl möglich)',
        // 'Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?',
    ]];

    window['lehr_' + schulart.toLowerCase()].forEach(user => {
        
        row = [
            // user.is_evaluable ? 'Ja' : 'Nein',
            // user.is_available ? 'Ja' : 'Nein',

            user.survey_data.anrede, 
            user.nachname, 
            user.vorname, 
            user.email, 
            user.survey_data.telefonnummer,

            user.survey_data.wunschtandem,

            user.survey_data.schulart,
            user.survey_data.faecher,
            user.survey_data.landkreis,
            user.survey_data.schulname,
            user.survey_data.strasse,
            user.survey_data.hausnummer,
            user.survey_data.postleitzahl,
            user.survey_data.ort,

            user.survey_data.zustimmung_schul,
            user.survey_data.name_schul,
            user.survey_data.email_schul,

            user.survey_data.bereits_teilgenommen,
            user.survey_data.registrierungscode,
            user.survey_data.datenschutz,
            user.survey_data.teilnahmebedingungen,

            _feedback[user.survey_data.feedback_an - 1].text,
            _feedback[user.survey_data.feedback_von- 1].text,
            _zutreffend[user.survey_data.eigenstaendigkeit - 1].text,
            _zutreffend[user.survey_data.improvisation - 1].text,
            _freiraum[user.survey_data.freiraum - 1].text,
            _zutreffend[user.survey_data.innovationsoffenheit - 1].text,
            _zutreffend[user.survey_data.belastbarkeit - 1].text,
            _berufserfahrung[user.survey_data.berufserfahrung - 1].text,
            user.survey_data.aufmerksam_geworden,
            user.survey_data.freue_auf,
        ]

        csv.push(row);
    })

    _file = '';
    csv.forEach( row => _file += row.join(";") + "\n" )
    file = new Blob([_file], {type: 'text/csv;charset=utf-8'})

    url = URL.createObjectURL(file);
    csv_link = document.getElementById('csv_link_lehr_' + schulart);
    csv_link.setAttribute('href', url);
    csv_link.setAttribute('download', 'Lehrkräfte' + schulart + '.csv')

}

function exportAllLehrCSV() {

    let csv = [
        
    [
        'Liste aller registrierter Lehrkräfte nach Schulart sortiert.'
    ],
        
    [
        'Anrede',
        'Nachname',
        'Vorname',
        'E-Mail-Adresse',
        'Telefonnummer',

        'Bewerbungsformular ausgefüllt und Teilnahme erwünscht',

        'Wunschtandem',

        'Schulart',
        'Nur Realschule und Gymnasium: Fächer',
        'Landkreis der Schule',
        'Name der Schule',
        'Straße',
        'Hausnummer',
        'Postleitzahl',
        'Ort',

        'Zustimmung der Schulleitung',
        'Vor- und Nachname der Schulleitung',
        'E-Mail-Adresse der Schulleitung',

        'Bereits teilgenommen',
        'Registrierungscode:',
        'Bestätigung: Datenschutz',
        'Bestätigung: Verbindliche Teilnahmebedingungen',

        'Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe,',
        'Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht',
        'Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen',
        'Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden',
        'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der',
        'Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren',
        'Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut',
        'Ihre Berufserfahrung: Ich bin Lehrer*in seit',
        'Wodurch sind Sie auf das Projekt aufmerksam geworden? (Mehrfachauswahl möglich)',
        'Ich freue mich im Rahmen der Lehr:werkstatt besonders auf (Mehrfachauswahl möglich)',
        // 'Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?',
    ]];

    window['all_lehr'].forEach(user => {
        
        if(user.survey_data) {
            row = [
                user.survey_data.anrede,
                user.nachname, 
                user.vorname, 
                user.email, 
                user.survey_data.telefonnummer,
    
                user.is_evaluable ? 'Ja' : 'Nein',
    
                user.survey_data.wunschtandem,
    
                user.survey_data.schulart,
                user.survey_data.faecher,
                user.survey_data.landkreis,
                user.survey_data.schulname,
                user.survey_data.strasse,
                user.survey_data.hausnummer,
                user.survey_data.postleitzahl,
                user.survey_data.ort,
    
                user.survey_data.zustimmung_schul,
                user.survey_data.name_schul,
                user.survey_data.email_schul,
    
                user.survey_data.bereits_teilgenommen,
                user.survey_data.registrierungscode,
                user.survey_data.datenschutz,
                user.survey_data.teilnahmebedingungen,
    
                _feedback[user.survey_data.feedback_an - 1].text,
                _feedback[user.survey_data.feedback_von- 1].text,
                _zutreffend[user.survey_data.eigenstaendigkeit - 1].text,
                _zutreffend[user.survey_data.improvisation - 1].text,
                _freiraum[user.survey_data.freiraum - 1].text,
                _zutreffend[user.survey_data.innovationsoffenheit - 1].text,
                _zutreffend[user.survey_data.belastbarkeit - 1].text,
                _berufserfahrung[user.survey_data.berufserfahrung - 1].text,
                user.survey_data.aufmerksam_geworden,
                user.survey_data.freue_auf,
            ]
        } else {
            row = [
                '',
                user.nachname, 
                user.vorname, 
                user.email,
                // user.survey_data ? user.survey_data.telefonnummer,
    
                'Nein',
    
                // user.survey_data.wunschtandem,
    
                // user.survey_data.schulart,
                // user.survey_data.faecher,
                // user.survey_data.landkreis,
                // user.survey_data.schulname,
                // user.survey_data.strasse,
                // user.survey_data.hausnummer,
                // user.survey_data.postleitzahl,
                // user.survey_data.ort,
    
                // user.survey_data.zustimmung_schul,
                // user.survey_data.name_schul,
                // user.survey_data.email_schul,
    
                // user.survey_data.bereits_teilgenommen,
                // user.survey_data.registrierungscode,
                // user.survey_data.datenschutz,
                // user.survey_data.teilnahmebedingungen,
    
                // _feedback[user.survey_data.feedback_an - 1].text,
                // _feedback[user.survey_data.feedback_von- 1].text,
                // _zutreffend[user.survey_data.eigenstaendigkeit - 1].text,
                // _zutreffend[user.survey_data.improvisation - 1].text,
                // _freiraum[user.survey_data.freiraum - 1].text,
                // _zutreffend[user.survey_data.innovationsoffenheit - 1].text,
                // _zutreffend[user.survey_data.belastbarkeit - 1].text,
                // _berufserfahrung[user.survey_data.berufserfahrung - 1].text,
                // user.survey_data.aufmerksam_geworden,
                // user.survey_data.freue_auf,
            ]
        }


        csv.push(row);
    })

    _file = '';
    csv.forEach( row => _file += row.join(";") + "\n" )
    file = new Blob([_file], {type: 'text/csv;charset=utf-8'})

    url = URL.createObjectURL(file);
    csv_link = document.getElementById('csv_link_all_lehr');
    csv_link.setAttribute('href', url);
    csv_link.setAttribute('download', 'Lehrkräfte.csv')

}