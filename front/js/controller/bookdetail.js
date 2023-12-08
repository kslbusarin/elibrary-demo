sessionStorage.setItem("url_api", "http://172.22.75.70");

// api url get global_variable from environment.js
// console.log(window.location.search)
// console.log(window.location.search.replace(/[?]/g, ""));
sessionStorage.setItem("bookid", window.location.search.replace(/[?]/g, ""));
// const api_url = global_url_api+"/test_elibrary/backend/book/bookdetail.php"+window.location.search.replace(/[?]/g, "");
const api_book_detail_url =
  sessionStorage.getItem("url_api") +
  "/backend/book/bookdetail.php?id=" +
  window.location.search.replace(/[?]/g, "");
const api_book_tag_url =
  sessionStorage.getItem("url_api") +
  "/backend/book/booktag.php?bookid=" +
  window.location.search.replace(/[?]/g, "");
// console.log(api_url)
let data = "";
let borrowdaylimit = 0;
let share_url = "";
// Defining async function
async function getapi(url) {
  // Storing response
  const response = await fetch(url);

  // Storing data in form of JSON
  data = await response.json();
  // console.log(data);
  // console.log(data[0].title)

  show(data);
}

// Defining async function
async function getapi_tag(url) {
  // Storing response
  console.log(url);
  const response = await fetch(url);

  data = await response.json();
  console.log(data.length);

  show_tag(data);
}

// check_session();
// Calling that async function
callInternal();

// Function to hide the loader

// Function to define innerHTML for HTML table
function show(data) {
  // check_authen();
  // check_session();
  checkBorrow();
  document.title = data[0].title;
  document.getElementById("book_title").innerHTML = data[0].title;
  document.getElementById("author").innerHTML = data[0].authorname;
  // document.getElementById("coverfileurl").src = `../../upload/pdf/${ data[0].bookid}/${ data[0].bookid}.png`;
  // document.getElementById("coverfileurl").src = global_url_api+`/demo5/pdf/${ data[0].bookid}/${ data[0].bookid}.png`
  document.getElementById("coverfileurl").src = data[0].coverfileurl;
  document.getElementById("publisher").innerHTML = data[0].publishername;
  document.getElementById("year").innerHTML = data[0].year;
  document.getElementById("categories").innerHTML = data[0].categoryname;
  document.getElementById("year").innerHTML = data[0].year;
  document.getElementById("status").innerHTML =
    "ยืมได้ " + data[0].amountleft + "/" + data[0].amount + " เล่ม";
  document.getElementById("viewcount").innerHTML =
    "จำนวนการดู " + data[0].bookviewcount + " ครั้ง";
  document.getElementById("borrowcount").innerHTML =
    "สถิติการยืม " + data[0].count + " ครั้ง";
  document.getElementById("description").innerHTML = data[0].description;

  share_url =
    sessionStorage.getItem("url_api") +
    "/front/book/bookdetail.php" +
    window.location.search;
  $("#qrcode").qrcode(share_url);
  document.getElementById("share_url").innerText = share_url;
  // new QRCode(document.getElementById("qrcode"), api_url);
  // document.getElementById("prem_read").innerHTML = getData();
  // document.getElementById("btn_return").innerHTML = checkbtnReturn();
}

function show_tag(data) {
  var txt_tag = "";
  for (i = 0; i < data.length; i++) {
    txt_tag +=
      "<button type='button' class='btn btn-outline-secondary p-1 m-1'>" +
      data[i].tagname +
      "</button>";
  }
  document.getElementById("book_tag").innerHTML = txt_tag;
}

function sub_title(txt_title) {
  let result = "";

  if (txt_title) {
    if (txt_title.length > 28) {
      result = txt_title.substring(0, 28) + "...";
    } else {
      result = txt_title;
    }
  }
  return result;
}

function createBorrow(bookid) {
  console.log("borrow");
  // console.log("data", data[0]);
  // console.log("userid", localStorage.getItem("userid"));
  var formData = new FormData();
  formData.append("bookid", bookid);
  formData.append("userid", localStorage.getItem("userid"));

  var url = sessionStorage.getItem("url_api") + "/backend/book/bookborrow.php";
  //   formData.append('x', 'hello');

  fetch(url, { method: "POST", body: formData })
    .then(function (response) {
      console.log(response);
      return response.json();
    })
    .then(function (body) {
      // console.log("state", body[0]);
      if (body[0].state == true) {
        location.reload();
      } else if (body[0].state == false) {
        if (body[1].state_borrow == "limitquota") {
          alert(
            "ไม่สามารถยืมได้ในขณะนี้ เนื่องจากท่านยืมหนังสือครบจำนวนที่กำหนด"
          );
          location.reload();
        }
        if (body[1].state_borrow == "emptybook") {
          alert("ไม่สามารถยืมได้ในขณะนี้ จำนวนหนังสือถูกยืมครบแล้ว");
          location.reload();
        }
      }
    });
}

function createReturn(bookid) {
  // console.log("return");
  // console.log(data[0].bookid);
  var formData = new FormData();
  formData.append("bookid", bookid);
  formData.append("userid", localStorage.getItem("userid"));
  formData.append("uid", localStorage.getItem("uid"));

  var url = sessionStorage.getItem("url_api") + "/backend/book/bookreturn.php";

  fetch(url, { method: "POST", body: formData })
    .then(function (response) {
      console.log(response);
      return response.json();
    })
    .then(function (body) {
      console.log(body);
      location.reload();
    });
}

