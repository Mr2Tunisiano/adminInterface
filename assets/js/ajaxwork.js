let success = document.getElementById('right');
let fail = document.getElementById('wrong');
//login validation
function login(event) {
  event.preventDefault();
  let username = document.getElementById('yourUsername').value;
  let password = document.getElementById('yourPassword').value;

  let request = new XMLHttpRequest()
  request.onreadystatechange = function() {
    if (this.status === 200 && this.readyState === 4) {
      let response = JSON.parse(this.responseText);
      if (response.success == "yes" && response.isAdmin == "yes") {
        success.style.display = "";
        setTimeout(() => {
          location.href = 'http://localhost/adminInterface/admin_index.php'
        }, 1500);
      } else if (response.success == "yes" && response.isAdmin == "no") {
        success.style.display = "";
        setTimeout(() => {
          location.href = 'http://localhost/adminInterface/cashier_index.php'
        }, 1500);
      } else {
        fail.style.display = "";
        username = ""
        password = ""
      }
    }
  }
  request.open("Post", `assets/php/verif.php`, true);
  request.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
  request.send(`username=${username}&password=${password}`);
}


let scroll = document.getElementById("scrolls")
let qte = 1
function addToCart(event) {
event.preventDefault();
let id = event.target.getAttribute("id-prod")
let req2 = new XMLHttpRequest()
req2.onreadystatechange = function() {
  if(this.status === 200 && this.readyState === 4) {
    let response2 = JSON.parse(this.responseText);

// create the outermost container
let row = document.createElement("div");
row.classList.add("row", "pt-2","dynamic-div");
row.setAttribute("prod-id",response2.id);
// create the first column for the product name
let nomProdCol = document.createElement("div");
nomProdCol.classList.add("col-lg-5");
nomProdCol.textContent = response2.nom;
row.appendChild(nomProdCol);
// create the second column for the total price
let totalPriceHolder = document.createElement("div");
totalPriceHolder.classList.add("col-lg-2");
let totalPriceCol = document.createElement("div");
totalPriceCol.textContent = response2.prix;
totalPriceCol.setAttribute("total_id",response2.id)
totalPriceCol.setAttribute("total",response2.prix)
totalPriceCol.style.display = 'inline-block'
let dt = document.createElement('b')
dt.innerText = "Dt."
dt.style.display = 'inline-block'
totalPriceHolder.appendChild(totalPriceCol)
totalPriceHolder.appendChild(dt)
row.appendChild(totalPriceHolder);
// create the third column for the quantity selector
let quantityCol = document.createElement("div");
quantityCol.classList.add("col-lg-3");
// create the button group
let btnGroup = document.createElement("div");
btnGroup.classList.add("btn-group");
btnGroup.setAttribute("role", "group");
btnGroup.setAttribute("aria-label", "Basic mixed styles example");
btnGroup.style.height = "30px";
// create the decrease button
let decreaseBtn = document.createElement("button");
decreaseBtn.classList.add("btn", "btn-danger");
decreaseBtn.textContent = "-";
decreaseBtn.onclick = () => {
  let sum = document.querySelector(`[qte_id="${response2.id}"]`)
  if (parseInt(sum.innerText) > 1) {
    sum.innerText = parseInt(sum.innerText)-1
    let updateQte = sum.innerText
    row.setAttribute("qte",updateQte)
  }
  totalPriceCol.textContent = parseInt(sum.innerText)*response2.prix
  let updateTotal = totalPriceCol.textContent
  totalPriceCol.setAttribute('total',updateTotal)
  let finalTotalFetch = document.querySelectorAll('[total]')
let totalShow = document.getElementById('total')
let allprices = 0
for (let i = 0; i < finalTotalFetch.length; i++) {
  allprices += parseInt(finalTotalFetch[i].innerText) 
}
totalShow.innerText = allprices
}
btnGroup.appendChild(decreaseBtn);
// create the quantity button
let quantityBtn = document.createElement("button");
quantityBtn.classList.add("btn");
quantityBtn.setAttribute("qte_id",response2.id)
quantityBtn.textContent = parseInt(1);
btnGroup.appendChild(quantityBtn);
// create the increase button
let increaseBtn = document.createElement("button");
increaseBtn.classList.add("btn", "btn-success");
increaseBtn.onclick = () => {
  let sum = document.querySelector(`[qte_id="${response2.id}"]`)
  sum.innerText = parseInt(sum.innerText)+1 
  totalPriceCol.textContent = parseInt(sum.innerText)*response2.prix
  let updateTotal = totalPriceCol.textContent
  totalPriceCol.setAttribute('total',updateTotal)
  let updateQte = sum.innerText
  row.setAttribute("qte",updateQte)
  let finalTotalFetch = document.querySelectorAll('[total]')
let totalShow = document.getElementById('total')
let allprices = 0
for (let i = 0; i < finalTotalFetch.length; i++) {
  allprices += parseInt(finalTotalFetch[i].innerText) 
}
totalShow.innerText = allprices
}
increaseBtn.textContent = "+";
btnGroup.appendChild(increaseBtn);
// append the button group to the quantity column
quantityCol.appendChild(btnGroup);
row.appendChild(quantityCol);
// create the fourth column for the delete icon
let deleteCol = document.createElement("div");
deleteCol.classList.add("col-lg-1");
// create the delete icon
let deleteIcon = document.createElement("i");
deleteIcon.classList.add("ri-delete-bin-2-fill");
deleteIcon.setAttribute('id_prod',response2.id)
deleteIcon.style.cursor = "pointer";
deleteIcon.style.color = "red";
deleteIcon.style.fontSize = "x-large";
deleteIcon.style.marginLeft = "10px"
deleteCol.appendChild(deleteIcon);
// append the delete column to the row
row.appendChild(deleteCol);

//The check if product already exists in bail or not
let mydiv = document.querySelector(`.dynamic-div[prod-id='${response2.id}']`)
if (mydiv) {
  let totalLine = document.querySelector(`[total_id="${response2.id}"]`)
  let sum = document.querySelector(`[qte_id="${response2.id}"]`)
  sum.innerText = parseInt(sum.innerText)+1
  let updateQte = sum.innerText
  mydiv.setAttribute("qte",updateQte)
  totalLine.innerText = updateQte*response2.prix
  let updateTotal = totalLine.innerText
  totalLine.setAttribute("total",updateTotal)
} else {
  scroll.appendChild(row);
  let sum = document.querySelector(`[qte_id="${response2.id}"]`)
  let updateQte = sum.innerText
  row.setAttribute("qte",updateQte)
}
let finalTotalFetch = document.querySelectorAll('[total]')
let totalShow = document.getElementById('total')
let allprices = 0
for (let i = 0; i < finalTotalFetch.length; i++) {
  allprices += parseInt(finalTotalFetch[i].innerText) 
}
totalShow.innerText = allprices
//Delete button work
let deleteThis = document.querySelector(`[id_prod="${response2.id}"]`)
deleteThis.onclick = () => {
deleteThis.parentElement.parentElement.remove()
}
  }
}
  req2.open("GET", `assets/php/addticket.php?id=${id}`, true);
  req2.send();
}

function Commander(event) {
  event.preventDefault()
  let dynamicDiv = document.querySelectorAll('.dynamic-div')
  let myObj = []
  for (let i = 0; i < dynamicDiv.length; i++) {
    let id = dynamicDiv[i].getAttribute("prod-id")
    let qte = dynamicDiv[i].getAttribute("qte")
    myObj[i] = {
      id_p : id,
      qte_p : qte
    }
  }
  let SendObj = JSON.stringify(myObj)
  let paid = 0
  let user = document.getElementById('user').innerText
  let count = document.getElementById('count').innerText
  let total = document.getElementById('total').innerText

  if (SendObj != '[]') {
  console.log(SendObj)
  console.log(paid)
  console.log(user)
  console.log(count)
  console.log(total)
  let req3 = new XMLHttpRequest()
  req3.onreadystatechange = () => {
    if(this.status === 200 && this.readyState === 4) {
      
    }
  }
  req3.open("GET", `assets/php/commander.php?prods=${SendObj}&paid=${paid}&user=${user}&count=${count}&total=${total}`, true);
  req3.send();
  }
}