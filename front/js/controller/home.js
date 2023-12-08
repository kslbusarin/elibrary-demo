// api url get global variabl from environment.js
let hostname = location.hostname;
// const global_url_api = 'https://192.168.27.106/'
// const global_url_api = sessionStorage.getItem("url_api");
// const global_file_url_api = 'http://192.168.27.106/newelibrary/demo5/'
// const api_url = sessionStorage.getItem("url_api")+"backend/book/book.php";
// const api_url_top_book = sessionStorage.getItem("url_api")+"backend/book/top_book.php";
// const api_url_cambridge = sessionStorage.getItem("url_api")+"backend/book/book_cambridge.php";
const url_set = "http://172.22.75.70/";
const api_url = url_set + "backend/book/book.php";
const api_url_top_book = url_set + "backend/book/top_book.php";
const api_url_cambridge = url_set + "backend/book/book_cambridge.php";

function check_authen() {
  if (localStorage.getItem("username") == null) {
    // console.log(sessionStorage.getItem("userid"));
    // console.log("redirect authen");
    const queryString = window.location.href;
    const urlParams = new URLSearchParams(queryString);
    // console.log(queryString);

    sessionStorage.setItem("tmpbookurl", queryString);
    // window.location.replace(global_url_api+"/frontend/");
  }
}

function check_session() {
  // let username = sessionStorage.getItem("username");
  // console.log("aaa")
  // console.log(localStorage.getItem("username"))
  if (localStorage.getItem("username") !== null) {
    // console.log(localStorage.getItem("uid"))
    // console.log(localStorage.getItem("username"))
    if ("uid" in localStorage && "username" in localStorage) {
      document.getElementById("txt_username").innerHTML =
        "<a class='text-white' href='../dashboard'>" +
        localStorage.getItem("fullname_en") +
        "</a>";
      document.getElementById(
        "btn_authen"
      ).innerHTML = `<a class="btn btn-outline-light" onclick="logout()" role="button">Logout</a>`;
      document.getElementById("url_myborrow").href =
        "../myborrow/index.php?id=" + localStorage.getItem("username");
    } else {
      // window.location.replace(global_url_api+"/test_elibrary/frontend/authen/");
    }
  } else {
    document.getElementById("txt_username").innerHTML = "";
    document.getElementById(
      "btn_authen"
    ).innerHTML = `<a class="btn btn-outline-light" href="authen/" role="button">Login</a>`;
  }
}

function logout() {
  // alert("logout2");
  localStorage.clear();

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", global_url_api + "backend/authen/logout.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4) {
      if (xmlhttp.status == 200) {
        // console.log(xmlhttp.responseText);
      }
    }
  };
  xmlhttp.send(null);
  // location.reload();
  location.href = "../../";
  // fetch(global_url_api+'/test_elibrary/upload/pdf/109/clone/index.php')
  // .then(location.href = global_url_api+'/test_elibrary/frontend/');
}

// Defining async function
async function getapi(url) {
  // Storing response
  const response = await fetch(url);

  // Storing data in form of JSON
  var data = await response.json();
  // console.log(data);
  //   check_authen();
  if (response) {
    hideloader();
  }
  //   check_authen();
  show(data);
}

// Defining async function
async function getapi_top_book(url) {
  // Storing response
  const response = await fetch(url);

  // Storing data in form of JSON
  var data = await response.json();
  // console.log(data);
  if (response) {
    hideloader();
  }
  show_topbook(data);
}

function check_authen_old() {
  let username = localStorage.getItem("username");
  // console.log(username)
  if (!username) {
    document.getElementById("txt_username").innerHTML = window.username;
    document.getElementById(
      "btn_authen"
    ).innerHTML = `<a class="btn btn-outline-light" onclick="logout()" role="button">Logout</a>`;
    document.getElementById("url_myborrow").href =
      "myborrow/index.php?id=" + localStorage.getItem("username");
  } else if (username == null) {
    document.getElementById("txt_username").innerHTML = "";
    //document.getElementById("btn_authen").innerHTML = `<a class="btn btn-outline-light" href="authen" role="button">Login</a>`;
  }
}

