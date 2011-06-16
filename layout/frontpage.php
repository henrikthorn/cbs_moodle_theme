<?php

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <meta name="description" content="<?php echo strip_tags(format_text($SITE->summary, FORMAT_HTML)) ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body onload="updateClock(); setInterval('updateClock()',1000)" id="<?php echo $PAGE->bodyid ?>" class="<?php echo $PAGE->bodyclasses.' '.join(' ', $bodyclasses) ?>">
<img id="bg-image" src="<?php echo $CFG->wwwroot .'/theme/'. current_theme(); ?>/pix/CBS4.jpg">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">
<!-- START OF HEADER -->
	<?php include 'header.php'; ?>
<!-- END OF HEADER -->
    <div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">
            
                <div id="region-main-wrap">
                    <div id="region-main">
				<div id="front-left" class="block-region" style="width: 49%; float: left;";>
				       <div class="region-content">
						<?php echo $OUTPUT->blocks_for_region('side-main-left'); ?>
				 	</div>
				      <div id="hide_this" style="display: none;"><?php echo core_renderer::MAIN_CONTENT_TOKEN ?></div>
				</div>
				<div id="front-right" class="block-region" style="width: 49%; float: right;">
					<div class="region-content">
					      	<?php echo $OUTPUT->blocks_for_region('side-main-right'); ?>
					</div>
				</div>
                    </div>
                </div>
                
                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php if ($hassidepost) { ?>
                <div id="region-post" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>

<!-- START OF FOOTER -->
        <?php
                include("footer.php");
         ?>
</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
