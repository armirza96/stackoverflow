
function doAjaxCall(dataToSend, uiParams,type = "GET"){
  if(type == "GET") {
    return $.get("php/base.php", dataToSend)
    .done(function( data ) {
      ajaxDone(data, uiParams);
    });
  } else {
    return $.post("php/base.php", dataToSend)
    .done(function( data ) {
      ajaxDone(data, uiParams);
    });
  }
}

function ajaxDone(data, uiParams) {
  console.log(data);
  if(uiParams !== undefined && window[uiParams.callback] !== null) {

    if(data.length > 0) {
      data = JSON.parse(data);
      const callback = window[uiParams.callback];
      const p = $(uiParams.parentEl);


      if(uiParams.type == "UI_UPDATE") {
        callback(p, data);
      } else if(uiParams.type == "ADD_TO_UI"){
        p.empty();
        for(const d of data) {
          console.log(d);
          callback(p, d);
        }
      }
    }
  }
}

function isArray(obj) {
    return Object.prototype.toString.call(obj) === '[object Array]';
}

$('.modal').on('hidden.bs.modal', function (e) {
  $(".alert").hide();
})

/**
function editQuestion(questionID) {
    $('.alert').hide();
    $('#processModal').modal('toggle');
    let dataToSend = {PAGE: 'updatePatient'};
    $('#formPatient :input').each(function(){
        const name = $(this).attr('name');
        const value = $(this).val();
        dataToSend[name] = value;
    });
    dataToSend['IS_CITIZEN'] = $('#inputCitizen').val();
    dataToSend['AGE_GROUP'] = $('#ageGroup').val();
    dataToSend['PATIENT_ID'] = patientID;
    console.log(dataToSend);
    doAjaxCall(dataToSend, {callback: 'showAlert', parentEl: '#some-alert', type: 'UI_UPDATE'}, 'POST');
}

function addQuestion() {
    $('.modal').modal('toggle')
    let dataToSend = {PAGE: 'addPatient'};
    $('form :input').each(function(){
        const name = $(this).attr('name');
        const value = $(this).val();
        dataToSend[name] = value;
    });
    dataToSend['IS_CITIZEN'] = $('#inputCitizen').val();
    dataToSend['AGE_GROUP'] = $('#ageGroup').val();
    console.log(dataToSend);
    doAjaxCall(dataToSend, {callback: 'showAlert', parentEl: '#another-alert', type: 'UI_UPDATE'}, 'POST');
}

function showAlert(parentEl, data) {
  if(data.RESULT == 1) {
    $(parentEl).text(data.MESSAGE + '. ' + 'Redirecting in 3 seconds');
    $(parentEl).show();

    setTimeout(function(){
      window.location.href = `somePage.php?QUESTION_ID=${data.ID}`;
    }, 3000);
  } else {
    $(parentEl).text(data.MESSAGE);
    $(parentEl).show()
  }
}
**/
