window.onload = init;

function init() {
  var form = document.getElementById("WebForm")
  form.onsubmit = validateForm;
  document.getElementById("txtName").focus();

  Array.from(document.getElementsByTagName("input"))
    .forEach(function(el) {
      var id = el.id
      if (el.type === 'radio' || el.type === 'submit') {
        el.onclick = function() {
          validateForm(form)
        }
      } else {
        el.onchange = function() {
          validateForm(form)
        }
		el.onkeypress = function() {
          validateForm(form)
        }
      }
    })

  elms = document.querySelectorAll('[id$="Error"]'); // id ends with Error
  for (var i = 0; i < elms.length; i++) {
    elms[i].innerHTML = "";
  }
}
var users = ["Batman", "Superman", "Spiderman"];

function validate_username(inputElm, errElm) {
  var input_value = inputElm.value;
  if (users.includes(input_value)) {
    errElm.innerHTML = "Username already exists.";
    return false;
  } else if (input_value.length < 5) {
    errElm.innerHTML = "Username is too short.";
    return false;
  } else if (input_value.length > 20) {
    errElm.innerHTML = "Username is too long.";
    return false;
  } else {
    errElm.innerHTML = "";
    return true;
  }
}


function validateForm(theForm) {
  with(theForm) {
    return (validate_username(txtName, elmNameError) &&
      isChecked("gender", "Please check a gender!", elmGenderError) &&
      isValidEmail(txtEmail, "Enter a valid email!", elmEmailError) &&
      isValidPassword(txtPassword, "Password shall be at least 6 characters long!", elmPasswordError, 0) &&
      isValidPassword(txtPassword, "Password shall contain at least one non-capital letter!", elmPasswordError, 1) &&
      isValidPassword(txtPassword, "Password shall contain at least one capital letter!", elmPasswordError, 2) &&
      isValidPassword(txtPassword, "Password shall contain at least digit!", elmPasswordError, 3) &&
      verifyPassword(txtPassword, txtPWVerified, "Different from new password!", elmPWVerifiedError)
    );
  }
}

function postValidate(isValid, errMsg, errElm, inputElm) {
  if (!isValid) {

    if (errElm !== undefined && errElm !== null &&
      errMsg !== undefined && errMsg !== null) {
      errElm.innerHTML = errMsg;
    }

    if (inputElm !== undefined && inputElm !== null) {
      inputElm.classList.add("errorBox"); 
      inputElm.focus();
    }
  } else {

    if (errElm !== undefined && errElm !== null) {
      errElm.innerHTML = "";
    }
    if (inputElm !== undefined && inputElm !== null) {
      inputElm.classList.remove("errorBox");
    }
  }
}


function isValidEmail(inputElm, errMsg, errElm) {
  var isValid = (inputElm.value.trim().match(
    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) !== null);
  postValidate(isValid, errMsg, errElm, inputElm);
  return isValid;
}

function isSelected(selectElm, errMsg, errElm) {
  var isValid = (selectElm.value !== ""); 
  postValidate(isValid, errMsg, errElm, selectElm);
  return isValid;
}

function isChecked(inputName, errMsg, errElm) {
  var elms = document.getElementsByName(inputName);
  var isChecked = false;
  for (var i = 0; i < elms.length; ++i) {
    if (elms[i].checked) {
      isChecked = true;
      break;
    }
  }
  postValidate(isChecked, errMsg, errElm, null);
  return isChecked;
}

function isValidPassword(inputElm, errMsg, errElm, checkType) {
  var isValid = false

  console.log(inputElm.value)

  switch (checkType) {
    case 0:
      isValid = (inputElm.value.length >= 6);
      break;
    case 1:
      isValid = (inputElm.value.trim().match(/[A-Z]/) !== null);
      break;
    case 2:
      isValid = (inputElm.value.trim().match(/[a-z]/) !== null);
      break;
    case 3:
      isValid = (inputElm.value.trim().match(/[0-9]/) !== null);
      break;
  }

  postValidate(isValid, errMsg, errElm, inputElm);
  return isValid;
}


function verifyPassword(pwElm, pwVerifiedElm, errMsg, errElm) {
  var isTheSame = (pwElm.value === pwVerifiedElm.value);
  postValidate(isTheSame, errMsg, errElm, pwVerifiedElm);
  return isTheSame;
}