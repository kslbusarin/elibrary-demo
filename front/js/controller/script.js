// // api url get global variabl from environment.js
const global_url_api = 'https://dev-elibrary.psu.ac.th/'
// const global_file_url_api = 'https://192.168.27.106/newelibrary/demo5/'
const api_url = global_url_api+"backend/book/book_home.php";
const api_url_cambridge = global_url_api+"backend/book/book_cambridge.php";
// const api_url_top_book = global_url_api+"backend/book/top_book.php";



function check_authen(){
    if(localStorage.getItem("userid") == null){
        // console.log(sessionStorage.getItem("userid"));
        // console.log("redirect authen");
        const queryString = window.location.href;
        const urlParams = new URLSearchParams(queryString);
        console.log(queryString);
        sessionStorage.setItem("tmpbookurl",queryString);
        window.location.replace(global_url_api+"/test_elibrary/front/authen/");
    }
}

function check_session(){
    // let username = sessionStorage.getItem("username");
    // console.log(localStorage.getItem("username"))
    if(localStorage.getItem("username")){
        console.log(localStorage.getItem("uid"))
        console.log(localStorage.getItem("username"))
        if(localStorage.getItem("uid") && localStorage.getItem("username")){
        document.getElementById("txt_username").innerHTML = localStorage.getItem("uid")+" "+localStorage.getItem("username");
        document.getElementById("btn_authen").innerHTML = `<a class="btn btn-sm btn-outline-light" onclick="logout()" role="button">Logout</a>`;
        }
        else{
            window.location.replace(global_url_api+"/test_elibrary/front/authen/");
        }
    }
    else{
      document.getElementById("txt_username").innerHTML = "";
      document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" href="front/authen/index.php?action=login" role="button">Login</a>`; 
    }

}


// Defining async function
async function getapi(url) {
    
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	// console.log(data);

	if (response) {
        show(data,'booklist');
	}

	
    
}

// Defining async function
async function getapiNewPerm(url) {
    
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	// console.log(data);

	if (response) {
        show(data,'booklist');
	}

	
    
}

// Defining async function
async function getapiCambridge(url) {
    
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	// console.log(data);

	if (response) {
        showCambridge(data,'book_cambridge');
	}

	
    
}

function logout(){

    localStorage.clear();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET',global_url_api+'backend/authen/logout.php', true);
    xmlhttp.onreadystatechange=function(){
       if (xmlhttp.readyState == 4){
          if(xmlhttp.status == 200){
            console.log(xmlhttp.responseText);
         }
       }
    };
    xmlhttp.send(null);
    location.href = '../../';
    // fetch(global_url_api+'/test_elibrary/upload/pdf/109/clone/index.php')
    // .then(location.href = global_url_api+'/test_elibrary/front/');

}


// Function to define innerHTML for HTML table
function show(data) {
    
    let val_book = '';
    let i=0;
    // console.log(data)
    for (let book_detail of data) {
    // val_book +=  `<a href = "book/bookdetail.php?id=${ book_detail.bookid }">
    i++;
    val_book +=  `<div class="carousel-item">
                        <div class="card"
                        <div class="card-body bg-white position-relative" style="height: 550px;">
                                <div class="text-center">
                                    <img src="${ book_detail.coverfileurl }"  style="width:100%;" alt="...">
                                </div>
                                <div class="position-absolute top-0 start-0"></div>
                                <div class="position-absolute top-0 end-0"></div>
                                <div class="position-absolute top-50 start-50"></div>
                                <div class="position-absolute bottom-50 start-0"></div>
                                <div class="position-absolute bottom-50 end-50"></div>
                                <div class="position-absolute bottom-0 start-0">
                                <div class="bg-white ps-2 pb-2">
                                    <div id="title${i}" class="mb-3"><b class="card-title">${ sub_title(book_detail.title) }</b></div>
                                        <!-- p class="card-text">${ sub_title(book_detail.authorname) }</p -->
                                        <a href=" ${ global_url_api }front/book/bookdetail.php?${book_detail.bookid}" class="btn btn-sm btn-primary">อ่าน</a>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-0 end-0"></div>
                        </div>
                    </div>
                </div>`
    }



    // console.log(val_book)

    document.getElementById("booklist").innerHTML = val_book;




   

    // let tab =
    // `<tr>
    // <th>BookID</th>
    // <th>Title</th>
    // <th>Description</th>
    // <th>Year</th>
    // </tr>`;

    // // Loop to access all rows
    // for (let r of data) {
    //     tab += `<tr>
    //                 <td>${r.bookid} </td>
    //                 <td>${r.title}</td>
    //                 <td>${r.description}</td>
    //                 <td>${r.year}</td>		
    //             </tr>`;
    // }


}

