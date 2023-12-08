// api url get global_variable from environment.js
const api_cat_url = global_url_api + "/backend/book/categories.php";

// Defining async function
async function getapi(url) {
  // Storing response
  const response = await fetch(url);

  // Storing data in form of JSON
  var data = await response.json();
  //   check_session();
  // console.log(data);
  if (response) {
    // hideloader();
  }
  show(data);
}

// check_authen();
// Calling that async function
// getapi(api_cat_url);

// Function to hide the loader
function hideloader() {
  //   document.getElementById("loading").style.display = "none";
}
// Function to define innerHTML for HTML table
function show(data) {
  let val_book = "";
  for (let categories_detail of data) {
    val_book += `<a href = "categories_detail.php?id=${categories_detail.categoryid}">

            <div class="card mx-0 pb-4 mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <div style="height: 10em;">
                        <div class="h-100 d-inline-block">
                            <img class="mh-100" src="../images/categories/${categories_detail.categoryid}.jpg" alt="Max-width 100%">
                        </div>
                    </div>
                    <div class="mt-2">
                            <b class="card-title">${categories_detail.categoryname}</b>
                    </div>
                </div>
            </div>

    </a>`;
  }

  document.getElementById("categoriesList").innerHTML = val_book;
}
