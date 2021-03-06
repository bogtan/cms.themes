<?php

require_once dirname(__FILE__)."/templates/system/pager.func.php";
require_once dirname(__FILE__)."/templates/menu/menu-tree.func.php";
require_once dirname(__FILE__)."/templates/menu/menu-link.func.php";
require_once dirname(__FILE__)."/templates/menu/menu-position.func.php";
require_once dirname(__FILE__)."/templates/comments/comments.func.php";
require_once dirname(__FILE__)."/templates/profile2/profile.func.php";

/*
 * Preprocess html
 */

function cms_frontend_preprocess_html(&$variables) {
  drupal_add_css(
          'http://fonts.googleapis.com/css?family=Lato:400,700,900,400italic', array('type' => 'external')
  );
  // Add conditional CSS for IE8
  drupal_add_css(path_to_theme() . '/css/ie8.css', array('media'=>'screen','group' => CSS_THEME, 'browsers' => array('IE' => 'IE 8', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
  // Add conditional CSS for IE9
  drupal_add_css(path_to_theme() . '/css/ie9.css', array('media'=>'screen','group' => CSS_THEME, 'browsers' => array('IE' => 'IE 9', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
  // Add conditional CSS for IE10
  drupal_add_css(path_to_theme() . '/css/ie10.css', array('media'=>'screen','group' => CSS_THEME, 'browsers' => array('IE' => 'IE 10', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
    drupal_add_js(path_to_theme() . '/js/menu.js');
}

/*
 * Preprocess blocks
 */

function cms_frontend_preprocess_block(&$variables) {
  //add a css class to languages switch block
  if ($variables['block']->module == 'locale' && $variables['block']->delta == 'language_content')
    $variables['classes_array'][] = drupal_html_class('language-menu');
}

/*
 * Alter forms like search form
 */

function cms_frontend_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    // Prevent user from searching the default text
    $form['#attributes']['onsubmit'] =
            "if(this.search_block_form.value=='".t('Search on this site')."'){ alert('".t('Please enter a search')."'); return false; }";
    // Alternative (HTML5) placeholder attribute instead of using the javascript
    $form['search_block_form']['#attributes']['placeholder'] = t('Search on this site');
    $form['search_block_form']['#attributes']['class'][] = 'input-sm';
  }
}

/*
 * Overwrite language switch block content
 */

function cms_frontend_links__locale_block(&$variables) {
  global $language_content, $front_page;

  //current path
  $path = $front_page ? $front_page : $_GET['q'];

  $content = '<span class="btn-group language-menu">';
  $content .= '<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">';
  $content .= strtoupper($language_content->language) . '&nbsp;';
  $content .= '<span class="caret"></span></button>';
  $content .= '<ul class="language-switcher-locale-url dropdown-menu">';

  //languages
  foreach ($variables['links'] as $language => $langInfo) {
    $lang = $variables['links'][$language]['language']->language;
    //skip displaying current language
    if($language_content->language == $lang)
      continue;

    $link = $lang.'/'.drupal_get_path_alias($path, $lang);
    $string = '<li class="%1$s"><a href="/%3$s" class="language-link" lang="%1$s">%2$s</a></li>';
    $content .= sprintf($string, $lang, strtoupper($lang), $link);
  }



  $content .= '</ul>';
  $content .= '</span>';

  return $content;
}

/**
 * Process variables for user-picture.tpl.php.
 *
 * The $variables array contains the following arguments:
 * - $account: A user, node or comment object with 'name', 'uid' and 'picture'
 *   fields.
 *
 * @see user-picture.tpl.php
 */
function cms_frontend_preprocess_user_picture(&$variables, $theme, $style = 'userimage') {
  $variables['user_picture'] = '';

  $account = $variables['account'];

  //take image from profile
  $filepath = get_profile_user_image($account->uid);

  if (!$filepath) {
    $filepath = 'public://profiles_pictures/default.png';
  }
  if (isset($filepath)) {
    $alt = t("@user's picture", array('@user' => format_username($account)));
    // If the image does not have a valid Drupal scheme (for eg. HTTP),
    // don't load image styles.
    if (module_exists('image') && file_valid_uri($filepath)) {
      $variables['user_picture'] = theme('image_style', array('style_name' => $style, 'path' => $filepath, 'alt' => $alt, 'title' => $alt));
    }
    else {
      $variables['user_picture'] = theme('image', array('path' => $filepath, 'alt' => $alt, 'title' => $alt));
    }
    if (!empty($account->uid) && user_access('access user profiles')) {
      $attributes = array('attributes' => array('title' => t('View user profile.')), 'html' => TRUE);
      $variables['user_picture'] = l($variables['user_picture'], "user/$account->uid", $attributes);
    }
  }
}

/*
 * Register theme hooks
 */
function cms_frontend_theme(){
  return array(
    'recent_comments' => array(
        'variables' => array('items' => null),
        'template' => 'templates/comments/recent-comments',
     ),
  );
}

/**
 * Theme function implementation for bootstrap_search_form_wrapper.
 */
function cms_frontend_bootstrap_search_form_wrapper($variables) {
  $output = '<div class="input-group search-area">';
  $output .= $variables['element']['#children'];
  $output .= '</div>';
  return $output;
}

/*
 * Forum author panel
 */
function cms_frontend_preprocess_author_pane_user_picture(&$variables, $theme, $style = 'userimage') {
  $variables['picture'] = '';

  $account = $variables['account'];

  //take image from profile
  $filepath = get_profile_user_image($account->uid);

  if (!$filepath) {
    $filepath = 'public://profiles_pictures/default.png';
  }
  if (isset($filepath)) {
    $alt = t("@user's picture", array('@user' => format_username($account)));

    // If the image does not have a valid Drupal scheme (for eg. HTTP),
    // don't load image styles.
    if (module_exists('image') && file_valid_uri($filepath)) {
      $variables['picture'] = theme('image_style', array('style_name' => $style, 'path' => $filepath, 'alt' => $alt, 'title' => $alt));
      $variables['imagecache_used'] = TRUE;
    }
    else {
      $variables['picture'] = theme('image', array('path' => $filepath, 'alt' => $alt, 'title' => $alt));
      $variables['imagecache_used'] = FALSE;
    }

    if (!empty($account->uid) && user_access('access user profiles')) {
      $options = array(
        'attributes' => array('title' => t('View user profile.')),
        'html' => TRUE,
      );
      $variables['picture_link_profile'] = l($variables['picture'], "user/$account->uid", $options);
    }
    else {
      $variables['picture_link_profile'] = FALSE;
    }
  }
}

/*
 * Preprocess node variables
 */
function cms_frontend_preprocess_node(&$variables){
  $profile = get_user_profile($variables['node']->uid);
  $name = ($profile && !empty($profile['full_name']))? $profile['full_name']:theme('username', array('account' => $variables['node']));

  $variables['name'] = $name;
  $variables['country'] = ($profile && !empty($profile['country']))? $profile['country']:'';
}

/*
 * Preprocess page load
 */
function cms_frontend_preprocess_page(&$variables, $hook){
    //use page--forum template for content type forum
    if (isset($variables['node']) && $variables['node']->type == 'forum')
        $variables['theme_hook_suggestions'][] = 'page__forum';

    //remove user picture from account page
    if (arg(0)=="user" || arg(0)=="users" ) {
        unset ($variables['page']['content']['system_main']['user_picture']);
    }

    //set theme for primary and secondary menu
    $variables['page']['primary_menu']['menu_menu-frontend-main-menu']['#theme_wrappers'] =
            array('menu_tree__menu_frontend_main_menu');
    $variables['page']['secondary_menu']['menu_block_1']['#content']['#theme_wrappers'] =
            array('menu_tree__menu_frontend_main_menu_secondary');
    $variables['page']['tertiary_menu']['menu_block_3']['#content']['#theme_wrappers'] =
            array('menu_tree__menu_frontend_main_menu_tertiary');
    $variables['page']['footer_menu']['menu_block_2']['#content']['#theme_wrappers'] =
            array('menu_tree__menu_front_end_footer_menu');
}
