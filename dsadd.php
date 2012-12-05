<?php 
include_once 'config.php';

if(sizeof($_POST) != 0){
	$username = $_POST['inputUsername'];
	$firstName = $_POST['inputFirstName'];
	$lastName = $_POST['inputLastName'];
	
	$fullName = $firstName . " " .$lastName;
	$arrAD = ACTIVE_DIRECTORY::$default;
	$arrFS = FILE_SHARES::$default;
	if($_POST['inputPassword'] != ""){
		$password = $_POST['inputPassword'];
	} else {
		$password = ACTIVE_DIRECTORY::$default['password'];
	}
	
	// Login Script
	$newUser  = "dsadd user \"CN=".$username.",".$arrAD['ou']."\" -samid ". $username;
	$newUser .= " -pwd ".$password;
	$newUser .= " -upn ".$username . $arrAD['upn'];
	$newUser .= " -display \"".$fullName."\"";
	$newUser .= " -desc \"".$fullName."\"";
	$newUser .= " -mustchpwd ".$arrAD['mustchpwd']. " -canchpwd " . $arrAD['canchpwd']. " -pwdneverexpires ".$arrAD['pwdneverexpires'];
	
	if(array_key_exists('memberof',$arrAD)){
		$newUser .= " -memberof \"".$arrAD['memberof']."\"";
	}
	
	$newUser .= " -hmdir ".$arrAD['hmdir'] . $username."$";
	$newUser .= " -hmdrv ".$arrAD['hmdrv'];
	$newUser .= " -loscr ".$arrAD['loscr']."\r\n"; 
	
	// File Share info
	$shareDir  = "if not exist ".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username . " mkdir ".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username ."\r\n";
	$shareDir .= "calcs ".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username ." /e /g ".$username.":F\r\n";
	$shareDir .= "net share ".$username."$=".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username ." /GRANT:".$username.",FULL /UNLIMITED /REMARK:\"".$fullName."\"\r\n";
	
// 	header('Content-type: text/bat');
// 	header('Content-Disposition: attachment;filename=createUser.bat');
// 	$fp = fopen('php://output','w');
// 	fwrite($fp, $newUser);
// 	fclose($fp);
	
// 	header('Content-type: text/bat');
// 	header('Content-Disposition: attachment;filename=createShare.bat');
// 	$ff = fopen('php://output','w');
// 	fwrite($ff, $shareDir);
// 	fclose($ff);

	$file = tempnam("tmp", "zip");
	$zip = new ZipArchive();
	$zip->open($file, ZipArchive::OVERWRITE);
	
	$zip->addFromString("createUser.bat", $newUser);
	$zip->addFromString('createShare.bat', $shareDir);
	
	$zip->close();
	
	header('Content-Type: application/zip');
	header('Content-Length: '.filesize($file));
	header('Content-Disposition: attachement; filename="create.zip"');
	readfile($file);
	unlink($file);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<title>DSAdd Users</title>
	<!--  Styles -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="css/default.css" rel="stylesheet" />
	
	
	<!--  HTML5 shim, for IE6-8 support of HTML5 Elements -->
	<!--[if lt IE 9]
		<script srce="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top"> 
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="index.php">DSAdd Users</a>
		</div>
	</div>
</div>
<div class="container">
	<div class="row-fluid">
		<div class="span3">
			<!-- Sidebar content -->
			<ul class="nav nav-tabs nav-stacked">
				<li><a href="about.php">About</a></li>
				<li><a href="#">Help</a></li>
				<li><a href="dsadd.php">DSAdd</a></li>
				<li><a href="dsaddmulti.php">DSAdd Multiple</a></li>
			</ul>
		</div>
		<div class="span9">
			<!-- Body content -->
			<form action="dsadd.php" method="post">
				<div class="control-group">
					<label class="control-label" for="inputFirstName">First Name</label>
					<div class="controls">
						<input type="text" id="inputFirstName" name="inputFirstName" placeholder="John">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputLastName">Last Name</label>
					<div class="controls">
						<input type="text" id="inputLastName" name="inputLastName" placeholder="Smith">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputUsername">Username</label>
					<div class="controls">
						<input type="text" id="inputUsername" name="inputUsername" placeholder="jsmith">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<input type="text" id="inputPassword" name="inputPassword" placeholder="YourPasswordHere">
					</div>
				</div>
				<div class="control-group">
					<button type="submit" class="btn" name="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
<?php 
}
?>