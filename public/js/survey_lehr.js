window.addEventListener("beforeunload", function(event) {
    event.preventDefault();
    event.returnValue = '';
});

Survey.StylesManager.applyTheme("defaultV2");

Survey.StylesManager.ThemeCss[".sd-header__text h3"] = "color: var(--primary, #fff);"

schularten = [
    "Grundschule",
    "Realschule",
    "Gymnasium"
]

faecher = [
    "Deutsch",
    "Didaktik des Deutschen als Zweitsprache (Erw.)*",
    "Englisch",
    "Ethik (Erw.)*",
    "Französisch",
    "Geographie",
    "Geschichte",
    "Italienisch",
    "Kunst (nur Realschule)",
    "Mathematik",
    "Musik (nur Realschule)",
    "Physik",
    "Religionslehre ev.",
    "Religionslehre kath.",
    "Sozialkunde",
    "Spanisch",
    "Sport weiblich",
    "Sport männlich"
]

landkreise = [
    "Augsburg Stadt",
    "Augsburg Land",
    "Aichach-Friedberg",
    "Dillingen a. d. Donau",
    "Donau-Ries",
    "Günzburg",
    "Kaufbeuren",
    "Kempten",
    "Lindau",
    "Memmingen",
    "Neu-Ulm",
    "Oberallgäu",
    "Ostallgäu",
    "Unterallgäu"
]

feedback = [
    {value: 1, text: "ist sehr behutsam."},
    {value: 2, text: "ist eher behutsam."},
    {value: 3, text: "ist manchmal behutsam, manchmal direkt."},
    {value: 4, text: "ist eher direkt."},
    {value: 5, text: "ist sehr direkt."}
]

zutreffend = [
    {value: 1, text: "Trifft überhaupt nicht zu."},
    {value: 2, text: "Trifft eher nicht zu."},
    {value: 3, text: "Teils, teils."},
    {value: 4, text: "Trifft eher zu."},
    {value: 5, text: "Trifft voll und ganz zu."}
]

freiraum = [
    {value: 1, text: "eher Freiraum für eigene Ideen und Entscheidungen möchte."},
    {value: 2, text: "teils Freiraum, teils klare Anweisungen von mir möchte."},
    {value: 3, text: "eher klare Anweisungen von mir möchte."}
]

berufserfahrung = [
    {value: 1, text: "maximal einem Jahr."},
    {value: 2, text: "mehr als einem Jahr und maximal 3 Jahren."},
    {value: 3, text: "mehr als drei Jahren und maximal 10 Jahren."},
    {value: 4, text: "mehr als 10 Jahren."},
]

aufmerksam_geworden = [
    "Projekthomepage",
    "Universität",
    "Direktorat",
    "Kollegium",
    "Empfehlung durch ehemalige*n Projektteilnehmer*in",
    "Medien",
    "Sonstiges"
]

freue_auf = [
    "das Umsetzen neuer Ideen zusammen mit meinem Lehr:werker bzw. meiner Lehr:werkerin.",
    "neue Impulse aus der universitären Lehrer*innenbildung. ",
    "die vielfältigen Möglichkeiten, sich gegenseitig Feedback zu geben.",
    "die Kombination von Aus- und Weiterbildung.",
    "den fächer- und schul(art)übergreifenden Austausch mit anderen Lehr:mentor*innen.",
    "die Erfahrung, im Teamteaching zu unterrichten.",
    "mein Mitwirken an der Lehrer*innenausbildung.",
    "die Weiterbildung im Rahmen der Kompetenzworkshops.",
    "die kontinuierliche Zusammenarbeit über ein ganzes Schuljahr hinweg.",
    "die individuellere Förderung meiner Schüler*innen.",
    "die Unterstützung durch meine*n Lehr:werker*in und eine mögliche Entlastung im alltäglichen Schulleben."
]

