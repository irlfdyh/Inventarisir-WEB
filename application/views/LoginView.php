<html lang="en">
  <head>
        
        <title>Login Inventory App</title>

        <!-- Css -->
        <link rel="stylesheet" href="<?php echo base_url('asset/vendor/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('asset/signin.css'); ?>" />

        <style>
            .form-signin {
              width: 30%;
              margin-left: 35%;
              margin-top: 15%;
            }
        </style>

  </head>

  <body class="text-center">
    <?php echo form_open('LoginController/execute', 'class="form-signin"'); ?>   

    <form class="form-signin">

      <h1 class="h3 mb-3 font-weight-normal">Inventory Apps</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input name = "username" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>

      <label for="inputPassword" class="sr-only">Password</label>
      <input name = "password" type="password" id="inputPassword" class="form-control" placeholder="********" required>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>