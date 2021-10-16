//const hotelCard = document.getElementsByClassName("card");
const filterLocation = document.getElementById("filter-location");
const filterPrice = document.getElementById("filter-price");
const ratingCheckboxes = document.querySelectorAll("input[type='checkbox']");

//LOCATION FILTERING and PRICE FILTERING
filterLocation.addEventListener("input", (eventLocation) => {
  const hotelLocation = document.getElementsByClassName("hotel-location");
  const hotelPrice = document.getElementsByClassName("hotel-price");
  let inputLocation = eventLocation.target.value.toLowerCase();

  for (let i = 0; i < hotelLocation.length; i++) {
    let location =
      hotelLocation[i].innerText.toLowerCase() ||
      hotelLocation[i].textContent.toLowerCase();

    if (location.includes(inputLocation)) {
      hotelCard[i].style.display = "";
    } else {
      hotelCard[i].style.display = "none";
    }
  }

  filterPrice.addEventListener("input", (eventPrice) => {
    for (let i = 0; i < hotelLocation.length; i++) {
      let location =
        hotelLocation[i].innerText.toLowerCase() ||
        hotelLocation[i].textContent.toLowerCase();

      let hotelPriceText = hotelPrice[i].textContent || hotelPrice[i].innerText;

      let hotelPriceTextStripped = hotelPriceText.split(" ");
      hotelPriceTextStripped = hotelPriceTextStripped.splice(-1, 1).toString();
      hotelPriceTextStripped = hotelPriceTextStripped.split(".");
      hotelPriceTextStripped = hotelPriceTextStripped.join("").toString();
      hotelPriceTextStripped = hotelPriceTextStripped.split(",");
      hotelPriceTextStripped = hotelPriceTextStripped.splice(0, 1).toString();
      let hotelPriceInteger = parseInt(hotelPriceTextStripped);

      let inputPrice = eventPrice.target.value;
      if (inputPrice.length >= 6) {
        if (hotelPriceInteger <= parseInt(inputPrice)) {
          if (location.includes(inputLocation)) {
            hotelCard[i].style.display = "";
          } else {
            hotelCard[i].style.display = "none";
          }
        } else {
          hotelCard[i].style.display = "none";
        }
      } else if (inputPrice.length < 6) {
        if (!location.includes(inputLocation)) {
          hotelCard[i].style.display = "none";
        } else {
          hotelCard[i].style.display = "";
        }
      }

      // ratingCheckboxes.forEach((box) => {
      //   box.addEventListener("change", () => {
      //     const hotelRating = document.getElementsByClassName("stars");

      //     let checkboxValues = [];

      //     checkboxValues = Array.from(ratingCheckboxes)
      //       .filter((item) => item.checked)
      //       .map((item) => item.value);

      //     for (let i = 0; i < hotelRating.length; i++) {
      //       if (hotelCard[i].style.display === "") {
      //         if (
      //           checkboxValues.includes(
      //             document
      //               .getElementsByClassName("stars")
      //               [i].children.length.toString()
      //           ) === true
      //         ) {
      //           //console.log(`true bintang 5`);
      //           hotelCard[i].style.display = "";
      //         } else if (
      //           checkboxValues.includes(
      //             document
      //               .getElementsByClassName("stars")
      //               [i].children.length.toString()
      //           ) === false
      //         ) {
      //           //console.log(`false bintang 5`);
      //           hotelCard[i].style.display = "none";
      //         }
      //         if (checkboxValues.length === 0) {
      //           console.log(`${checkboxValues.length} = 0`);

      //           hotelCard[i].style.display = "";
      //         }
      //       }
      //     }
      //   });
      // });
    }
  });

  ratingCheckboxes.forEach((box) => {
    box.addEventListener("change", () => {
      const hotelRating = document.getElementsByClassName("stars");

      let checkboxValues = [];

      checkboxValues = Array.from(ratingCheckboxes)
        .filter((item) => item.checked)
        .map((item) => item.value);

      for (let i = 0; i < hotelRating.length; i++) {
        let location =
          hotelLocation[i].innerText.toLowerCase() ||
          hotelLocation[i].textContent.toLowerCase();

        if (hotelCard[i].style.display === "") {
          if (
            checkboxValues.includes(
              document
                .getElementsByClassName("stars")
                [i].children.length.toString()
            ) === true
          ) {
            if (location.includes(inputLocation)) {
              hotelCard[i].style.display = "";
            } else {
              hotelCard[i].style.display = "none";
            }
          } else if (
            checkboxValues.includes(
              document
                .getElementsByClassName("stars")
                [i].children.length.toString()
            ) === false
          ) {
            hotelCard[i].style.display = "none";
          }
          if (checkboxValues.length === 0) {
            if (hotelCard[i].style.display === "none") {
              if (location.includes(inputLocation)) {
                hotelCard[i].style.display = "";
              } else {
                hotelCard[i].style.display = "none";
              }
            }
          }
        }
      }
    });
  });
});

