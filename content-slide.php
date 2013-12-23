<?php
	$image = get_field("image");
	$image_2 = get_field("image_2");
	$image_3 = get_field("image_3");
	$caption = get_field("caption");

	// Build layout style based on what images are present
	$strLayout = "layout";
	if($image_3) {
		$strLayout .= "3";
	} elseif($image_2) {
		$strLayout .= "2";
	} else {
		$strLayout .= "1";
	}
	if($image['width']>$image['height']) {
		$strLayout .= "h";
	} else {
		$strLayout .= "v";
	}
?>
<div class="cycleslide <?php echo $strLayout; ?>" title="<?php echo the_title(); ?>">
	<?php echo get_image_tag($image['id'],$image['alt'],$image['title'],"none","none"); ?>
	<?php echo get_image_tag($image_2['id'],$image_2['alt'],$image_2['title'],"none","none"); ?>
	<?php echo get_image_tag($image_3['id'],$image_3['alt'],$image_3['title'],"none","none"); ?>
	<div class="caption"><?php echo $caption; ?></div>
</div>