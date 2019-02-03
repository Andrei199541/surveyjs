var obj;
var surveyName = "";
function setSurveyName(name) {
  var $titleTitle = jQuery("#sjs_editor_title_show");
  $titleTitle.find("span:first-child").text(name);
}
function startEdit() {
  var $titleEditor = jQuery("#sjs_editor_title_edit");
  var $titleTitle = jQuery("#sjs_editor_title_show");
  $titleTitle.hide();
  $titleEditor.show();
  $titleEditor.find("input")[0].value = surveyName;
  $titleEditor.find("input").focus();
}
function cancelEdit() {
  var $titleEditor = jQuery("#sjs_editor_title_edit");
  var $titleTitle = jQuery("#sjs_editor_title_show");
  $titleEditor.hide();
  $titleTitle.show();
}
function postEdit() {
  cancelEdit();
  var oldName = surveyName;
  var $titleEditor = jQuery("#sjs_editor_title_edit");
  surveyName = $titleEditor.find("input")[0].value;
  setSurveyName(surveyName);
  jQuery
    .get("/changeName?id=" + surveyId + "&name=" + surveyName, function(data) {
      surveyId = data.Id;
    })
    .fail(function(error) {
      surveyName = oldName;
      setSurveyName(surveyName);
      alert(JSON.stringify(error));
    });
}

function getParams() {
  var url = window.location.href
    .slice(window.location.href.indexOf("?") + 1)
    .split("&");
  var result = {};
  url.forEach(function(item) {
    var param = item.split("=");
    result[param[0]] = param[1];
  });
  return result;
}

Survey.dxSurveyService.serviceUrl = site_url;
var accessKey = "";
var editor = new SurveyEditor.SurveyEditor("editor");
// var surveyId = decodeURI(getParams()["id"]);
var surveyId = 1;
editor.loadSurvey(surveyId);
editor.saveSurveyFunc = function(saveNo, callback) {
  var xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    Survey.dxSurveyService.serviceUrl + "/changeJson?accessKey=" + accessKey
  );
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.onload = function() {
    var result = xhr.response ? JSON.parse(xhr.response) : null;
    if (xhr.status === 200) {
      callback(saveNo, true);
    }
  };
  xhr.send(
    JSON.stringify({ Id: surveyId, Json: editor.text, Text: editor.text })
  );
};
editor.isAutoSave = true;
editor.showState = true;
editor.showOptions = true;

surveyName = surveyId;
setSurveyName(surveyName);

function selectFile() {
    $('#file_path').click();
    var value = $(obj).val();
    $('#file_path').change(function () {
      if ($('#file_path')[0].files.length) {
      var fileName = $('#file_path')[0].files[0].name;
      if (!fileName) return false;
      $.ajax({
        type: 'GET',
        url: site_url + "/file/checkFileName",
        data: {filename: fileName},
        dataType: "JSON",
        success: function (response) {
          filePath = "";
          if (response == true) {
            filePath = '<a href="../assets/uploads/' + fileName + '" > ' + fileName + ' </a>';
          } else {
            toastr['warning']("Please select a correct file.");
          }          
          // callback(filePath);
          $(obj).val(filePath);
        }
      });
    }
  });
}
$(document).on('mousedown','textarea',function() {
  obj = $(this);
  var element = $(this).prev("grammarly-ghost");
  element.append("<input type='button' id='select_file' onclick='selectFile()' class='btn btn-primary' style='position: absolute; top: -10px; right: 15px; z-index: 100' value='Choose File'>");  
});

var custom_toolbar ='<div tabindex="0" draggable="true" class="svd_toolbox_item svd-light-border-color">\
  <span class="svd_toolbox_item_text hidden-sm hidden-xs" data-bind="text:title">Custom Question</span></div>';
  
$("#icon-actionaddtotoolbox").click(function() {
  var pageName = $('.svd_selected_page').find('.svd-page-name').text();
  if (custom_flag == 1) {
    if (!confirm("Are you sure update the custom question?")) {
      return false;
    }
  } else if(!confirm("Are you sure add to the toolbox")) {
    return false;
  }
  if (custom_flag == 0) {
    var element = $(".svd_toolbox_title").after(custom_toolbar);
  }
  $.ajax({
    type: 'POST',
    url: site_url + "/questions/customQuestion",
    data: {json: editor.text, page: pageName},
    dataType: "JSON",
    success: function (response) {
      if (response == "OK") {
        custom_flag = 1;
      }
    }
  });
});