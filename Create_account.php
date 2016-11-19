<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="src/style/style_main.css" rel="stylesheet" type="text/css"/>
        <script src="src/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <?php include_once 'src/AddUser.php'; ?>
    </head>
    <body>
<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST">
      <input type="text" name="login" placeholder="name"/>
      <input type="text" name="email" placeholder="email address"/>
      <input type="password" name="password" placeholder="password"/>
     
      
      <button type="submit">create</button>
      <p class="message">Masz konto <a href="index.php">Zaloguj się</a></p>
      <p class="message" style="color: red; font-size: 14px">
           <?php addUser();?>
       </p>
      </form>
  </div>
</div>
    </body>
</html>
