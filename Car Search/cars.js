let addcarbtn = document.querySelector("#addcar");
let resetbtn = document.querySelector("#reset");

function addCarData() {
  let licenseNumber = document.querySelector("#licenseNumber").value;
  let carMaker = document.querySelector("#carMaker").value;
  let carModel = document.querySelector("#carModel").value;
  let carOwner = document.querySelector("#carOwner").value;
  let carPrice = document.querySelector("#carPrice").value;
  let carColor = document.querySelector("#carColor").value;

  if (
    !licenseNumber ||
    !carMaker ||
    !carModel ||
    !carOwner ||
    !carPrice ||
    !carColor
  ) {
    alert("please fill the all filled. Filled cann't be empty");
  }

  let carTableBody = document.querySelector("#carTableBody");
  let newRow = carTableBody.insertRow(carTableBody.rows.length);

  newRow.insertCell(0).innerHTML = licenseNumber;
  newRow.insertCell(1).innerHTML = carMaker;
  newRow.insertCell(2).innerHTML = carModel;
  newRow.insertCell(3).innerHTML = carOwner;
  newRow.insertCell(4).innerHTML = carPrice;
  newRow.insertCell(5).innerHTML = carColor;
}

function reset() {
  licenseNumber.value = "";
  licenseNumber.placeholder = "Enter Licence Number";
  carMaker.value = "";
  carMaker.placeholder = "Enter Car Maker";
  carModel.value = "";
  carModel.placeholder = "Enter Car Model";
  carOwner.value = "";
  carOwner.placeholder = "Enter Licence carOwner";
  carPrice.value = "";
  carPrice.placeholder = "Enter Car Price";
  carColor.value = "";
  carColor.placeholder = "Enter Car Color";
}
addcarbtn.addEventListener("click", addCarData);
resetbtn.addEventListener("click", reset);

function search() {
  let searchInput = document.querySelector("#searchInput").value.toLowerCase();

  let tableRows = document.querySelectorAll("#carTableBody tr");

  let rowsArray = Array.from(tableRows);

  rowsArray.forEach((row) => {
    let licenseNumber = row.cells[0].textContent.toLowerCase();
    let carMaker = row.cells[1].textContent.toLowerCase();
    let carModel = row.cells[2].textContent.toLowerCase();
    let carOwner = row.cells[3].textContent.toLowerCase();
    let carPrice = row.cells[4].textContent.toLowerCase();
    let carColor = row.cells[5].textContent.toLowerCase();

    if (
      licenseNumber.includes(searchInput) ||
      carMaker.includes(searchInput) ||
      carModel.includes(searchInput) ||
      carOwner.includes(searchInput) ||
      carPrice.includes(searchInput) ||
      carColor.includes(searchInput)
    ) {
      row.style.display = "";
    } else {
      row.style.display = "Search result is not found";
    }
  });
}

document.querySelector("#searchInput").addEventListener("input", search);
document.querySelector("#searchButton").addEventListener("click", search);

// let addcarbtn = document.querySelector("#addcar");
// let resetbtn = document.querySelector("#reset");

// function cardata() {
//   let licenseNumber = document.querySelector("#licenseNumber").value;
//   let carMaker = document.querySelector("#carMaker").value;
//   let carModel = document.querySelector("#carModel").value;
//   let carOwner = document.querySelector("#carOwner").value;
//   let carPrice = document.querySelector("#carPrice").value;
//   let carColor = document.querySelector("#carColor").value;

//   if (!licenseNumber || !carMaker || !carOwner || !carPrice || !carColor) {
//     alert("Please fillup all the field");
//     return;
//   }

//   let tableBody = document.querySelector("#carTableBody");
//   let newRow = tableBody.insertRow(tableBody.rows.length);

//   newRow.insertCell(0).innerHTML = licenseNumber;
//   newRow.insertCell(1).innerHTML = carMaker;
//   newRow.insertCell(2).innerHTML = carModel;
//   newRow.insertCell(3).innerHTML = carOwner;
//   newRow.insertCell(4).innerHTML = carPrice;
//   newRow.insertCell(5).innerHTML = carColor;
// }

// function reset() {
//   licenseNumber.value = " ";
//   carMaker.value = " ";
//   carModel.value = " ";
//   carOwner.value = " ";
//   carPrice.value = " ";
//   carColor.value = " ";
// }

// addcarbtn.addEventListener("click", cardata);
// resetbtn.addEventListener("click", reset);
