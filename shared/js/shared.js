
function submitForm(id, callback) {
  /**
    To use this function pass in the id of the form without '#' and the associated callback
    callbacks are custom functions
  **/
  let dataToSend = {PAGE: $(`#${id}`).attr("action")};
  $(`#${id} :input`).each(function(){
      const name = $(this).attr('name');
      const value = $(this).val();
      dataToSend[name] = value;
  });
  console.log(dataToSend);
  doAjaxCall(dataToSend, {callback: callback, type: 'UI_UPDATE'}, 'POST');
}

function showAlert(id, message) {
  $(".alert").hide();
  $(`#${id}`).text(message);
  $(`#${id}`).show(message);
}

function redirectUser(page,timeout) {
  setTimeout(function(){
    window.location.href = page;
  }, timeout);
}


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

      callback(data);
    }
  }
}

/**
  call this method when u need to add multiple elements to the page.
  PARAMS: id of parent elements, data returned from server, html code with dummy data, text to replace with the dummy data
  ex:
    let html = '<p><b>TEXT</b><em>TEXT2</em></p>';
    let data = {["TEXT": "HELLO", "TEXT2":"WORLD"], ["TEXT": "FOO", "TEXT2":"BAR"]};
    addElementsToUI("id", data, html);
**/
function addElementsToUI(id, data, html) {
  const parent = $(`#${id}`);
  parent.empty();
  for(const object of data) {
    console.log(object);
    let element = html;
    for (const [key, value] of Object.entries(object)) {
      element = element.replace(key, value);
    }

    parent.append(element);
  }
}

function isArray(obj) {
    return Object.prototype.toString.call(obj) === '[object Array]';
}
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


**/
