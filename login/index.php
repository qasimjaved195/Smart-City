<?php
ob_start();
session_start();
require '../conn.php';
if (isset($_SESSION['user_role'])) {
	$roleName = $_SESSION['sroleName'] ;
	$userRole = $_SESSION['user_role'];
	header("Location: ../view/$roleName.php?mid=$userRole");
}
?>
<!DOCTYPE html>
<html>
<!-- Head -->
<head>
    <title>Log In</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <!-- //fonts -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
    <!-- //Font-Awesome-File-Links -->
	
	<!-- Google fonts -->
	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
	<!-- Google fonts -->

</head>
<!-- //Head -->
<!-- Body -->

<body>

<section class="main">
	<div class="layer">
	<?php if (isset($_SESSION['err'])): ?>
    <div class="d-flex justify-content-center">
        <div class="col-md-4 alert alert-danger" role="alert">
            <?php echo $_SESSION['err']; ?>
        </div>
    </div>
    <?php endif; unset($_SESSION['err']); ?>
    <?php if (isset($_SESSION['succ'])): ?>
    <div class="d-flex justify-content-center">
        <div class="col-md-4 alert alert-success" role="alert">
            <?php echo $_SESSION['succ']; ?>
        </div>
    </div>
    <?php endif; unset($_SESSION['succ']); ?>
		<div class="content-w3ls">
			<div class="text-center icon">
				<span style="color: white; font-size: x-large;" class="text-center">Smart City <br> Sign in Page  </span>
			</div>
			<div class="content-bottom">
				<form action="login.php" method="post">
					<div class="field-group">
						<span class="fa fa-user" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="email" id="email" type="email" value="" placeholder="Email" required oninvalid="this.setCustomValidity('Please Enter Your Email')"
    oninput="this.setCustomValidity('')">
						</div>
					</div>
					<div class="field-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="password" id="password" type="Password" placeholder="Password" required oninvalid="this.setCustomValidity('Please Enter Your Password')"
    oninput="this.setCustomValidity('')">
						</div>
					</div>
					<div class="wthree-field">
						<button type="submit" class="btn">Log In</button>
					</div>
					<ul class="list-login">
						<!-- <li class="switch-agileits">
							<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								keep Logged in
							</label>
						</li> -->
						<!-- <li>
							<a href="#" class="text-right">forgot password?</a>
						</li> -->
						<li class="clearfix"></li>
					</ul>
				</form>
			</div>
		</div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
	setTimeout(function() {
    let alert = document.querySelector(".alert");
    alert.remove();
}, 3000);

</script>
</body>
<!-- //Body -->
</html>
