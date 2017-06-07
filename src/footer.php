<?
  /**
   * Copyright 2017 Google Inc. All Rights Reserved.
   * Licensed under the Apache License, Version 2.0 (the "License");
   * you may not use this file except in compliance with the License.
   * You may obtain a copy of the License at
   *     http://www.apache.org/licenses/LICENSE-2.0
   * Unless required by applicable law or agreed to in writing, software
   * distributed under the License is distributed on an "AS IS" BASIS,
   * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   * See the License for the specific language governing permissions and
   * limitations under the License.
   */
?>
<?
  require_once(dirname(__FILE__).'/../../../wp-load.php');
  etag_start();
?>
</pwp-view>
<? wp_nav_menu(array('theme_location' => 'footer-nav')); ?>
<div style="height: 200vh">lol</div>
<?
  $srcimagepath = dirname(__FILE__).'/images/testimage.png';
  $srcimagesize = getimagesize($srcimagepath);
  $srcimagewidth = $srcimagesize[0];
  $srcimageheight = $srcimagesize[1];
  $srcimage = imagecreatefrompng($srcimagepath);
  $dstimagewidth = 9;
  $dstimageheight = 9;
  echo 'src '. $srcimagewidth . '/' . $srcimageheight;
  echo 'dst ' . $dstimagewidth . '/' . $dstimageheight;
  $dstimage = imagecreatetruecolor($dstimagewidth, $dstimageheight);
  imagecopyresized($dstimage, $srcimage, 0, 0, 0, 0, $dstimagewidth, $dstimageheight, $srcimagewidth, $srcimageheight);
  ob_start();
  imagepng($dstimage);
  $rawimg = ob_get_contents();
  ob_end_clean();
  $base64img = base64_encode($rawimg);
?>
<pwp-lazy-image src="<?=get_bloginfo('template_url');?>/images/testimage.png" style="display: block; width: <?=$srcimagewidth;?>px; height: <?=$srcimageheight;?>px; background-image: url(data:image/png;base64,<?=$base64img;?>); background-size: 100% 100%; background-repeat: no-repeat;"></pwp-lazy-image>
<?
  wp_footer();
?>
<script>
  window._wordpressConfig = {
    templateUrl: '<?=get_bloginfo('template_url');?>',
    baseUrl: '<?=home_url();?>',
  };
</script>
<script>
<? readfile(dirname(__FILE__).'/scripts/import-polyfill.js'); ?>
</script>
<script>
<? readfile(dirname(__FILE__).'/scripts/ric-polyfill.js'); ?>
</script>
<script>
<? readfile(dirname(__FILE__).'/scripts/sw-postmessage.js'); ?>
</script>
<script type="module" src="<?=get_bloginfo('template_url');?>/scripts/lazyload.js"></script>
<script type="module" src="<?=get_bloginfo('template_url');?>/scripts/router.js"></script>
<script type="module" src="<?=get_bloginfo('template_url');?>/scripts/pwp-view.js"></script>
<script type="module" src="<?=get_bloginfo('template_url');?>/scripts/pwp-notification.js"></script>
<script type="module" src="<?=get_bloginfo('template_url');?>/scripts/pwp-lazy-image.js"></script>
<script type="module" src="<?=get_bloginfo('template_url');?>/scripts/install-sw.js"></script>
<?
  etag_end();
?>
