<?php
if (isset($_POST["gonder"])) {	
$argv = "$_POST[yazi]";
$contents = ($argv);
if (preg_match('/Obfuscation provided by FOPO - Free Online PHP Obfuscator:/',$contents) === 0) {
	echo 'Fopo kod nerde ? <input onclick="history.back();" type="button" value="Geri don">';
	exit;
}
$contents = preg_replace('/\/\/?\s*\*[\s\S]*?\*\s*\/\/?/', '', $contents);
$eval = explode('(',$contents);
$base64 = explode('"',$eval[2]);
$i1 = explode("eval",base64_decode($base64[1]));
$i2 = explode(":",$i1[1]);
$i3 = explode("\"",$i2[1]);
$encodedlayer = gzinflate(base64_decode(str_rot13($i3[1])));
while (!preg_match('/\?\>/',$encodedlayer)) {
	$dl = explode("\"",$encodedlayer);
	if (sizeof($dl)>7) {
	    $nextlayer = gzinflate(base64_decode(str_rot13($dl[7])));
	    $encodedlayer = $nextlayer;
	}
	else {
	    $nextlayer = gzinflate(base64_decode($dl[5]));
	    $encodedlayer = $nextlayer;
	}
}
$bitti = substr($encodedlayer, strpos($encodedlayer, '?>') + 2, strlen($encodedlayer));
}
?>
<center><h1>Fopo Decoder</h1>
<form method="post"></br></br>
			<center><button style="width:500px;" class="btn btn-success" onclick="return ce_check(this);" name="gonder"> Decoder </button></center> </br>

			
      <fieldset class="form-group">
	  		
        <div class="col-xs-6 textarea-left">
          <textarea class="form-control textarea" name='yazi' placeholder="Fopo kodlarini yazip decoder'e tiklayiniz...." rows="12"></textarea>
        </div>
        <div class="col-xs-6 textarea-right">
          <textarea class="form-control textarea" readonly rows="12"><?php echo  ''. htmlspecialchars($bitti) .'' ; ?></textarea>
        </div>