async function checkBorrow() {
  let isreturn = false;
  var bind_btn = "";
  const response_return = await fetch(
    sessionStorage.getItem("url_api") +
      "/backend/book/checkborrow.php?" +
      data[0].bookid +
      "&" +
      localStorage.getItem("userid")
  );
  // console.log(response_return);
  const data_return = await response_return.json();
  // console.log(data_return["isreturn"]);
  borrowdaylimit = data_return["borrowdaylimit"];
  isreturn = data_return["isreturn"];
  // console.log(isreturn);
  if (isreturn === "t" || isreturn == null) {
    bind_btn =
      " <button class='btn btn-success btn-md' onclick='createBorrow(" +
      sessionStorage.getItem("bookid") +
      ")'>ยืม</button>";
  } else if (isreturn === "f") {
    bind_btn =
      "" +
      // + "<button class='btn btn-primary btn-md'  onclick='gotoRead("+sessionStorage.getItem("bookid")+")'>อ่าน</button>"
      " <button class='btn btn-primary btn-md'  onclick='gotoRead_V2(" +
      sessionStorage.getItem("bookid") +
      ")'>อ่าน</button>" +
      " <button class='btn btn-danger btn-md'  onclick='createReturn(" +
      sessionStorage.getItem("bookid") +
      ")'>คืน</button>";
  }
  // console.log(typeof bind_btn);
  document.getElementById("prem_read").innerHTML = bind_btn;
}

function checkbtnReturn() {
  var btn_return =
    " <button class='btn btn-danger btn-md'  onclick='createReturn()'>คืน</button>";
  return btn_return;
}

function gotoRead(bookid) {
  window.location.replace(
    sessionStorage.getItem("file_url_api") +
      `pdf/${bookid}/load.php?uid=${localStorage.getItem("uid")}&bookid=${
        data[0].bookid
      }&fullname_en=${localStorage.getItem(
        "fullname_en"
      )}&borrowdaylimit= ${borrowdaylimit}`
  ); // Test with bookid
  // window.location.replace(global_file_url_api+`pdf/${ data[0].bookid }/load.php?uid=${ localStorage.getItem("uid") }&bookid=${  data[0].bookid }&fullname_en=${ localStorage.getItem("fullname_en") }&borrowdaylimit= ${borrowdaylimit}`); // Test with bookid
}

// Show loading popup
function showLoadingPopup() {
  Swal.fire({
    title: "Wait!",
    html: "โปรดรอ สักครู่",
    width: "80%",
    didOpen: () => {
      Swal.showLoading();
    },
  }).then((result) => {});
}

// Hide loading popup
function hideLoadingPopup() {
  Swal.close();
}

async function gotoRead_V2(bookid) {
  // Show loading popup
  showLoadingPopup();
  // console.log(sessionStorage.getItem("file_url_api"));
  // console.log({bookid});
  // console.log(localStorage.getItem("uid"));
  // console.log(data[0].bookid);
  // console.log(localStorage.getItem("fullname_en"));
  // console.log(borrowdaylimit);
  var formdata = new FormData();
  formdata.append("uid", localStorage.getItem("uid"));
  formdata.append("bookid", data[0].bookid);

  var requestOptions = {
    method: "POST",
    body: formdata,
    redirect: "follow",
  };

  fetch("../../../file_preview/generate_file.php", requestOptions)
    // .then(async (response) => {
    //   await response.json();
    // })
    .then(async (result) => {
      const res = await result.json();
      // var parsedResult = JSON.parse(result);
      // console.log("res", res);
      hideLoadingPopup();
      // Check the response from PHP
      if (res.status === "success") {
        // Display success alert

        window.location.replace(
          `../../../reader/immersion-mode.html?bookid=${
            data[0].bookid
          }&uid=${localStorage.getItem("uid")}&npage=${res.page_count}`
        );
      } else {
        // Display error alert or handle the error case
        console.log("Cannot generate eBook");
        location.reload();
      }
    });
}

function gotoReadWatermark() {
  // Function test
  // alert(sessionStorage.getItem("userid"));
  window.location.replace(
    sessionStorage.getItem("url_api") +
      `newelibrary/demo3/load.php?id=${localStorage.getItem("uid")}`
  );
}

function copyToClipboard(element) {
  document.getElementById("txt_copy").innerText = "copied";
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  setTimeout(function () {
    document.getElementById("txt_copy").innerText = "";
  }, 3000);
}

async function callInternal() {
  // alert("sdfgsg")
  // let isreturn = false;
  // var bind_btn = "";
  const response_return = await fetch(
    sessionStorage.getItem("url_api") + "/backend/class/call_internal.php"
  );
  // console.log(response_return);
  const data_return = await response_return.json();
  // console.log(data_return["result"]);
  if (data_return["result"] == true) {
    getapi(api_book_detail_url);
    getapi_tag(api_book_tag_url);
  } else {
    $(function () {
      $("body").empty();
      Swal.fire({
        html:
          "<h5>ท่านอยู่นอกเครือข่ายมหาวิทยาลัยสงขลานครินทร์ ทำให้ไม่สามารถเข้าใช้งานระบบ PSU eLibrary ได้ <br>กรุณาใช้เครือข่ายอินเทอร์เน็ตของมหาวิทยาลัยสงขลานครินทร์ (PSU VPN) </h5>" +
          '<p align="left" style="font-size: 0.875em; text-indent: 2%; padding-left:5%; padding-right:5%;"> </p>',
        icon: "info",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "ตกลง",
        width: "70%",
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          location.href = "../../";
          // show(body);
        }
        // else if (result.isDenied) {
        //     Swal.fire('Changes are not saved', '', 'info')
        // }
      });
    });
  }
}
