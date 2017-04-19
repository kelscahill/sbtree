<?php
/*
Title: Page/Post: Template Settings
Post Type: page, post
Order: 1
Collapse: false
*/
  piklist('field', array(
    'type' => 'text',
    'field' => 'display_title',
    'label' => 'Display Title',
    'description' => 'Title that overrides the Wordpress default title and displays in the header of the page/post',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'textarea',
    'field' => 'intro',
    'label' => 'Intro',
    'description' => 'Intro text that appears above the main page content.',
    'columns' => 12,
    'attributes' => array(
      'rows' => 5,
      'cols' => 50
    )
  ));
?>
