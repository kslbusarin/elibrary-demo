
// api url get global variabl from environment.js
const api_url = global_url_api+"/backend/cir/search_item.php?"+localStorage.getItem("userid");;
// alert(window.location.search);
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
    document.getElementById("url_myborrow").href = "myborrow/index.php?id="+localStorage.getItem("userid");
}

check_authen();
// Calling that async function
getapi(api_url);


// Function to hide the loader
function hideloader() {
	// document.getElementById('loading').style.display = 'none';
}

// Function to define innerHTML for HTML table
function show(data) {
    let val_book = '';

    let tab =
    `<thead class="bg-primary text-white">
    <th>No</th>
    <th>PATRON_BARCODE</th>
    <th>PATRON_NAME</th>
    <th>ITEM_BARCODE</th>
    <th>TITLE</th>
    <th>CHECKOUT</th>
    <th>DUE_DATETIME</th>
    <th>CHECKIN_DATETIME</th>
    </thead>`;

    // Loop to access all rows
    i=1;
    for (let r of data) {
        tab += `<tr>
                    <td>${i}</td>
                    <td>${r.BARCODE}</td>
                    <td>${r.PATRON_NAME}</td>
                    <td>${r.ITEMBARCODE}</td>
                    <td>${r.TITLE}</td>			
                    <td>${r.CHECKOUT}</td>
                    <td>${r.DUE}</td>		
                    <td>${r.CHECKIN}</td>			
                </tr>`;
                i++;
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

  var url = global_url_api+"/backend/book/bookreturn.php"
    
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




