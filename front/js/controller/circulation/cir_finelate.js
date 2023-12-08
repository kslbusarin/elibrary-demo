
// api url get global variabl from environment.js
const api_url = global_url_api+"/backend/cir/search_finelate.php";
// alert(window.location.search);
// Defining async function
async function getapi(url) {
    var formData = new FormData();
    formData.append("uid", localStorage.getItem("uid"));
    
    fetch(url, { method: 'POST', body: formData })
    .then(function (response) {
        // console.log(response)
        return response.json();
    })
    .then(function (body) {
        // console.log(body);
        show(body);
    });

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
    <th>TITLE</th>
    <th>USERNAME</th>
    <th>PATRON_NAME</th>
    <th>ค่าปรับ</th>
    <th>CHECKOUT_DATETIME_RE</th>
    <th>RENEW_DATETIME</th>
    <th>DUE_DATETIME</th>
    <th>CHECKIN_DATETIME</th>
    <th>DEBT_TYPE_THAI</th>
    </thead>`;

    let sum = 0;
    // Loop to access all rows
    // console.log(data.length)
    if(data.length>0){
        for (let r of data) {
            tab += `<tr>
                        <td>${r.TITLE}</td>
                        <td>${r.PATRON_BARCODE}</td>
                        <td>${r.PATRON_NAME}</td>
                        <td><h5 class="text-danger">${r.FINE_AMOUNT}</h5></td>
                        <td>${r.CHECKOUT_DATETIME_RE}</td>
                        <td>${r.RENEW_DATETIME}</td>		
                        <td>${r.DUE_DATETIME}</td>
                        <td>${r.CHECKIN_DATETIME}</td>		
                        <td>${r.DEBT_TYPE_THAI}</td>		
                    </tr>`;
                    sum = sum + Number(r.FINE_AMOUNT);
        }
        tab += `<tr>
                    <td colspan='2'>รวม</td>
                    <td class='text-left'><h4 class='text-danger'> ${sum} </h4></td>
                    <td>บาท</td>	
                </tr>`;
            tab += `<tr>
                <td colspan='8' class='text-center'><button class='btn btn-md btn-success' onclick="myFunction()">ชำระ</button></td>	
            </tr>`;
    }
    else{
        tab += `<tr>
        <td colspan='8'>ไม่มียอดค้างชำระ</td>		
        </tr>`;
    }
    // Setting innerHTML as tab variable to book thumnail
    document.getElementById("myborrowTable").innerHTML = tab;

}



function createReturn(bookid){
    // console.log("return");
    // console.log(bookid);
    // alert("Not complete")
    

  var url = global_url_api+"/backend/book/bookreturn.php"
    
    
}





