if (!window["%hammerhead%"]) {
    window.survey = new Survey.Model(json);
    survey.onComplete.add(function(result) {
        console.log(result)
        document.querySelector("#surveyResult").innerHTML = "result: " + JSON.stringify(result.data);
    });

    $("#surveyElement").Survey({
        model: survey
    });
} 

var total = {
    pageCount: survey.pageCount,
    question: survey.getAllQuestions().length,
    answer: 0
};
var question = {

};
var answer = {
    requireCount: 0,
    responseCount: 0
};
var currentPage = {
    questionCount: 0
}

$(".sv_next_btn").click(function() {
    for ( var i in json.pages) {
        var pageContent = json.pages[i].elements;
        for (var j in pageContent) {
            if (pageContent[j].isRequired) {
                requireCount ++;
            }
        }
    }
});
survey.onValueChanged.add(function(survey, options) {
    var select_question_require = options.question.isRequired;
    if (select_question_require) {
        answer.requireCount ++;
    }
    answer.responseCount ++;
    currentPage.questionCount = survey.currentPage.getValue();

    var not_answer_count = total.question * 1 - answer.responseCount * 1 - 1;
    var overall_progress = Math.round(answer.requireCount / total.question * 100, 2) + "%";
    $("#overall_progress").text(overall_progress);

    var gdpr_compliance = 0;
});