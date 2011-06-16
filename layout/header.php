<?php 
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));
?>
<?php if ($hasheading || $hasnavbar) { ?>
    <div id="page-header">
    <div id="page-header-inner">

        <div id="logoTitle">
                <a href="<?php echo $CFG->wwwroot; ?>"><img id="mainlogo" src="<?php echo $CFG->wwwroot .'/theme/'. current_theme(); ?>/pix/logo.png"></a>

        </div>

        <?php if ($hasheading) { ?>

        <div class="headermenu">
            <div id="profile">
                <?php if (isset($USER->username)){
                        $img_link = hash("md5", "Learn".$USER->username."CBS"." IT2f1", false);
				if(file_exists($CFG->wwwroot."/theme/".$CFG->theme."/pix/".$img_link.".jpg")){
					echo "<img src='".$CFG->wwwroot."/theme/".$CFG->theme."/pix/".$img_link.".jpg' class='picture'>";
				}
				else{
					echo "<img src='".$CFG->wwwroot."/theme/".$CFG->theme."/pix/ProfileSilhouette.gif' class='picture'>";
				}
	                }
                ?>
            <?php
                if ($haslogininfo) {
                    echo $OUTPUT->login_info();
                }
                if (!empty($PAGE->layout_options['langmenu'])) {
                    echo $OUTPUT->lang_menu();
                }
                echo $PAGE->headingmenu
            ?>
            
	</div>
	<div id="datetime">
		<span id="clock">&nbsp;</span>
        </div>
	</div>
        <?php } ?>
        <?php if ($hascustommenu) { ?>
        <div id="custommenu"><?php echo $custommenu; ?></div>
        <?php } ?>
        <?php if ($hasnavbar) { ?>
            <div class="navbar clearfix">
                <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                <div class="navbutton">
                    <?php echo $PAGE->button; ?>
                                <?php $path_to_mail = $CFG->wwwroot."/theme/".$CFG->theme."/mail.php?url=".$_SERVER['REQUEST_URI']; ?>
                    <input style="margin-right: 10px;" type="submit" value="<?php echo get_string('report_error', 'moodle'); ?>" onclick="window.open('<?php print $path_to_mail; ?>','report_error', 'width=325px,height=500px')" />
                </div>

            </div>
        <?php } ?>
    </div>
    </div>
<?php } ?>
<!-- END OF HEADER -->

