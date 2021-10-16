const hotelCard = document.getElementsByClassName("card");

// SCRIPT FOR ADDING STARS TO HOTEL CARDS
const addStars = () => {
  const starsvg = `<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="#e0d900" viewBox="0 0 256 256">
          <rect width="256" height="256" fill="none"></rect>
          <path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z">
          </path>
      </svg>`;
  const starValue = document.getElementsByClassName("star-value");
  for (let i = 0; i <= hotelCard.length; i++) {
    if (starValue[i] != undefined) {
      for (let x = 0; x < parseInt(starValue[i].innerHTML); x++) {
        // console.log(`kartu ke-${i} dan bintang ke-${x}`);
        // console.log(starValue[i].innerHTML);
        document.getElementsByClassName("stars")[i].innerHTML += starsvg;
      }
    }
  }
};

//CHANGE HOTEL PRICE FORMAT
const formatHotelPrice = () => {
  const hotelPrice = document.getElementsByClassName("hotel-price");

  for (const price of hotelPrice) {
    let hotelPriceRaw = price.innerText || price.textContent;
    let hotelPriceFormatted = null;
    if (hotelPriceRaw.length > 6) {
      //console.log(`YEY MASUK`);
      hotelPriceRaw = Array.from(hotelPriceRaw);
      hotelPriceRaw = ["Rp", " ", ...hotelPriceRaw, ",00"];

      hotelPriceRaw.splice(-4, 0, ".");
      hotelPriceRaw.splice(-8, 0, ".");
      console.log(hotelPriceRaw);
       hotelPriceFormatted = hotelPriceRaw.join("");
  } else {
      hotelPriceRaw = Array.from(hotelPriceRaw);
      hotelPriceRaw = ["Rp", " ", ...hotelPriceRaw, ",00"];
      hotelPriceRaw.splice(-4, 0, ".");
       hotelPriceFormatted = hotelPriceRaw.join("");
  }

  /*
    hotelPriceRaw = Array.from(hotelPriceRaw);
    hotelPriceRaw = ["Rp", " ", ...hotelPriceRaw, ",00"];
    hotelPriceRaw.splice(-5, 0, ".");
    const hotelPriceFormatted = hotelPriceRaw.join("");
  */
    //console.log(hotelPriceFormatted);

    price.innerHTML = hotelPriceFormatted;
  }
};

const generalFunctions = () => {
  addStars();
  formatHotelPrice();
};

generalFunctions();