//PRICE FILTERING
if (filterLocation.value === "") {
  document.getElementById("filter-price").addEventListener("input", (event) => {
    const hotelPrice = document.getElementsByClassName("hotel-price");

    for (let i = 0; i < hotelPrice.length; i++) {
      let hotelPriceText = hotelPrice[i].textContent;

      let hotelPriceTextStripped = hotelPriceText.split(" ");
      hotelPriceTextStripped = hotelPriceTextStripped.splice(-1, 1).toString();

      hotelPriceTextStripped = hotelPriceTextStripped.split(".");
      hotelPriceTextStripped = hotelPriceTextStripped.join("").toString();
      hotelPriceTextStripped = hotelPriceTextStripped.split(",");
      hotelPriceTextStripped = hotelPriceTextStripped.splice(0, 1).toString();

      let hotelPriceInteger = parseInt(hotelPriceTextStripped);
      // console.log(hotelPriceTextStripped);
      let inputPrice = event.target.value;

      if (inputPrice.length >= 6) {
        if (hotelPriceInteger <= parseInt(inputPrice)) {
          hotelCard[i].style.display = "";
        } else {
          hotelCard[i].style.display = "none";
        }
      } else {
        hotelCard[i].style.display = "";
      }

      // ratingCheckboxes.forEach((box) => {
      //   box.addEventListener("change", () => {
      //     const hotelRating = document.getElementsByClassName("stars");

      //     let checkboxValues = [];

      //     checkboxValues = Array.from(ratingCheckboxes)
      //       .filter((item) => item.checked)
      //       .map((item) => item.value);

      //     for (let i = 0; i < hotelRating.length; i++) {
      //       if (hotelCard[i].style.display === "") {
      //         //console.log(`masuk if pertama ${hotelCard[i]}`);
      //         if (
      //           checkboxValues.includes(
      //             document
      //               .getElementsByClassName("stars")
      //               [i].children.length.toString()
      //           ) === true
      //         ) {
      //           //console.log(`masuk if kedua ${hotelCard[i]}`);

      //           //console.log(`masuk if ketiga ${hotelCard[i]}`);

      //           hotelCard[i].style.display = "";
      //         } else if (checkboxValues.length === 0) {
      //           // if (hotelCard[i].style.display === "none") {
      //           //   console.log(`${checkboxValues.length} panjangnya`);
      //           //   //hotelCard[i].style.display = "";
      //           //   if (hotelPriceInteger <= parseInt(inputPrice)) {
      //           //     console.log(`masuk hotelprice lebih kecil`);
      //           //     hotelCard[i].style.display = "";
      //           //   } else {
      //           //     console.log(`masuk hotelprice lebih besar`);
      //           //     hotelCard[i].style.display = "none";
      //           //   }
      //           // } else if (hotelCard[i].style.display === "") {
      //           //   console.log(`masuk style ""`);

      //           // }
      //           hotelCard[i].style.display = "";
      //         } else if (
      //           checkboxValues.includes(
      //             document
      //               .getElementsByClassName("stars")
      //               [i].children.length.toString()
      //           ) === false
      //         ) {
      //           hotelCard[i].style.display = "none";
      //         }
      //       }
      //     }
      //   });
      // });
    }
  });
}

//CHECKBOX RATING FILTER langsung semuanya di select

ratingCheckboxes.forEach((box) => {
  box.addEventListener("change", () => {
    const hotelRating = document.getElementsByClassName("stars");

    let checkboxValues = [];

    checkboxValues = Array.from(ratingCheckboxes)
      .filter((item) => item.checked)
      .map((item) => item.value);

    for (let i = 0; i < hotelRating.length; i++) {
      if (filterPrice.value.length == 0 && filterLocation.value.length == 0) {
        if (
          checkboxValues.includes(
            document
              .getElementsByClassName("stars")
              [i].children.length.toString()
          ) === true
        ) {
          hotelCard[i].style.display = "";
        } else if (checkboxValues.length === 0) {
          //console.log(`SALAH MASUK`);
          hotelCard[i].style.display = "";
        } else if (
          checkboxValues.includes(
            document
              .getElementsByClassName("stars")
              [i].children.length.toString()
          ) === false
        ) {
          hotelCard[i].style.display = "none";
        }
      }
    }
  });
});

//NO RESULT SCRIPT
const resultCheck = () => {
  let hotelCardDisplayed = [];
  let hotelCardHidden = [];

  for (let i = 0; i <= hotelCard.length; i++) {
    if (hotelCard[i] !== undefined) {
      if (hotelCard[i].style.display === "none") {
        hotelCardHidden.push("none");
      } else if (hotelCard[i].style.display === "") {
        hotelCardDisplayed.push("shown");
      }
    }
    //console.log(hotelCardHidden);
    //console.log(hotelCardDisplayed);
  }

  if (hotelCardHidden.length === hotelCard.length) {
    // console.log(`${hotelCardHidden.length} === ${hotelCard.length}`);
    document.getElementById("no-result-card").style.display = "";
    // document.getElementById("filterContainer").style.marginRight = "330px";
    console.log(hotelCardHidden);
    console.log(hotelCardDisplayed);
  } else if (hotelCardHidden.length !== hotelCard.length) {
    document.getElementById("no-result-card").style.display = "none";
  }
};

const homeFunctions = () => {
  // filterLocation.addEventListener("input", () => {
  //   resultCheck();
  // });
  // filterPrice.addEventListener("input", () => {
  //   resultCheck();
  // });
  // ratingCheckboxes.forEach((box) => {
  //   box.addEventListener("change", () => {
  //     resultCheck();
  //   });
  // });
};

window.onloadeddata = homeFunctions();
