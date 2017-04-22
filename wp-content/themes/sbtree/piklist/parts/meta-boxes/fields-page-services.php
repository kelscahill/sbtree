<?php
/*
Title: Services Section
Post Type: page
Template: template-services
Order: 1
Collapse: false
*/

piklist('field', array(
  'type' => 'group',
  'label' => 'Services',
  'field' => 'services',
  'add_more' => true,
  'fields' => array(
    array(
      'type' => 'text',
      'field' => 'service_row_kicker',
      'label' => 'Service Row Kicker',
      'columns' => 12
    ),
    array(
      'type' => 'text',
      'field' => 'service_row_title',
      'label' => 'Service Row Title',
      'columns' => 12
    ),
    array(
      'type' => 'textarea',
      'field' => 'service_row_description',
      'label' => 'Service Row Description',
      'columns' => 12
    ),
    array(
      'type' => 'group',
      'label' => 'Services',
      'field' => 'services',
      'add_more' => true,
      'fields' => array(
        array(
          'type' => 'text',
          'field' => 'service_title',
          'label' => 'Service Title',
          'columns' => 12
        ),
        array(
          'type' => 'textarea',
          'field' => 'service_description',
          'label' => 'Service Description',
          'columns' => 12
        )
      )
    )
  ),

));
?>
