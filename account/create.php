<?php
  require("../validators/_new_user_validator.php");
  
  $errs = [];

  if(isset($_POST['submit'])){
    $newUserValidation = new NewUser($_POST);
    list( $userData, $errs ) = $newUserValidation->validateCreateForm();

    if(count($errs)==0){
      $_POST = array();
      header("Location: create_success.php");
      exit();
    }
  }
  
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new Account</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <div>
    <div class="errors"><?php echo $errs['firstname'] ?? '' ; ?></div>
    <label>Firstname:</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo $userData['firstname'] ?? '' ?>" placeholder="First Name" required>
  </div>

  <div>
    <div class="errors"><?php echo $errs['lastname'] ?? '' ; ?></div>
    <label>Lastame:</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo ($_POST['lastname']) ?? '' ?>" placeholder="Last Name" required/>
  </div>

  <div>
    <div class="errors"><?php echo $errs['age'] ?? '' ; ?></div>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?php echo ($_POST['age']) ?? '' ?>" placeholder="Age" required/>
  </div>

  <div>
    <div class="errors"><?php echo $errs['username'] ?? '' ; ?></div>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $_POST['username'] ?? '' ?>"  placeholder="Username" required />
  </div>

  <div>
    <div class="errors"><?php echo $errs['email'] ?? '' ; ?></div>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo ($_POST['email']) ?? '' ?>"  placeholder="Email" required/>
  </div>

  <div>
    <div class="errors"><?php echo $errs['password'] ?? '' ; ?></div>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo ($_POST['password']) ?? '' ?>"  placeholder="Password" required/>
  </div>

  <div>
    <div class="errors"><?php echo $errs['confirmPassword'] ?? '' ; ?></div>
    <label for="confirmPassword">Confirm Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" value="<?php echo ($_POST['confirmPassword']) ?? '' ?>"  placeholder="Confirm Password" required/>
  </div>

    <input type="submit" value="create" name="submit">
  </form>
  <a href="login.php">login here</a>
</body>
</html>