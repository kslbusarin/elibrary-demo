
// api url get global variabl from environment.js
// console.log(localStorage.getItem("userid"))
const api_book_history_url = sessionStorage.getItem("url_api")+"/backend/borrow/borrowhistory.php?id="+localStorage.getItem("userid");

// Defining async function
async function getapi(url) {
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	// console.log(data);
	if (response) {
		hideloader();
	}
	show(data);
    check_session();
    document.getElementById("url_myborrow").href = "borrowhistory/index.php?id="+localStorage.getItem("userid");
}

check_authen();
// Calling that async function
getapi(api_book_history_url);

// Function to hide the loader
function hideloader() {
	// document.getElementById('loading').style.display = 'none';
}

// Function to define innerHTML for HTML table
function show(data) {
    let val_book = '';

    let tab =
    `<thead class="bg-success text-white">
    <th>ชื่อเรื่อง</th>
    <th>วันที่ยืม</th>
    <th>กำหนดคืน</th>
    </thead>`;

    // Loop to access all rows
    for (let r of data) {
        tab += `<tr>
                    <td><a href ='../book/bookdetail.php?${r.bookid}'>${r.title}</a></td>
                    <td>${r.borrowstartdate}</td>
                    <td>${r.borrowenddate}</td>		
                </tr>`;
    }
    // Setting innerHTML as tab variable to book thumnail
    document.getElementById("borrowHistoryTable").innerHTML = tab;

}

function gotoMyBorrow(){
    window.location.replace("../myborrow/index.php?id="+localStorage.getItem("userid"));
}

