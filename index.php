<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="src/style/style_main.css" rel="stylesheet" type="text/css"/>
        <script src="src/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="src/js/js_login.js" type="text/javascript"></script>
        <?php include_once 'src/Login.php'; ?>
    </head>
    <body>
<div class="login-page">
  <div class="form">
      <form class="login-form" method="POST">
          <label for="userMail">Enter Email</label>
      <input type="text" name="userMail" placeholder="user e-mail"/>
      <label for="passwor">Enter Password</label>
      <input type="password" name="password" placeholder="password"/>
      <button type="submit">login</button>
      <p class="message">Not registered? <a href="Create_account.php">
      Create an account</a></p>
       <p class="message" style="color: red; font-size: 14px">
           <?php CheckUser();?>
       </p>
      </form>
  </div>
</div>
    </body>
</html>
