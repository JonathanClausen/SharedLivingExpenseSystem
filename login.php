
<?php include 'assets/header.php'; ?>
<link href="css/signin.css" rel="stylesheet">
<main class="form-signin">
  <form action="authenticate.php" method="post" >
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" name="username" class="form-control" id="username" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" value="Login" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
</main>


<?php include 'assets/footer.php'; ?>