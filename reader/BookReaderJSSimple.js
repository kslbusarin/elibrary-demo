//
// This file shows the minimum you need to provide to BookReader to display a book
//
// Copyright(c)2008-2009 Internet Archive. Software license AGPL version 3.

// alert("Check Reader")

document.addEventListener("contextmenu", function (event) {
  event.preventDefault(); // Prevent the default context menu behavior
});

// Create the BookReader object
function instantiateBookReader(uid, bookid, npage, selector, extraOptions) {
  selector = selector || "#BookReader";
  extraOptions = extraOptions || {};
  const num_pages = [];

  for (let i = 1; i <= npage; i++) {
    const pageNumber = i.toString().padStart(3, "0");
    const uri = `../file_preview/files/${bookid}/${uid}/page-${pageNumber}.jpg`;
    num_pages.push([{ width: 600, height: 900, uri }]);
  }
  var options = {
    ppi: 100,
    data: num_pages,

    // Book title and the URL used for the book title link
    bookTitle: "BookReader CLIB PSU",
    bookUrl: "../front/home/",
    bookUrlText: "Back to Home",
    bookUrlTitle: "CLIB PSU",

    // thumbnail is optional, but it is used in the info dialog
    thumbnail: `../file_preview/files/${bookid}/${uid}/page-001.jpg`,
    // Metadata is optional, but it is used in the info dialog
    metadata: [
      { label: "Title", value: "Open Library BookReader Presentation" },
      { label: "Author", value: "Internet Archive" },
      {
        label: "Demo Info",
        value:
          "This demo shows how one could use BookReader with their own content.",
      },
    ],

    // Override the path used to find UI images
    imagesBaseURL: `../file_preview/files/${bookid}/${uid}/page-001.jpg`,

    ui: "full", // embed, full (responsive)

    el: selector,
  };

  $.extend(options, extraOptions);
  var br = new BookReader(options);
  br.init();
}

function checkSession(uid, bookid, npage) {
  // fetch("../backend/authen/check_session.php")
  //   .then((response) => response.json())
  //   .then((data) => {
  //     const status = data.status;
  //     if (status === 200) {
  //       // Session is active
  //       console.log("Session is active");

  // Call another function or perform additional actions

  instantiateBookReader(uid, bookid, npage, "#BookReader", {
    startFullscreen: true,
  });
  //   } else if (status === 401) {
  //     // Session is not active
  //     window.location.href = "../../";
  //     console.log("Session is not active");
  //     // Retry the check after a certain delay
  //     setTimeout(checkSession, 1000); // Retry after 1 second (adjust the delay as needed)
  //   } else {
  //     // Handle other status codes or errors
  //     console.error("Error checking session");
  //   }
  // })
  // .catch((error) => {
  //   console.error("Error checking session", error);
  // });
}
