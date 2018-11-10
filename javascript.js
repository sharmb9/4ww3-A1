//Validates the User registration form on the first page
function validateForm() {
	var x= document.forms["register_form"]["email"].value;
	var y= document.forms["register_form"]["psw"].value;
	var z= document.forms["register_form"]["psw-repeat"].value;
	var rad= document.forms["register_form"]["terms"].value;

	//Makes sure email and password sections are not empty, might be overwritten by HTML5's validation
	if (x == "" || y == "") {
		alert("Please fill in all the fields");
		return false;
	}
	//Makes sure passwords match
	if (y != z) {
		alert("Password doesn't match!");
		return false;
	}
	//Makes sure user has agreed to terms and conditions (Fix this, not working right now)
	if (rad.checked == false){
		alert("You need to check the terms and conditions");
		return false;
	} 
	
}