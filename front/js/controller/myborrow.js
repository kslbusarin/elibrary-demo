
// api url get global variabl from environment.js
const api_myborrow_url = sessionStorage.getItem("url_api")+"backend/borrow/myborrow.php?id="+localStorage.getItem("userid");
// alert(window.location.search);
// Defining async function
async function getapi(url) {
    console.log(url);
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
    document.getElementById("url_myborrow").href = "myborrow/index.php?id="+localStorage.getItem("userid");
}

check_authen();
// Calling that async function
getapi(api_myborrow_url);


// Function to hide the loader
function hideloader() {
	// document.getElementById('loading').style.display = 'none';
}

// Function to define innerHTML for HTML table
function show(data) {
    let val_book = '';

    let tab =
    `<thead class="bg-primary text-white">
    <th>ชื่อเรื่อง</th>
    <th>วันที่ยืม</th>
    <th>กำหนดคืน</th>
    <th>คืน</th>
    </thead>`;

    // Loop to access all rows
    for (let r of data) {
        tab += `<tr>
                    <td><a href ='../book/bookdetail.php?${r.bookid}'>${r.title}</a></td>
                    <td>${r.borrowstartdate}</td>
                    <td>${r.borrowenddate}</td>
                    <td><button class='btn btn-danger btn-md'  onclick='createReturn(${r.bookid})'>คืน</button></td>		
                </tr>`;
    }
    // Setting innerHTML as tab variable to book thumnail
    document.getElementById("myborrowTable").innerHTML = tab;

}

function gotoBorrowHistory(){
    window.location.replace("../borrowhistory/index.php?id="+localStorage.getItem("userid"));
}

function createReturn(bookid){
    // console.log("return");
    // console.log(bookid);
    // alert("Not complete")
    var formData = new FormData();
    formData.append("bookid", bookid);
    formData.append("userid", localStorage.getItem("userid"));
    formData.append("uid", localStorage.getItem("uid"));

  var url = sessionStorage.getItem("url_api")+"backend/book/bookreturn.php"
    
    fetch(url, { method: 'POST', body: formData })
    .then(function (response) {
        // console.log(response)
        return response.json();
    })
    .then(function (body) {
        console.log(body);
        location.reload();
    });
}




