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