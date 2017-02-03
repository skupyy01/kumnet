<html>
<head>
	<title>mm</title>
</head>
<body>
H

<?php 
$ssh = new Net_SSH2('128.199.157.47');
if (!$ssh->login('root', '66141576')) {
    exit('Login Failed');
}

$command = 'echo 1234 > /var/www/aa';
$output = $ssh->exec($command);
 ?>
</body>
</html>