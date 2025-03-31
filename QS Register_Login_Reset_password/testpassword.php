<?php
//Template Name: test Page
?>


<head>
  <!-- Add Font Awesome CDN link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<main>
  <div class="container">
    <form>
      <h2>Login</h2>
      <div class="input-group">
        <label for="txtUserName">User Name</label>
        <input type="text" class="form-control" name="txtUserName" />
      </div>
      <div class="input-group">
        <label for="txtPassword">Password</label>
        <input type="password" id="txtPassword" class="form-control" name="txtPassword" />
        <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
      </div>
      <button class="btn btn-lg btn-primary btn-block">Go!</button>
    </form>
  </div>
</main>




<style>
    html, body {
  width: 100%;
  height: 100%;
}
body {
  background: #efefef;
  font: 14px/1 "Roboto", sans-serif;
}
main {
  -ms-flex-align: center;
  align-items: center;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-pack: center;
  height: 100%;
}
.container {
  margin: 0 auto;
}
form {
  background: #fff;
  border-top: 1px solid rgba(0, 0, 0, 0.08);
  border-right: 1px solid rgba(0, 0, 0, 0.1);
  border-bottom: 1px solid rgba(0, 0, 0, 0.12);
  border-left: 1px solid rgba(0, 0, 0, 0.08);
  box-shadow: 0 3rem 5rem -2rem rgba(0, 0, 0, 0.2);
  margin: 0 auto;
  max-width: 380px;
  padding: 15px 35px 45px;
}
h2 {
  color: #666;
  margin-bottom: .75em;
  text-align: center;
}
.input-group {
  margin-bottom: 1.25em;
}
input[type="text"],
input[type="password"] {
  -webkit-appearance: none;
  border-radius: 1px;
  box-sizing: border-box;
  font-size: 1.25em;
  height: auto;
  padding: .5em;

}
/* suppress IE >= 10 native functionality that can show password */
input[type="password"]::-ms-reveal {
  display: none;
}
.btn {
  margin-top: 1.75em;
}
.input-group {
  position: relative;
  width: 100%;
}
.toggle {
  background: none;
  border: none;
  color: #337ab7;
  /*display: none;*/
  /*font-size: .9em;*/
  font-weight: 600;
  /*padding: .5em;*/
  position: absolute;
  right: .75em;
  top: 2.25em;
  z-index: 9;
}





.fa {
  font-size: 2rem;
}
</style>


<script>
    let passwordInput = document.getElementById('txtPassword'),
    toggle = document.getElementById('btnToggle'),
    icon =  document.getElementById('eyeIcon');

function togglePassword() {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    icon.classList.add("fa-eye-slash");
    //toggle.innerHTML = 'hide';
  } else {
    passwordInput.type = 'password';
    icon.classList.remove("fa-eye-slash");
    //toggle.innerHTML = 'show';
  }
}

function checkInput() {
  //if (passwordInput.value === '') {
  //toggle.style.display = 'none';
  //toggle.innerHTML = 'show';
  //  passwordInput.type = 'password';
  //} else {
  //  toggle.style.display = 'block';
  //}
}

toggle.addEventListener('click', togglePassword, false);
passwordInput.addEventListener('keyup', checkInput, false);
</script>