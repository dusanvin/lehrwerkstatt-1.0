window.addEventListener("beforeunload", function(event) {
    event.preventDefault();
    event.returnValue = '';
});

Survey.StylesManager.applyTheme("defaultV2");

schularten = [
    "Grundschule",
    "Realschule",
    "Gymnasium"
]

fachsemester = []
for(i = 1; i <= 14; i++) {
    fachsemester.push({value: i, text: `${i}. Fachsemester`});
}

faecher = [
    "Deutsch",
    "Didaktik des Deutschen als Zweitsprache (Erw.)*",
    "Englisch",
    "Ethik (Erw.)*",
    "Französisch",
    "Geographie",
    "Geschichte",
    "Italienisch",
    "Kunst",
    "Mathematik",
    "Musik",
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
    {value: 1, text: "mir eher Freiraum für eigene Ideen und Entscheidungen lässt."},
    {value: 2, text: "mir teils Freiraum lässt, teils klare Anweisungen gibt."},
    {value: 3, text: "mir eher klare Anweisungen gibt."}
]

praktika = [
    "Orientierungspraktikum",
    "pädagogisch-didaktisches Schulpraktikum",
    "studienbegleitendes Praktikum",
    "zusätzliches studienbegleitendes Praktikum",
    "Betriebspraktikum",
    "Ich habe noch kein Praktikum im Rahmen meines Lehramtsstudiums absolviert."
]

aufmerksam_geworden = [
    "Projekthomepage",
    "Aushang an der Universität",
    "Dozent*in an der Universität",
    "Mailing der Universität",
    "Kommiliton*innen",
    "Empfehlung durch ehemalige*n Projektteilnehmer*in",
    "Informationsveranstaltung",
    "Medien",
    "Sonstiges"
]

freue_auf = [
    "intensive Praxiserfahrung in der Schule zu sammeln.",
    "zusammen mit meinem Lehr:mentor bzw. meiner Lehr:mentorin im Teamteaching zu unterrichten.",
    "mich ohne Notendruck in der Schulwelt zurechtzufinden und schon wertvolle Erfahrungen für das Referendariat zu sammeln.",
    "an Kompetenzworkshops teilzunehmen, in denen ich praxisnahes Wissen für meinen Einsatz in der Schule erwerbe.",
    "meine Praktikumserfahrungen in der Begleitveranstaltung zu reflektieren.",
    "andere Lehr:werker*innen kennenzulernen und mich mit ihnen auszutauschen.",
    "Feedback zu meinem Unterricht und meiner Eignung als Lehrkraft zu erhalten, aber auch Rückmeldungen an meine*n Lehr:mentor*in zu geben.",
    "meinen Berufswunsch unter Realbedingungen zu reflektieren und darauf basierende eine fundierte Berufsentscheidung treffen zu können.",
    "kontinuierlich über ein Schuljahr hinweg zu entdecken, was es heißt Lehrer*in zu sein.",
    "verschiedene Klassen und Jahrgangsstufen über einen längeren Zeitraum kennenzulernen.",
    "Einblicke in die Erstellung von Leistungsnachweisen und deren Korrektur zu erhalten.",
    "von dem guten Betreuungsverhältnis in der Schule und in der Universität zu profitieren.",
    "tiefere Einblicke in den Schulalltag zu bekommen, wie z.B. die Lehrer*innenkonferenz zu besuchen, ",
    "an Wandertagen und Schullandheimfahrten teilzunehmen, Elternsprechtagen beizuwohnen etc."
]

verkehrsmittel = [
    "Bus/Tram",
    "Bahn",
    "PKW",
    "Fahrrad"
]

