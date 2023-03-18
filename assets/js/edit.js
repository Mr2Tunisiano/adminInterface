let div1 = document.createElement('div')
div1.className = "card"

let div2 = document.createElement('div')
div2.className = "card-body"
div1.appendChild(div2)
let h5 = document.createElement('h5')
h5.className = "card-title"
div2.appendChild(h5)
let btn = document.createElement('button')
btn.type = 'button'
btn.className = "btn btn-primary"
btn.setAttribute('data-bs-toggle','modal')
btn.setAttribute('data-bs-target','#verticalycentered')
btn.innerHTML = "Vertically centered"
div2.appendChild(btn)

let div3 = document.createElement('div')
div3.className = 'modal fade'
div3.id = 'verticalycentered'
div3.setAttribute('tabindex','-1')
div2.appendChild(div3)

let div4 = document.createElement('div')
div4.className = "modal-dialog modal-dialog-centered"
div3.appendChild(div4)

let div5 = document.createElement('div')
div5.className = "modal-content"
div4.appendChild(div5)

let div6 = document.createElement('div')
div6.className = "modal-header"
div5.appendChild(div6)

let h6 = document.createElement('h5')
h6.className = "modal-title";
h6.innerHTML = "Vertically Centered"
div6.appendChild(h6)

let btn2 = document.createElement('button')
btn2.type = "button"
btn2.className = "btn-close"
btn2.setAttribute('data-bs-dismiss','modal')
btn2.setAttribute('aria-label','Close')
div6.appendChild(btn2)

let div7 = document.createElement('div')
div7.className = 'modal-body'
div7.innerHTML = "Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos."
div5.appendChild(div7)

let div8= document.createElement('div')
div8.className = 'modal-footer'

let btn3 = document.createElement('button')
btn3.type = "button"
btn3.className = "btn btn-secondary"
btn3.setAttribute('data-bs-dismiss','modal')
btn3.innerHTML = "Close"
div8.appendChild(btn3)

let btn4 = document.createElement('button')
btn4.type = "button"
btn4.className = "btn btn-primary"
btn4.innerHTML = "Save Changes"
div8.appendChild(btn4)
div5.appendChild(div8)