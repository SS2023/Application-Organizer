/* 
* The only component of an application or offer that is 
* required is the company name. This alerts the user if 
* the name has not been entered
*/
function validateForm() {
    let x = document.forms["newForm"]["company"].value;
    if (x == "") {
        alert("Company name must be filled out");
        return false;
    }
}