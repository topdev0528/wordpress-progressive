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
  include('third_party/mustache.php/Mustache/Autoloader.php');
  Mustache_Autoloader::register();
  $mustacheEngine = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__)),
  ));

  function render_json($data) {
    echo json_encode($data);
  }

  function render_template($path, $data) {
    global $mustacheEngine;
    echo $mustacheEngine->render($path, $data);
  }

  /**
   * Extracts the excerpt from a post (the text before `<!-- more -->`).
   * This is usually implemented in `get_the_content`, but since we are not
   * using that, we gotta copy-paste.
   *
   * Source: https://core.trac.wordpress.org/browser/tags/4.7.3/src/wp-includes/post-template.php#L288
   */
  function extract_excerpt($post) {
    if(!empty($post->post_excerpt))
      return $post->post_excerpt;
    if (preg_match('/<!--more(.*?)?-->/', $post->post_content)) {
      $idx = strpos($post->post_content, '<!--more');
      return substr($post->post_content, 0, $idx);
    }
    return substr($post->post_content, 0, 44) . "...";
  }
?>
