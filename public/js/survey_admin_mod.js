window.addEventListener("beforeunload", function(event) {
    event.preventDefault();
    event.returnValue = '';
});

Survey.StylesManager.applyTheme("defaultV2");


var json = {
    // title: "Moderation und Administration",
    pages: [{
        description: attention,
        elements: [{
            name: "anrede",
            type: "dropdown",
            title: "Anrede",
            // isRequired: true,
            choices: [
                "Herr",
                "Frau",
                "keine Anrede / divers"
            ]
        }, {
            name: "nachname",
            type: "text",
            title: "Ihr Nachname:",
            // isRequired: true
        }, {
            name: "vorname",
            type: "text",
            title: "Ihr Vorname:",
            // isRequired: true
        }, {
            name: "telefonnummer",
            type: "text",
            inputFormat: "9{*}",
            title: "Ihre Telefonnummer:",
            // isRequired: true
        }]
    } 
        
    ]
};


const survey = new Survey.Model(json);
survey.questionsOnPageMode = 'singlePage';
if(typeof data !== 'undefined') {
    survey.data = data;
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
    $.post('https://hosted-024-216.rz.uni-augsburg.de/bewerbungsformular', {survey: sender.data})
    .then(function() {
            console.log(sender.data);
    });
    });