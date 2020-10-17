
<!DOCTYPE HTML>
<html>
<head>
    <title>Register</title>
    <?php include 'register_proc.php';?>

	<link type="text/css" rel="stylesheet" href="registersty.css">
	<link type="text/css" rel="stylesheet" href="navsty.css">
  <style >
    .error {color: #FF0000;font-size: 20px;text-align: right;}
    .radio{font-size: 20px ;padding: 2px ;margin:2px ;float:left; }
  </style>
</head>

<body>

  	<header>
     <a id="logo" href="index.html">MSG</a>
      <nav>
        <ul>
          <li><a href="login.php">LOGIN</a></li>
          <li><a href="register.php">Register</a></li>
        </ul>
      </nav>
    </header>

    <div class="wrap">
      REGISTER!
      <br><br>


      <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

        <span class="error"> <?php echo $DB_error; ?></span>
        <input type="text" name="Name" placeholder="Name   ex:{joe}"  value="<?php echo $Name; ?>"     />
    		<span class="error"> <?php echo $Name_error; ?></span>


    		<input type="text" name="Email"  placeholder="Email   ex:{joe123@mail.com}" value="<?php echo $Email; ?>"     />
    		<span class="error"> <?php echo $Email_error;?></span>

    		<input type="text" name="Phone" placeholder="Phone"  value="<?php echo $Phone ;?>"     />
    		<span class="error"> <?php echo $Phone_error;?></span>

    		<div class="radio">
      		<input type="radio"  name="Gender"  value="Male" checked="checked" /> Male
      		<br>
      		<input type="radio"  name="Gender"  value="Female" /> Female
    		</div>
        <span class="error"><?php echo $Gender_error;?></span>

        <input type="text" name="Date" placeholder="BirthDate   ex:{yyyy-mm-dd}"  value="<?php echo $Date; ?>"     />
        <span class="error"> <?php echo $Date_error;?></span>



        <input type="text" name="M_Teacher" placeholder="Best school teacher name"  value="<?php echo $M_Teacher; ?>"  id="Bstn"  />
        <span class="error"> <?php echo $M_Teacher_error;?> </span>



    		<input type="password" name="Password"  placeholder="Password"       />
    		<span class="error"> <?php echo $password_error; ?> </span>

        <input type="password" name="Repassword" placeholder="RePassword"       />
        <span class="error"> <?php echo $Repassword_error; ?> </span>

        <button type="submit" data-submit="...Sending">REGISTER</button>

      </form>
    </div>
  </body>
</html>
