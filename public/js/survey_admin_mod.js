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
    survey.completedHtml = '<p style="color:white">Ihre Daten wurden erfolgreich aktualisiert.<p>';

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
            // console.log(sender.data);
    });
    });