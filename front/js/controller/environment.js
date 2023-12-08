let global_url_api = "";
let global_file_url_api = "";

function check_authen() {
  //   if (localStorage.getItem("userid") == null) {
  //     // console.log(sessionStorage.getItem("userid"));
  //     // console.log("redirect authen");
  //     const queryString = window.location.href;
  //     const urlParams = new URLSearchParams(queryString);
  //     // console.log(queryString);
  //     sessionStorage.setItem("tmpbookurl", queryString);
  //     window.location.replace(global_url_api + "/front/authen/");
  //   }
}

function check_session() {
  //   // let username = sessionStorage.getItem("username");
  //   // console.log(localStorage.getItem("username"))
  //   if (localStorage.getItem("username")) {
  //     // console.log(localStorage.getItem("uid"))
  //     // console.log(localStorage.getItem("username"))
  //     if (localStorage.getItem("uid") && localStorage.getItem("username")) {
  //       document.getElementById("txt_username").innerHTML =
  //         localStorage.getItem("username");
  //       document.getElementById(
  //         "btn_authen"
  //       ).innerHTML = `<a class="btn btn-outline-light" onclick="logout()" role="button">Logout</a>`;
  //       document.getElementById("url_myborrow").href =
  //         "../myborrow/index.php?id=" + localStorage.getItem("userid");
  //     } else {
  //       window.location.replace(global_url_api + "/front/authen/");
  //     }
  //   } else {
  //     document.getElementById("txt_username").innerHTML = "";
  //     document.getElementById(
  //       "btn_authen"
  //     ).innerHTML = `<a class="btn btn-outline-light" href="authen" role="button">Login</a>`;
  //   }
}

function logout() {
  localStorage.clear();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open(
    "GET",
    "https://read.libx.psu.ac.th/backend/authen/logout.php",
    true
  );
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4) {
      if (xmlhttp.status == 200) {
        console.log(xmlhttp.responseText);
      }
    }
  };
  xmlhttp.send(null);
  location.href = "../../";
  // location.reload();
  // fetch(global_url_api+'/test_elibrary/upload/pdf/109/clone/index.php')
  // .then(location.href = global_url_api+'/test_elibrary/frontend/');
}

async function get_environment() {
  // Storing response
  const response = await fetch("../../backend/class/get_envi.php");

  // Storing data in form of JSON
  data = await response.json();
  // console.log(data);
  // console.log(data[0].config_name);
  // console.log(data[0].config_value);
  // console.log(data[1].config_name);
  // console.log(data[1].config_value);

  set_environment(data, global_url_api);
}

function set_environment(data, global_url_api) {
  // console.log(data);
  // sessionStorage.setItem("url_api",data[1].config_value)
  // sessionStorage.setItem("file_url_api",data[2].config_value)
  global_url_api = data[0].config_value;
  // global_file_url_api = data[1].config_value;
  // console.log(global_url_api)
  // console.log(global_file_url_api)
}

get_environment();