// Function to hide the loader
function hideloader() {
  document.getElementById("loading").style.display = "none";
}
// Function to define innerHTML for HTML table
function show(data) {
  // console.log(data);

  let val_book = "";

  for (let book_detail of data) {
    // val_book +=  `<a href = "book/bookdetail.php?id=${ book_detail.bookid }">
    val_book += `<a href = "../book/bookdetail.php?${book_detail.bookid}">
    <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
        <div class="card-body">
            <div style="height: 16em;">
                <div class="h-100 d-inline-block">
                    <!-- img class="mh-100" src="${
                      book_detail.coverfileurl
                    }" alt="Max-width 100%" -->
                    <!-- img class="mh-100" src="${global_file_url_api}/demo5/pdf/${
      book_detail.bookid
    }/${book_detail.bookid}.png" 
                    alt="${book_detail.bookid}" -->
                    <!-- img class="mh-100" src="${global_url_api}/demo5/pdf/${
      book_detail.bookid
    }/${book_detail.bookid}.png" 
                    alt="${book_detail.bookid}" -->
                    <img class="mh-100" src="${book_detail.coverfileurl}">
                </div>
            </div>
        </div>
        <div class=" mx-4">
            <h5 class="text-start">${sub_title(book_detail.title)}</h5>
            <p class="text-start text-secondary">${sub_title(
              book_detail.authorname
            )}</p>
        </div>
        <div class="row mt-3">
            <div class="d-inline col-5 ms-4">
                <p class="text-start text-primary">Read more</p>
            </div>
            <div class="d-inline col-5 me-1">
                <p class="text-end text-secondary"><i class="fa-solid fa-book pe-1"></i> ${
                  book_detail.count
                } <i class="fa-solid fa-eye ps-2"></i> ${
      book_detail.bookviewcount
    }</p>
            </div>
        </div>
    </div>
    </a>`;
  }

  document.getElementById("booklist").innerHTML = val_book;

  let tab = `<tr>
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

// Function to define innerHTML for HTML table
function show_topbook(data) {
  let val_book = "";
  // console.log(data)
  for (let book_detail of data) {
    // val_book +=  `<a href = "book/bookdetail.php?id=${ book_detail.bookid }">
    val_book += `<a href = "../book/bookdetail.php?${book_detail.bookid}">
            <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
                <div class="card-body">
                    <div style="height: 16em;">
                        <div class="h-100 d-inline-block">
                            <!-- img class="mh-100" src="${
                              book_detail.coverfileurl
                            }" alt="Max-width 100%" -->
                            <!-- img class="mh-100" src="${global_file_url_api}/test_elibrary/upload/pdf/${
      book_detail.bookid
    }/${book_detail.bookid}.png" 
                            alt="${book_detail.bookid}" -->
                            <!-- img class="mh-100" src="${global_file_url_api}/demo5/pdf/${
      book_detail.bookid
    }/${book_detail.bookid}.png" alt="${book_detail.bookid}" -->
                            <img class="mh-100" src="${
                              book_detail.coverfileurl
                            }">
                        </div>
                    </div>
                </div>
                <div class=" mx-4">
                    <h5 class="text-start">${sub_title(book_detail.title)}</h5>
                    <p class="text-start text-secondary">${sub_title(
                      book_detail.authorname
                    )}</p>
                </div>
                <div class="row mt-3">
                    <div class="d-inline col-5 ms-4">
                        <p class="h5 text-start text-primary">Read more</p>
                    </div>
                    <div class="d-inline col-5 me-1">
                        <p class="text-end text-secondary"><i class="fa-solid fa-book pe-1"></i> ${
                          book_detail.count
                        } <i class="fa-solid fa-eye ps-2"></i> ${
      book_detail.bookviewcount
    }</p>
                    </div>
                </div>
            </div>
            </a>`;
  }

  document.getElementById("top_booklist").innerHTML = val_book;

  let tab = `<tr>
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

function sub_title(txt_title) {
  let result = "";

  if (txt_title) {
    if (txt_title.length > 23) {
      result = txt_title.substring(0, 23) + "...";
    } else {
      result = txt_title;
    }
  } else {
    result = "<br>";
  }
  return result;
}

async function getapiCambridge(url) {
  // console.log(url);
  // Storing response
  const response = await fetch(url);

  // Storing data in form of JSON
  var data = await response.json();
  // console.log(data);

  if (response) {
    showCambridge(data, "book_cambridge");
  }
}

function showCambridge(data) {
  let val_book = "";
  let i = 0;
  // console.log(data)
  for (let book_detail of data) {
    // val_book +=  `<a href = "book/bookdetail.php?id=${ book_detail.bookid }">
    i++;
    val_book += `<a href = "../book/bookdetail.php?${book_detail.bookid}">
            <div class="card mx-0 py-2 mb-4 rounded-2 shadow-sm">
                <div class="card-body">
                    <div style="height: 16em;">
                        <div class="h-100 d-inline-block">
                            <!-- img class="mh-100" src="${
                              book_detail.coverfileurl
                            }" alt="Max-width 100%" -->
                            <!-- img class="mh-100" src="${global_file_url_api}/test_elibrary/upload/pdf/${
      book_detail.bookid
    }/${book_detail.bookid}.png" 
                            alt="${book_detail.bookid}" -->
                            <!-- img class="mh-100" src="${global_file_url_api}/demo5/pdf/${
      book_detail.bookid
    }/${book_detail.bookid}.png" alt="${book_detail.bookid}" -->
                            <img class="mh-100" src="${
                              book_detail.coverfileurl
                            }">
                        </div>
                    </div>
                </div>
                <div class=" mx-4">
                    <h5 class="text-start">${sub_title(book_detail.title)}</h5>
                    <p class="text-start text-secondary">${sub_title(
                      book_detail.authorname
                    )}</p>
                </div>
                <div class="row mt-3">
                    <div class="d-inline col-5 ms-4">
                        <p class="h5 text-start text-primary">Read more</p>
                    </div>
                    <div class="d-inline col-5 me-1">
                        <p class="text-end text-secondary"><i class="fa-solid fa-book pe-1"></i> ${0} <i class="fa-solid fa-eye ps-2"></i> ${0}</p>
                    </div>
                </div>
            </div>
            </a>`;
  }

  // console.log(val_book)

  document.getElementById("book_cambridge").innerHTML = val_book;
  document.getElementById("book_cambridge").innerHTML = val_book;
}

// check_authen();
// check_session();

// Calling that async function
getapi(api_url);
getapi_top_book(api_url_top_book);
getapiCambridge(api_url_cambridge);

var object = JSON.parse(localStorage.getItem("key")),
  dateString = object.timestamp,
  userid = object.userid,
  now = new Date();

if (dateString) {
  // JavaScript program to illustrate
  // calculation of no. of days between Log in and time now

  // To set two dates to two variables
  var date2 = new Date();
  var date1 = new Date(dateString);
  // console.log("userid : "+userid)
  // console.log("Log in : "+date1)
  // console.log("Time now : " +date2)

  // To calculate the time difference of time
  var Difference_In_Time = date2.getTime() - date1.getTime();

  // To calculate the no. of days between time
  var Difference_In_Hours = Difference_In_Time / (1000 * 60);

  //To display the final no. of days (result)
  if (Difference_In_Hours > 120) {
    logout();
  }
  // console.log("Difference is "+ Difference_In_Hours + " Min");
}
