window.addEventListener("beforeunload", function(event) {
    event.preventDefault();
    event.returnValue = '';
});

Survey.StylesManager.applyTheme("defaultV2");


var json = {
    title: "Lehr:werkstatt",
    pages: [{
        description: attention,
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
            name: "email",
            type: "text",
            inputMask: "email",
            title: "Ihre universitäre E-Mail-Adresse (mit Endung @student.uni-augsburg.de bzw. @uni-a.de):",
            isRequired: true
        }, {
            name: "telefonnummer",
            type: "text",
            inputFormat: "9{*}",
            title: "Ihre Telefonnummer:",
            isRequired: true
        }]
    } 
        
    ]
};


const survey = new Survey.Model(json);
survey.questionsOnPageMode = 'singlePage';
// if(typeof data !== 'undefined') {
//     survey.data = data;
//     survey.questionsOnPageMode = 'singlePage';
// }
survey.locale = 'de';

survey.showQuestionNumbers = 'off';
survey.showProgressBar = 'top';

$(function() {
    $("#surveyElement").Survey({ model: survey });
});

survey.onComplete.add(function (sender) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post('http://127.0.0.1:8000/bewerbungsformular', {survey: sender.data})
    .then(function() {
            console.log(sender.data);
    });
    });