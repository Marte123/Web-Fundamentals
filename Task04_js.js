
window.onload = init;
 
function init() {
   document.getElementById("WebForm").onsubmit = validateForm;
   document.getElementById("txtName").focus();
}
 
function validateForm(theForm) {
   with(theForm) {
      // return false would prevent default submission
      return (isNotEmpty(txtName, "Please enter your name!", elmNameError)
           && isChecked("gender", "Please check a gender!", elmGenderError)
           && isValidEmail(txtEmail, "Enter a valid email!", elmEmailError)
           && isValidPassword(txtPassword, "Password shall be at least 6 characters long!", elmPasswordError)
           && isValidPassword(txtPassword, "Password shall contain at least one non-capital letter!", elmPasswordError)
           && isValidPassword(txtPassword, "Password shall contain at least one capital letter!", elmPasswordError)
           && isValidPassword(txtPassword, "Password shall contain at least digit!", elmPasswordError)
           && verifyPassword(txtPassword, txtPWVerified, "Different from new password!",elmPWVerifiedError)
      );
   }
}
 
/*
 * Helper function, to be called after validation, to show or clear
 *   existing error message, and to set focus to the input element
 *   for correcting error.
 */
function postValidate(isValid, errMsg, errElm, inputElm) {
   if (!isValid) {
      // Show errMsg on errElm, if provided.
      if (errElm !== undefined && errElm !== null
            && errMsg !== undefined && errMsg !== null) {
         errElm.innerHTML = errMsg;
      }
      // Set focus on Input Element for correcting error, if provided.
      if (inputElm !== undefined && inputElm !== null) {
         inputElm.classList.add("errorBox");  // Add class for styling
         inputElm.focus();
      }
   } else {
      // Clear previous error message on errElm, if provided.
      if (errElm !== undefined && errElm !== null) {
         errElm.innerHTML = "";
      }
      if (inputElm !== undefined && inputElm !== null) {
         inputElm.classList.remove("errorBox");
      }
   }
}
 
/*
 * Validate that input value is not empty.
 *
 * @param inputElm (object): input element
 * @param errMsg (string): error message
 * @param errElm (object): element to place error message
 */
function isNotEmpty(inputElm, errMsg, errElm) {
   var isValid = (inputElm.value.trim() !== "");
   postValidate(isValid, errMsg, errElm, inputElm);
   return isValid;
}
 
/* Validate that input value contains only one or more letters */
function isAlphabetic(inputElm, errMsg, errElm) {
   var isValid = (inputElm.value.trim().match(/^[a-zA-Z]+$/) !== null) ;
   postValidate(isValid, errMsg, errElm, inputElm);
   return isValid;
}
 
/* Validate that input value contains one or more digits or letters */
function isAlphanumeric(inputElm, errMsg, errElm) {
   var isValid = (inputElm.value.trim().match(/^[0-9a-zA-Z]+$/) !== null);
   postValidate(isValid, errMsg, errElm, inputElm);
   return isValid;
}
 
/* Validate that input value length is between minLength and maxLength */
function isLengthMinMax(inputElm, minLength, maxLength, errMsg, errElm) {
   var inputValue = inputElm.value.trim();
   var isValid = (inputValue.length >= minLength) && (inputValue.length <= maxLength);
   postValidate(isValid, errMsg, errElm, inputElm);
   return isValid;
}
 
// Validate that input value is a valid email address
function isValidEmail(inputElm, errMsg, errElm) {
   var isValid = (inputElm.value.trim().match(
         /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) !== null);
   postValidate(isValid, errMsg, errElm, inputElm);
   return isValid;
}
 
/*
 * Validate that a selection is made (not default of "") in <select> input
 *
 * @param selectElm (object): the <select> element
 */
function isSelected(selectElm, errMsg, errElm) {
   // You need to set the default value of <select>'s <option> to "".
   var isValid = (selectElm.value !== "");   // value in selected <option>
   postValidate(isValid, errMsg, errElm, selectElm);
   return isValid;
}
 
/*
 * Validate that one of the checkboxes or radio buttons is checked.
 * Checkbox and radio are based on name attribute, not id.
 *
 * @param inputName (string): name attribute of the checkbox or radio
 */
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
 
// Validate password, 6-8 characters of [a-zA-Z0-9_]
function isValidPassword(inputElm, errMsg, errElm) {
   var isValid = (inputElm.value.trim().match(/^\w{6,8}$/) !== null);
   postValidate(isValid, errMsg, errElm, inputElm);
   return isValid;
}
 
// Verify password.
function verifyPassword(pwElm, pwVerifiedElm, errMsg, errElm) {
   var isTheSame = (pwElm.value === pwVerifiedElm.value);
   postValidate(isTheSame, errMsg, errElm, pwVerifiedElm);
   return isTheSame;
}
 
   // Remove previous error messages
   elms = document.querySelectorAll('[id$="Error"]');  // id ends with Error
   for (var i = 0; i < elms.length; i++) {
      elms[i].innerHTML = "";
   }
 
   // Set initial focus
   document.getElementById("txtName").focus();