var json = {
    title: "Bewerbungsformular Studierende",
    pages: [{
        description: attention,
        elements: [{
            name: "datenschutz",
            type: "checkbox",
            title: "Bestätigung: Datenschutz:",
            isRequired: true,
            choices: [
                "Ich bestätige, dass ich die oben verlinkten Datenschutzhinweise sowie die datenschutzrechtliche Einwilligungserklärung zur Kenntnis genommen habe, und willige in die Verarbeitung und Speicherung meiner Daten im Rahmen der Lehr:werkstatt ein."   
            ]
        }, {
            name: "teilnahmebedingungen",
            type: "checkbox",
            title: "Bestätigung: Verbindliche Teilnahmebedingungen:",
            isRequired: true,
            choices: [
                "Ich habe die oben verlinkten verbindlichen Teilnahmebedingungen für den Jahrgang " + jahrgang + " zur Kenntnis genommen und akzeptiere sie."
            ]
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
            name: "schulart",
            type: "dropdown",
            title: "Für folgende Schulart studiere ich Lehramt:",
            isRequired: true,
            choices: [
                "Grundschule",
                "Realschule",
                "Gymnasium"
            ]
        }, {
            name: "fachsemester",
            type: "dropdown",
            title: "Ich befinde mich im Wintersemester " + jahrgang + " in meinen für das Matching gewählten Fächern mindestens in folgendem Fachsemester:",
            isRequired: true,
            choices: fachsemester
        }, {
            name: "faecher",
            type: "checkbox",
            title: "Ich möchte gerne in folgenden meiner studierten Fächer gematcht werden:",
            description: "*Bitte geben Sie mindestens Ihre beiden Hauptfächer an.",
            visibleIf: "{schulart} = 'Realschule' or {schulart} = 'Gymnasium'",
            isRequired: true,
            choices: faecher
        }]
    }, {
        title: "Ehemalige Schule:",
        description: "Bitte geben Sie an, welches Gymnasium bzw. welche Realschule Sie selbst besucht haben.",
        visibleIf: "{schulart} = 'Realschule' or {schulart} = 'Gymnasium'",
        elements: [{
            name: "ehem_schulname",
            type: "text",
            title: "Schulname:",
            isRequired: true
        }, {
            name: "ehem_schulort",
            type: "text",
            title: "Ort:",
            isRequired: true
        }]
    }, {
        visibleIf: "{schulart} = 'Grundschule'",
        elements: [{
            name: "religionslehre",
            type: "dropdown",
            title: "Studieren Sie das Didaktikfach ev./kath. Religionslehre?:",
            description: "Bitte beachten Sie: Wenn Sie ev./kath. Religionslehre im Didaktikfach Grundschule studieren, müssen Sie das zusätzliche studienbegleitende Praktikum in diesem Fach absolvieren, um die kirchliche Lehrerlaubnis erlangen zu können. Das zusätzliche studienbegleitende Praktikum kann in diesem Fall nicht durch die Lehr:werkstatt ersetzt werden. Eine Teilnahme an der Lehr:werkstatt ist dennoch möglich.",
            isRequired: true,
            choices: [
                "Ja",
                "Nein"
            ]
        }]
    }, {
        elements: [{
            name: "landkreise",
            type: "checkbox",
            title: "Ich kann die Lehr:werkstatt in folgenden Landkreisen ableisten (Mehrfachauswahl möglich):",
            isRequired: true,
            choices: landkreise
        }]
    }, {
        elements: [{
            name: "verkehrsmittel",
            type: "checkbox",
            title: "Bitte geben Sie an, welche Verkehrsmittel Ihnen zur Verfügung stehen (Mehrfachauswahl möglich):",
            description: "Bitte beachten Sie: Fahrtkosten können nicht erstattet werden.",
            isRequired: true,
            choices: verkehrsmittel
        }]
    }, {
        elements: [{
            name: "wunschorte",
            type: "text",
            title: "Wunschort/e:",
            description: "Bitte beachten Sie: Wunschorte können nur in Ausnahmefällen berücksichtigt werden."
        }]
    }, {
        elements: [{
            name: "wunschtandem",
            type: "text",
            title: "Name des Wunschtandempartners bzw. der Wunschtandempartnerin:",
            description: "Falls Sie bereits eine Lehrkraft kennen, mit der Sie gerne im Tandem arbeiten möchten, nennen Sie uns bitte Name und Schule der Person. Bitte füllen Sie auch in diesem Fall das Bewerbungsformular vollständig aus."
        }]
    }, {
        elements: [{
            name: "feedback_von",
            type: "dropdown",
            title: "Das Feedback, das mir mein*e Lehr:mentor*in geben sollte,:",
            isRequired: true,
            choices: feedback
        }]
    }, {
        elements: [{
            name: "feedback_an",
            type: "dropdown",
            title: "Beim Feedback, das ich meinem Lehr:mentor bzw. meiner Lehr:mentorin gebe, sage ich ganz direkt, was ich von seinem bzw. ihrem Unterricht halte:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "eigenstaendigkeit",
            type: "dropdown",
            title: "Ich möchte langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen:",
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
            title: "Ich wünsche mir eine*n Lehr:mentor*in, die bzw. der:",
            isRequired: true,
            choices: freiraum
        }]
    }, {
        elements: [{
            name: "innovationsoffenheit",
            type: "dropdown",
            title: "Ein großer Erfahrungsschatz ist mir bei meinem Lehr:mentor bzw. meiner Lehr:mentorin wichtiger als die Neigung, Neues auszuprobieren:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "belastbarkeit",
            type: "dropdown",
            title: "Ich traue mir zu, mit meinem Lehr:mentor bzw. meiner Lehr:mentorin in „schwierigen“ oder höheren Klassen zu unterrichten:",
            isRequired: true,
            choices: zutreffend
        }]
    }, {
        elements: [{
            name: "praktika",
            type: "checkbox",
            title: "Welche(s) der folgenden Praktika haben Sie im Rahmen Ihres Lehramtsstudiums bereits absolviert?:",
            isRequired: true,
            choices: praktika
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
            title: "Ich freue mich im Rahmen der Lehr:werkstatt besonders darauf, (Mehrfachauswahl möglich):",
            choices: freue_auf
        }]
    }, {
        elements: [{
            name: "anmerkungen",
            type: "text",
            title: "Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?:"
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


const survey = new Survey.Model(json);
if(typeof data !== 'undefined') {
    survey.data = data;
    survey.questionsOnPageMode = 'singlePage';
}
survey.locale = 'de';

survey.showQuestionNumbers = 'off';
// survey.showProgressBar = 'top';

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
            console.log(sender.data);
    });
    });