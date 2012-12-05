<?php 
include_once 'config.php';

if(sizeof($_POST) != 0){
	
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$fileData = file_get_contents($_FILES['file']['tmp_name']);
		$arrFile = preg_split("/\n/", $fileData);
		$userData = array_slice($arrFile,1);
		foreach($userData as $userInfo){
			list($grad,$user,$fname,$lname,$email) = explode(",",$userInfo);
		}
	}
	
// 	$arrAD = ACTIVE_DIRECTORY::$default;
// 	$arrFS = FILE_SHARES::$default;
// 	if($_POST['inputPassword'] != ""){
// 		$password = $_POST['inputPassword'];
// 	} else {
// 		$password = ACTIVE_DIRECTORY::$default['password'];
// 	}
	
// 	// Login Script
// 	$newUser  = "dsadd user \"CN=".$username.",".$arrAD['ou']."\" -samid ". $username;
// 	$newUser .= " -pwd ".$password;
// 	$newUser .= " -upn ".$username . $arrAD['upn'];
// 	$newUser .= " -display \"".$fullName."\"";
// 	$newUser .= " -desc \"".$fullName."\"";
// 	$newUser .= " -mustchpwd ".$arrAD['mustchpwd']. " -canchpwd " . $arrAD['canchpwd']. " -pwdneverexpires ".$arrAD['pwdneverexpires'];
	
// 	if(array_key_exists('memberof',$arrAD)){
// 		$newUser .= " -memberof \"".$arrAD['memberof']."\"";
// 	}
	
// 	$newUser .= " -hmdir ".$arrAD['hmdir'] . $username."$";
// 	$newUser .= " -hmdrv ".$arrAD['hmdrv'];
// 	$newUser .= " -loscr ".$arrAD['loscr']."\r\n"; 
	
// 	// File Share info
// 	$shareDir  = "if not exist ".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username . " mkdir ".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username ."\r\n";
// 	$shareDir .= "calcs ".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username ." /e /g ".$username.":F\r\n";
// 	$shareDir .= "net share ".$username."$=".$arrFS['dataDrive'].$arrFS['homePath']."\\".$username ." /GRANT:".$username.",FULL /UNLIMITED /REMARK:\"".$fullName."\"\r\n";
	
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

// 	$file = tempnam("tmp", "zip");
// 	$zip = new ZipArchive();
// 	$zip->open($file, ZipArchive::OVERWRITE);
	
// 	$zip->addFromString("createUser.bat", $newUser);
// 	$zip->addFromString('createShare.bat', $shareDir);
	
// 	$zip->close();
	
// 	header('Content-Type: application/zip');
// 	header('Content-Length: '.filesize($file));
// 	header('Content-Disposition: attachement; filename="create.zip"');
// 	readfile($file);
// 	unlink($file);
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
			<h1>Upload File</h1>
			<hr>
			<form enctype="multipart/form-data" action="dsaddmulti.php" method="post">
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
				<div class="control-group">
					<label class="control-label" for="description">File</label>
					<div class="controls">
						<input type="file" id="file" name="file" />
					</div>
				</div>
				<div class="control-group">
					<button type="submit" class="btn" name="submit">Submit</button>
				</div>
			</form>
			
			<a href="template.csv">Template File</a>
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