function showNewPerm(data) {

    let val_book = '';
    let i=0;
    // console.log(data)
    for (let book_detail of data) {
    // val_book +=  `<a href = "book/bookdetail.php?id=${ book_detail.bookid }">
    i++;
    val_book +=  `<div class="carousel-item-newbook mt-2 ms-2"> 
                    <div class="card"
                        <div class="card-body bg-white position-relative" style="height: 550px;">
                                <div class="text-center">
                                    <img src="${ book_detail.coverfileurl }" id="cover_newbook"  style="width:100%;" alt="...">
                                </div>
                                <div class="position-absolute top-0 start-0"></div>
                                <div class="position-absolute top-0 end-0"></div>
                                <div class="position-absolute top-50 start-50"></div>
                                <div class="position-absolute bottom-50 start-0"></div>
                                <div class="position-absolute bottom-50 end-50"></div>
                                <div class="position-absolute bottom-0 start-0">
                                <div class="bg-white ps-2 pb-2">
                                    <div id="title${i}" class="mb-3"><b class="card-title">${ sub_title(book_detail.title) }</b></div>
                                        <!-- p class="card-text">${ sub_title(book_detail.authorname) }</p -->
                                        <a href=" ${ global_url_api }front/book/bookdetail.php?${book_detail.bookid}" class="btn btn-sm btn-primary">อ่าน</a>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-0 end-0"></div>
                        </div>
                    </div>
                </div>`
    }



    // console.log(val_book)

    document.getElementById("bookNewPerm").innerHTML = val_book;



}

function showCambridge(data) {

    let val_book = '';
    let i=0;
    // console.log(data)
    for (let book_detail of data) {
    // val_book +=  `<a href = "book/bookdetail.php?id=${ book_detail.bookid }">
    i++;
    val_book +=  `<div class="carousel-item-newbook mt-2 ms-2"> 
                    <div class="card"
                        <div class="card-body bg-white position-relative" style="height: 550px;">
                                <div class="text-center">
                                    <img src="${ book_detail.coverfileurl }" id="cover_newbook"  style="width:100%;" alt="...">
                                </div>
                                <div class="position-absolute top-0 start-0"></div>
                                <div class="position-absolute top-0 end-0"></div>
                                <div class="position-absolute top-50 start-50"></div>
                                <div class="position-absolute bottom-50 start-0"></div>
                                <div class="position-absolute bottom-50 end-50"></div>
                                <div class="position-absolute bottom-0 start-0">
                                <div class="bg-white ps-2 pb-2">
                                    <div id="title${i}" class="mb-3"><b class="card-title">${ sub_title(book_detail.title) }</b></div>
                                        <!-- p class="card-text">${ sub_title(book_detail.authorname) }</p -->
                                        <a href=" ${ global_url_api }front/book/bookdetail.php?${book_detail.bookid}" class="btn btn-sm btn-primary">อ่าน</a>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-0 end-0"></div>
                        </div>
                    </div>
                </div>`
    }



    // console.log(val_book)

    document.getElementById("book_cambridge").innerHTML = val_book;



}



function sub_title(txt_title){
    let result = "";

    if(txt_title){
        if(txt_title.length > 22){
            result  = txt_title.substring(0, 22)+"...";
        }
        else{
            result = txt_title;
        }
    }
    else{
        result = "<br>";
    }
    return result;
}


function imgSize(id){
    var myImg = document.querySelector("#aaaa");
        var currWidth = myImg.clientWidth;
        var currHeight = myImg.clientHeight;
        
        // console.log("Current width=" + currWidth + ", " + "Original height=" + currHeight);
}



// Calling that async function
check_session();
// getapi(api_url);
// getapiNewPerm(api_url);
getapiCambridge(api_url_cambridge);