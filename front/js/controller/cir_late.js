
// api url get global variabl from environment.js
const api_url = global_url_api+"/backend/cir/search_late.php?"+localStorage.getItem("userid");;
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
    <th>ITEM_NO</th>
    <th>ITEM_BARCODE</th>
    <th>TITLE</th>
    <th>COLLECTION_THAI</th>
    <th>PATRON_BARCODE</th>
    <th>PATRON_NAME</th>
    <th>ค่าปรับ</th>
    <th>PATRON_TYPE_THAI</th>
    <th>FAC_THAI</th>
    <th>DEPT_THAI</th>
    <th>CHECKOUT_DATETIME_RE</th>
    <th>RENEW_DATETIME</th>
    <th>DUE_DATETIME</th>
    <th>CHECKIN_DATETIME</th>
    <th>OFFICER_CHECKOUT</th>
    <th>DEBT_TYPE_THAI</th>
    </thead>`;

    // Loop to access all rows
    for (let r of data) {
        tab += `<tr>
                    <td>${r.ITEM_NO}</td>
                    <td>${r.ITEM_BARCODE}</td>
                    <td>${r.TITLE}</td>
                    <td>${r.COLLECTION_THAI}</td>
                    <td>${r.PATRON_BARCODE}</td>		
                    <td>${r.PATRON_NAME}</td>
                    <td><h5 class="text-danger">${r.FINE_AMOUNT}</h5></td>
                    <td>${r.PATRON_TYPE_THAI}</td>		
                    <td>${r.FAC_THAI}</td>
                    <td>${r.DEPT_THAI}</td>		
                    <td>${r.CHECKOUT_DATETIME_RE}</td>
                    <td>${r.RENEW_DATETIME}</td>		
                    <td>${r.DUE_DATETIME}</td>
                    <td>${r.CHECKIN_DATETIME}</td>		
                    <td>${r.OFFICER_CHECKOUT}</td>
                    <td>${r.DEBT_TYPE_THAI}</td>		
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