var json = {
    title: "Bewerbungsformular Lehrkräfte",
    pages: [{
        description: attention,
        elements: [{
            name: "datenschutz",
            type: "checkbox",
            title: "Bestätigung: Datenschutz:",
            isRequired: true,
            choices: [
                "Ich bestätige, dass ich die verlinkten <a href='https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/datenschutzhinweise/' target='_blank' class='text-blue-400'>Datenschutzhinweise</a> sowie die <a href='https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/datenschutzrechtliche-einwilligungserklarung/' target='_blank' class='text-blue-400'>datenschutzrechtliche Einwilligungserklärung</a> zur Kenntnis genommen habe, und willige in die Verarbeitung und Speicherung meiner Daten im Rahmen der Lehr:werkstatt ein."   
            ]
        }, {
            name: "teilnahmebedingungen",
            type: "checkbox",
            title: "Bestätigung: Verbindliche Teilnahmebedingungen:",
            isRequired: true,
            choices: [
                "Ich habe die verlinkten verbindlichen <a href='https://digillab.uni-augsburg.de/wp-content/uploads/2023/01/Verbindliche_TN-Bedingungen_UniA_2023.pdf' target='_blank' class='text-blue-400'>Teilnahmebedingungen</a> für den Jahrgang " + jahrgang + " zur Kenntnis genommen und akzeptiere sie."
            ]
        }]
    }, {
        elements: [{
            name: "registrierungscode",
            type: "text",
            title: "Registrierungscode " + jahrgang + ":",
            description: "Das Bewerbungsformular kann nur mit korrektem Registrierungscode abgeschickt werden. Der Registrierungscode ist Ihrer Schulleitung zugegangen. Bitte tragen Sie den Registrierungscode in das oben stehende Feld ein. Bitte wenden Sie sich bei Fragen an: lehrwerkstatt@zlbib.uni-augsburg.de",
            isRequired: true
        }]
    }, {
        elements: [{
            name: "bereits_teilgenommen",
            type: "dropdown",
            title: "Ich habe bereits in einem früheren Jahrgang an der Lehr:werkstatt teilgenommen.",
            isRequired: true,
            choices: ["Ja", "Nein"]
        }]
    }, {
        elements: [{
            name: "anrede",
            type: "dropdown",
            title: "Anrede",
            isRequired: true,
            choices: [
                "Herr",
                "Frau",
                "keine Anrede / divers"
            ]
        }, {
            name: "nachname",
            type: "text",
            title: "Ihr Nachname:",
            isRequired: true
        }, {
            name: "vorname",
            type: "text",
            title: "Ihr Vorname:",
            isRequired: true
        }, {
            name: "telefonnummer",
            type: "text",
            inputFormat: "9{*}",
            title: "Ihre Telefonnummer:",
            isRequired: true
        }]
    }, {
        elements: [{
            name: "zustimmung_schul",
            type: "checkbox",
            title: "Für die Teilnahme an der Lehr:werkstatt ist die Zustimmung Ihrer Schulleitung erforderlich:",
            isRequired: true,
            choices: [
                "Hiermit bestätige ich, dass meine Schulleitung mit meiner Teilnahme an der Lehr:werkstatt im Jahrgang " + jahrgang + " einverstanden ist."
            ]
        }, {
            name: "name_schul",
            type: "text",
            title: "Vorname und Nachname Ihrer Schulleitung:",
            isRequired: true
        }, {
            name: "email_schul",
            type: "text",
            title: "E-Mail-Adresse Ihrer Schulleitung:",
            isRequired: true
        }]
    }, {
        elements: [{
            name: "schulart",
            type: "dropdown",
            title: "An folgender Schulart bin ich tätig:",
            isRequired: true,
            choices: [
                "Grundschule",
                "Realschule",
                "Gymnasium"
            ]
        }, {
            name: "faecher",
            type: "checkbox",
            title: "Ich möchte gerne in folgenden Fächern gematcht werden:",
            description: "Falls Sie ein nur als Erweiterungsfach studierbares Fach wählen, geben Sie bitte mindestens ein, besser zwei weitere Fächer an.",
            visibleIf: "{schulart} = 'Realschule' or {schulart} = 'Gymnasium'",
            isRequired: true,
            choices: faecher
        }]
    }, {
        elements: [{
            name: "landkreis",
            type: "dropdown",
            title: "Bitte geben Sie an, in welchem Landkreis Ihre Schule liegt:",
            isRequired: true,
            choices: landkreise
        }]
    }, {
        title: "Name und Adresse Ihrer Schule:",
        elements: [{
            name: "schulname",
            type: "text",
            title: "Name der Schule:",
            isRequired: true
        }, {
            name: "strasse",
            type: "text",
            title: "Straße:",
            isRequired: true
        }, {
            name: "hausnummer",
            type: "text",
            title: "Hausnummer:",
            isRequired: true
        }, {
            name: "postleitzahl",
            type: "text",
            inputFormat: "9{*}",
            title: "Postleitzahl:",
            isRequired: true
        }, {
            name: "ort",
            type: "text",
            title: "Ort:",
            isRequired: true
        }]
    }, {
        elements: [{
            name: "wunschtandem",
            type: "text",
            title: "Name des Wunschtandempartners bzw. der Wunschtandempartnerin:",
            description: "Falls Sie bereits eine*n Studierende*n kennen, mit dem/der Sie gerne im Tandem arbeiten möchten, nennen Sie uns bitte den Namen der Person. Bitte füllen Sie auch in diesem Fall das Bewerbungsformular vollständig aus."
        }]
    }, {
        elements: [{
            name: "feedback_an",
            type: "dropdown",
            title: "Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe,:",
            isRequired: true,
            choices: feedback
        }]
    }, {
        elements: [{
            name: "feedback_von",
            type: "dropdown",
            title: "Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "eigenstaendigkeit",
            type: "dropdown",
            title: "Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "improvisation",
            type: "dropdown",
            title: "Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "freiraum",
            type: "dropdown",
            title: "Ich wünsche mir eine*n Lehr:werker*in, die bzw. der:",
            isRequired: true,
            choices: freiraum
        }]
    }, {
        elements: [{
            name: "innovationsoffenheit",
            type: "dropdown",
            title: "Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "belastbarkeit",
            type: "dropdown",
            title: "Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "berufserfahrung",
            type: "dropdown",
            title: "Ihre Berufserfahrung: Ich bin Lehrer*in seit:",
            isRequired: true,
            choices: berufserfahrung
        }]
    }, {
        elements: [{
            name: "aufmerksam_geworden",
            type: "checkbox",
            title: "Wodurch sind Sie auf das Projekt aufmerksam geworden? (Mehrfachauswahl möglich):",
            choices: aufmerksam_geworden
        }]
    }, {
        elements: [{
            name: "freue_auf",
            type: "checkbox",
            title: "Ich freue mich im Rahmen der Lehr:werkstatt besonders auf (Mehrfachauswahl möglich):",
            choices: freue_auf
        }]
    }, {
        elements: [{
            name: "bestaetigung",
            type: "checkbox",
            title: "Bestätigung:",
            isRequired: true,
            choices: [
                "Mit dem Absenden des Fragebogens bewerben Sie sich verbindlich für die Lehr:werkstatt im Schuljahr " + jahrgang + ". Wir suchen eine*n Tandempartner*in für Sie und gehen davon aus, dass Sie definitv teilnehmen möchten. Bitte bestätigen Sie durch Setzen des Häkchens: Ich habe den Hinweis zur Kenntnis genommen und möchte mich verbindlich bewerben."
            ]
        }]
    } 
        
    ]
};


