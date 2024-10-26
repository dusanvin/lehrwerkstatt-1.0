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

function escapeForCSV(value) {
    if (typeof value === 'string') {
        return value.replace(/"/g, '""');
    }
    return value;
}

function exportLehrCSV(varName) {

    let csv = [
        
    [
        `"Anrede"`,
        `"Nachname"`,
        `"Vorname"`,
        `"E-Mail-Adresse"`,
        `"Telefonnummer"`,

        `"Bewerbungsformular ausgefüllt und Teilnahme erwünscht"`,

        `"Wunschtandem"`,

        `"Schulart"`,
        `"Nur Realschule und Gymnasium: Fächer"`,
        `"Landkreis der Schule"`,
        `"Name der Schule"`,
        `"Straße"`,
        `"Hausnummer"`,
        `"Postleitzahl"`,
        `"Ort"`,

        `"Zustimmung der Schulleitung"`,
        `"Vor- und Nachname der Schulleitung"`,
        `"E-Mail-Adresse der Schulleitung"`,

        `"Bereits teilgenommen"`,
        `"Registrierungscode:"`,
        `"Bestätigung: Verbindliche Teilnahmebedingungen"`,
        `"Bestätigung: Datenschutzhinweise und datenschutzrechtliche Einwilligungserklärung"`,
        `"Bestätigung: Teilnahmebedingungen"`,

        `"Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe,"`,
        `"Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht"`,
        `"Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen"`,
        `"Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden"`,
        `"Ich wünsche mir eine*n Lehr:werker*in, die bzw. der"`,
        `"Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren"`,
        `"Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut"`,
        `"Ihre Berufserfahrung: Ich bin Lehrer*in seit"`,
        `"Wodurch sind Sie auf das Projekt aufmerksam geworden? (Mehrfachauswahl möglich)"`,
        `"Ich freue mich im Rahmen der Lehr:werkstatt besonders auf (Mehrfachauswahl möglich)"`,
        `"Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?"`,
    ]];

    window[varName].forEach(user => {
        
        row = [
            `"${escapeForCSV(user?.survey_data?.anrede ?? '')}"`, 
            `"${escapeForCSV(user?.nachname ?? '')}"`, 
            `"${escapeForCSV(user?.vorname ?? '')}"`, 
            `"${escapeForCSV(user?.email ?? '')}"`, 
            `"${escapeForCSV(user?.survey_data?.telefonnummer ?? '')}"`,

            `"${escapeForCSV(user?.is_evaluable ? 'Ja' : 'Nein')}"`,

            `"${escapeForCSV(user?.survey_data?.wunschtandem ?? '')}"`,

            `"${escapeForCSV(user?.survey_data?.schulart ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.faecher ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.landkreis ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.schulname ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.strasse ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.hausnummer ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.postleitzahl ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.ort ?? '')}"`,

            `"${escapeForCSV(user?.survey_data?.zustimmung_schul ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.name_schul ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.email_schul ?? '')}"`,

            `"${escapeForCSV(user?.survey_data?.bereits_teilgenommen ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.registrierungscode ?? '')}"`,
            `"${escapeForCSV(user?.nutzungsbedingungen ?? '')}"`,
            `"${escapeForCSV(user?.datenschutz ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.teilnahmebedingungen ?? '')}"`,

            `"${escapeForCSV(_feedback[user?.survey_data?.feedback_an - 1]?.text ?? '')}"`,
            `"${escapeForCSV(_feedback[user?.survey_data?.feedback_von- 1]?.text ?? '')}"`,
            `"${escapeForCSV(_zutreffend[user?.survey_data?.eigenstaendigkeit - 1]?.text ?? '')}"`,
            `"${escapeForCSV(_zutreffend[user?.survey_data?.improvisation - 1]?.text ?? '')}"`,
            `"${escapeForCSV(_freiraum[user?.survey_data?.freiraum - 1]?.text ?? '')}"`,
            `"${escapeForCSV(_zutreffend[user?.survey_data?.innovationsoffenheit - 1]?.text ?? '')}"`,
            `"${escapeForCSV(_zutreffend[user?.survey_data?.belastbarkeit - 1]?.text ?? '')}"`,
            `"${escapeForCSV(_berufserfahrung[user?.survey_data?.berufserfahrung - 1]?.text ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.aufmerksam_geworden ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.freue_auf ?? '')}"`,
            `"${escapeForCSV(user?.survey_data?.anmerkungen ?? '')}"`,
        ]

        csv.push(row);
    })

    _file = '';
    csv.forEach( row => _file += row.join(";") + "\n" )
    file = new Blob([_file], {type: 'text/csv;charset=utf-8'})

    url = URL.createObjectURL(file);
    csv_link = document.getElementById(varName);
    csv_link.setAttribute('href', url);
    csv_link.setAttribute('download',  varName + '.csv');

}
