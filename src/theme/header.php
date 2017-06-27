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
<!doctype html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <title>Aimless Stack Pointers</title>
  <style>
  <?
    include(dirname(__FILE__).'/critical.css');
    include(dirname(__FILE__).'/components/header_critical.css');
    include(dirname(__FILE__).'/components/footer_critical.css');
  ?>
  </style>
  <noscript class="lazyload">
    <link rel="stylesheet" href="<?=get_bloginfo('template_url');?>/lazy.css">
    <link rel="stylesheet" href="<?=get_bloginfo('template_url');?>/components/footer_lazy.css">
    <link rel="stylesheet" href="<?=get_bloginfo('template_url');?>/components/header_lazy.css">
  </noscript>
</head>
<body>
  <header class="hero <?=is_single()?'single':'';?>">
    <a href="<?=home_url();?>" class="ribbon ribbon--btt">
      Aimless<br>
      Stack<br>
      Pointer
    </a>
  </header>
  <pwp-view rendered>
    <?
      etag_end();
    ?>