function validate(survey, options) {
    var reg_code = options.data['registrierungscode'];
    if (!reg_code) {
        options.complete();
        return;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(host + '/bewerbungsformular/registrierungscode', {code: reg_code})
        .then(function(data) {
            if(data > 0) {
                console.log(data);
                options.complete();
            } else {
                options.errors['registrierungscode'] = 'Ungültiger Registrierungscode.'
                options.complete();
            }
        });

}

const survey = new Survey.Model(json);
if(typeof data !== 'undefined') {
    survey.data = data;
    survey.questionsOnPageMode = 'singlePage';
    survey.completedHtml = '<p style="color:white">Vielen Dank für Ihre Teilnahme. Ihre Daten wurden erfolgreich gespeichert.<p>';
}
survey.locale = 'de';

survey.showQuestionNumbers = 'off';
// survey.showProgressBar = 'top';

var converter = new showdown.Converter();
survey.onTextMarkdown.add(function (survey, options) {
    var md = converter.makeHtml(options.text);
    md = md.substring(3);
    md = md.substring(0, md.length - 4);
    options.html = md;
})

$(function() {
    $("#surveyElement").Survey({ model: survey });
});

survey.onComplete.add(function (sender) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(host + '/bewerbungsformular', {survey: sender.data})
    .then(function() {
            // console.log(sender.data);
    });
    });

survey.onServerValidateQuestions.add(validate);