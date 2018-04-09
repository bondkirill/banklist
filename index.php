<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Import paymant</title>
	    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<div id="header">
		<form action="index.php" method="post" enctype="multipart/form-data">
			<select name="selector">
				<option value="csv">Alior Banc (CSV)</option>
				<option value="dat">BRE Bank SA (DAT)</option>
			</select>
      		<input type="file" name="fileUpload">
     		 <button type="submit" name="btnSubmit">Upload</button>
		</form>
	</div>

	<div id="conteiner" >
		<div>
   <?php include 'upload.php'; ?>
        </div>
	</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
</body>
</html>