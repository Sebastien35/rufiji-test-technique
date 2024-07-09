// let Array = [];
// const populateArrayBtn = document.querySelector("#populateArray");
// populateArrayBtn.addEventListener("click", populateArray);
// function populateArray() {
//     Array = [];
//   for (let i = 0; i < 20; i++) {
//     Array.push(Math.floor(Math.random() * 100));
//   }
//   let displayArray = document.querySelector("#displayArray");  
//     displayArray.innerHTML = Array; 
//   return Array;
// }

// let TrierBtn = document.querySelector("#Trier");
// TrierBtn.addEventListener("click", Trier);
// async function Trier(){
//     let url = "http://localhost/exercice/sort-array";
//     let myHeaders = new Headers();
//     myHeaders.append("Content-Type", "application/json");
//     let body = JSON.stringify(Array);
//     let requestOptions = {
//         method: "POST",
//         headers: myHeaders,
//         body: body,
//         redirect: "follow",
//     };
//     let response = await fetch(url, requestOptions);
//     if(response.ok){
//         let data = await response.json();
//         let DisplayResult = document.querySelector("#displayResult");
//         DisplayResult.innerText= data;
//     }

    
// }
