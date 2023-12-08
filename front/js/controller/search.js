// api url get global variabl from environment.js
// const api_url = sessionStorage.getItem("url_api")+"backend/book/book.php";
// const api_search_url = sessionStorage.getItem("url_api")+"/backend/book/book.php";

function onLoadSearch(text_val) {
  if (text_val) {
    var formData = new FormData();
    formData.append("keyword", text_val);
    // formData.append("userid", "");
    var url = global_url_api + "/backend/search/search.php";
    //   formData.append('x', 'hello');

    fetch(url, { method: "POST", body: formData })
      .then(function (response) {
        // console.log(response)
        return response.json();
      })
      .then(function (body) {
        //console.log(body);
        show(body);
      });
  }
}

function onSearch() {
  var keyword = document.getElementById("text_search").value;
  //console.log(keyword);
  // console.log(data[0].bookid);
  var formData = new FormData();
  formData.append("keyword", keyword);
  // formData.append("userid", "");

  var url = global_url_api + "/backend/search/search.php";
  //   formData.append('x', 'hello');

  fetch(url, { method: "POST", body: formData })
    .then(function (response) {
      // console.log(response)
      return response.json();
    })
    .then(function (body) {
      //console.log(body);
      show(body);
    });
}

function show(data) {
  let val_book = "";
  for (let book_detail of data) {
    val_book += `<a href = "../book/bookdetail.php?${book_detail.bookid}">

            <div class="card mx-0 pb-4 mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <div style="height: 16em;">
                        <div class="h-100 d-inline-block">
                            <img class="mh-100" src="${
                              book_detail.coverfileurl
                            }.png">
                            <!-- img class="mh-100" src="${global_file_url_api}/upload/pdf/${
      book_detail.bookid
    }/${book_detail.bookid}.png" alt="Max-width 100%" -->
                        </div>
                    </div>
                    <div class="mt-2">
                            <b class="card-title">${sub_title(
                              book_detail.title
                            )}</b>
                    </div>
                </div>
            </div>

    </a>`;
  }

  document.getElementById("resultList").innerHTML = val_book;
}

// Defining async function
async function getapi(url) {
  // Storing response
  const response = await fetch(url);

  // Storing data in form of JSON
  var data = await response.json();
  // console.log(data);
  // check_session();
  if (response) {
    hideloader();
  }
  onLoad1(data);
}

// check_authen();
// Calling that async function
// getapi(api_url);

function onLoad1(data) {
  let val_book = "";
  for (let book_detail of data) {
    val_book += `<a href = "book/bookdetail.php?id=${book_detail.bookid}">

            <div class="card mx-0 pb-4 mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <div style="height: 16em;">
                        <div class="h-100 d-inline-block">
                            <img class="mh-100" src="${
                              book_detail.coverfileurl
                            }" alt="Max-width 100%">
                        </div>
                    </div>
                    <div class="mt-2">
                            <b class="card-title">${sub_title(
                              book_detail.title
                            )}</b>
                    </div>
                </div>
            </div>

    </a>`;
  }

  document.getElementById("resultList").innerHTML = val_book;
}

function sub_title(txt_title) {
  let result = "";
  if (txt_title.length > 20) {
    result = txt_title.substring(0, 20) + "...";
  } else {
    result = txt_title;
  }
  return result;
}

// Function to hide the loader
function hideloader() {
  document.getElementById("loading").style.display = "none";
}
