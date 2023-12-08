// api url get global_variable from environment.js
const api_cat_detail_url =
  global_url_api +
  "/backend/categories/categories_detail.php" +
  window.location.search;

// console.log(api_url)
let data = "";
// Defining async function
async function getapi(url) {
  // Storing response
  const response = await fetch(url);

  // Storing data in form of JSON
  var data = await response.json();
  // check_session();
  // console.log(data);
  if (response) {
    hideloader();
  }
  show(data);
}

// check_authen();
// Calling that async function
// getapi(api_cat_detail_url);

// Function to hide the loader
function hideloader() {
  document.getElementById("loading").style.display = "none";
}
// Function to define innerHTML for HTML table
function show(data) {
  let val_book = "";
  let category_name = "";
  for (let cat_detail of data) {
    category_name = cat_detail.categoryname;
    val_book += `<a href = "../book/bookdetail.php?${cat_detail.bookid}">
                <div class="card mx-0 pb-4 mb-4 rounded-3 shadow-sm">
                    <div class="card-body">
                        <div style="height: 16em;">
                            <div class="h-100 d-inline-block">
                                <img class="mh-100" src="${
                                  cat_detail.coverfileurl
                                }.png">
                                <!-- img class="mh-100" src="../../upload/pdf/${
                                  cat_detail.bookid
                                }/${
      cat_detail.bookid
    }.png" alt="Max-width 100%" -->
                            </div>
                        </div>
                        <div class="mt-2">
                                <b class="card-title">${sub_title(
                                  cat_detail.title
                                )}</b>
                        </div>
                    </div>
                </div>
    
        </a>`;
  }

  document.getElementById("category_name").innerHTML = category_name;
  document.getElementById("bookList").innerHTML = val_book;
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
