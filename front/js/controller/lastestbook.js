// api url get global variabl from environment.js
// const api_url = global_url_api+"/backend/book/book.php";
const api_url_lastestbook = global_url_api+"/backend/book/lastestbook.php";


// Defining async function
async function getapi(url) {
    
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	// console.log(data);
    check_authen();
	if (response) {
		hideloader();
	}
    check_authen();
	show(data,'booklist');
    
}


// Calling that async function

getapi(api_url_lastestbook);
// getapi_top_book(api_url_top_book);


function logout(){
    localStorage.clear();
    location.reload();
    // fetch(global_url_api+'/test_elibrary/upload/pdf/109/clone/index.php')
    // .then(location.href = global_url_api+'/test_elibrary/frontend/');

}

function  check_authen(){
    let username = localStorage.getItem("username");
    // console.log(username)
        if(username){
          document.getElementById("txt_username").innerHTML = localStorage.getItem("uid")+" "+window.username;
          document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" onclick="logout()" role="button">Logout</a>`; 
          document.getElementById("url_myborrow").href = "myborrow/index.php?id="+localStorage.getItem("userid");
        }
        else if(username == null){
          document.getElementById("txt_username").innerHTML = "";
          //document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" href="authen" role="button">Login</a>`; 
        }
}

// Function to hide the loader
function hideloader() {
	document.getElementById('loading').style.display = 'none';
}
// Function to define innerHTML for HTML table
function show(data) {
    check_authen();
    check_session();

    let val_book = '';
    // console.log(data)
    for (let book_detail of data) {
    val_book +=  `<a href = "../book/bookdetail.php?${ book_detail.bookid }">
    <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
        <div class="card-body">
            <div style="height: 16em;">
                <div class="h-100 d-inline-block">
                    <!-- img class="mh-100" src="${ book_detail.coverfileurl }" alt="Max-width 100%" -->
                    <!-- img class="mh-100" src="${global_url_api }/test_elibrary/upload/pdf/${ book_detail.bookid}/${ book_detail.bookid}.png" 
                    alt="${ book_detail.bookid }" -->
                    <!-- img class="mh-100" src="${global_url_api }/demo5/pdf/${ book_detail.bookid}/${ book_detail.bookid}.png" 
                    alt="${ book_detail.bookid }" -->
                    <img class="mh-100" src="${ book_detail.coverfileurl }">
                </div>
            </div>
        </div>
        <div class=" mx-4">
            <h5 class="text-start">${ sub_title(book_detail.title) }</h5>
            
        </div>
        <div class="row mt-3">
            <div class="d-inline col-5 ms-4">
                <p class="h5 text-start text-primary">Read more</p>
            </div>
            <div class="d-inline col-5 me-1">
                <!-- p class="text-end text-secondary"><i class="fa-solid fa-book pe-1"></i> ${ book_detail.count } <i class="fa-solid fa-eye ps-2"></i> ${ book_detail.bookviewcount }</p -->
            </div>
        </div>
    </div>
    </a>`
    }

    document.getElementById("booklist").innerHTML = val_book;

    let tab =
    `<tr>
    <th>BookID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Year</th>
    </tr>`;

    // Loop to access all rows
    for (let r of data) {
        tab += `<tr>
                    <td>${r.bookid} </td>
                    <td>${r.title}</td>
                    <td>${r.description}</td>
                    <td>${r.year}</td>		
                </tr>`;
    }
    // Setting innerHTML as tab variable to book thumnail
    // document.getElementById("bookTable").innerHTML = tab;

}



function sub_title(txt_title){
    let result = "";
    if(txt_title.length > 23){
        result  = txt_title.substring(0, 23)+"...";
    }
    else{
        result = txt_title;
    }
    return result;
}

    var object = JSON.parse(localStorage.getItem("key")),
    dateString = object.timestamp,
    userid = object.userid,
    now = new Date();

    if(dateString){
        // JavaScript program to illustrate 
        // calculation of no. of days between Log in and time now
    
        // To set two dates to two variables
        var date2 = new Date();
        var date1 = new Date(dateString)
        console.log("userid : "+userid)
        console.log("Log in : "+date1)
        console.log("Time now : " +date2)
    
        // To calculate the time difference of time
        var Difference_In_Time = date2.getTime() - date1.getTime();
        
        // To calculate the no. of days between time
        var Difference_In_Hours = Difference_In_Time / (1000 * 60);

        //To display the final no. of days (result)
        if(Difference_In_Hours>120){
            logout();
        }
        console.log("Difference is "+ Difference_In_Hours + " Min");
    }
  