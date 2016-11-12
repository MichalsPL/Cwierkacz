<?php
////// panel logowania na stronę 
// z logiki tylko wyświetlanie wiadomośći w przypadku braku wyanganych danych 
print'
<div class="login-page">
  <div class="form">
    <form class="register-form" method="POST">
      <input type="text" name="login" placeholder="name"/>
      <input type="text" name="email" placeholder="email address"/>
      <input type="password" name="password" placeholder="password"/>
     
      
      <button type="submit">create</button>
      <p class="message">Masz konto <a href="#">Zaloguj się</a></p>
      <p class="message">';


 print'</p>
    </form>
      <form class="login-form" method="POST">
          <label for="userMail">Enter Email</label>
      <input type="text" name="userMail" placeholder="user e-mail"/>
      <label for="passwor">Enter Password</label>
      <input type="password" name="password"placeholder="password"/>
      <button type="submit">login</button>
      <p class="message">Not registered? <a href="#">
      Create an account</a></p>
       <p class="message" style="color: red; font-size: 14px">';
include_once 'addUser.php';

if (isset($_POST['userMail']))
    print $error;
if (isset($_POST['login'])){
    print $newError;
}
print'</p>
    </form>
  </div>
</div>
	</body>';


