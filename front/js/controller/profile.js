
// api url get global_variable from environment.js
// console.log(window.location.search)
// console.log("test")
// console.log(window.location.search.replace(/[?]/g, ""));
// const api_url = global_url_api+"/test_elibrary/backend/book/bookdetail.php"+window.location.search.replace(/[?]/g, "");
const api_profile_url = "https://dev-elibrary.psu.ac.th/backend/profile/index.php?uid="+localStorage.getItem("uid");

// console.log(api_profile_url)
let data = "";
let borrowdaylimit = 0;
let share_url = "";
// Defining async function

// Defining async function
async function getapi(url) {
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	// console.log(data);
    // console.log(data[0]["fullname"])
    document.getElementById("fullname").innerHTML = data[0]["fullname"];
	document.getElementById("fullname_en").innerHTML = data[0]["fullname_en"];
	document.getElementById("email").innerHTML = data[0]["email"];
	document.getElementById("faculty").innerHTML = data[0]["faculty"];
	document.getElementById("department").innerHTML = data[0]["department"];
	check_session();
	show(data);

}

check_authen();
// Calling that async function
getapi(api_profile_url);

function show(data) {

}
