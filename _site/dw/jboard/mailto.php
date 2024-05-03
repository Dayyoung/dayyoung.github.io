<?php
if(!$HTTP_GET_VARS[target]) {
	echo "<script>history.go(-1);</script>";
} else {
	$target = str_replace("_NOSPAM_", "@", $HTTP_GET_VARS[target]);
	Header("Location: mailto:$target");
}
?>
