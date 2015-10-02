<?php

/**
 * A filter for a chapter range
 *
 * This has to be custom because each bible field entry can span multiple chapters.
 * So if a range is set for a search, we need to match up with the range in the field,
 * rather than a single number.
 */
class bible_field_views_handler_filter_start_end extends views_handler_filter_numeric {
  function construct() {
    parent::construct();
  }

  function init(&$view, $options) {
    parent::init($view, $options);
  }
  
  function operators() {
    $operators = parent::operators();
    $operators['range'] = array(
      'title' => t('Within start and end range'),
      'method' => 'op_start_end',
      'short' => t('start end'),
      'values' => 1,
    );
    return $operators;
  }
    
  function op_start_end($field) {
    if (substr($field, -6) == '_start') {
      $start_field = $field;
      $end_field = str_replace('_start', '_end', $field);
    } else {
      $start_field = str_replace('_end', '_start', $field);
      $end_field = $field;
    }
    // If a verse is selected, draw from the chapter_verse_range column
    $this_value = $this->value['value'];
    if (in_array(substr($field, -15), array('verse_range_end', 'verse_range_start'))) {
      // Grabbing the chapter. @TODO: This is a little funky because it's taking a guess
      // that the chapter uses a start / end range handler.
      foreach ($this->view->exposed_input as $key => $value) {
        if (strpos($key, '_chapter_range_') !== FALSE) {
          $start_field = $this->definition['content_field_name'] .'_chapter_verse_range_start';
          $end_field = $this->definition['content_field_name'] .'_chapter_verse_range_end';
          $this_value = $value . str_pad($this->value['value'], 5, "0", STR_PAD_LEFT);
        }
      }
    }
    if ($this->value['value'] > 0) {
      $this->query->add_where($this->options['group'], "$end_field >= %d", $this_value);
      $this->query->add_where($this->options['group'], "$start_field <= %d", $this_value);
    }
  }
  
  
  function value_form(&$form, &$form_state) {
    drupal_add_js(drupal_get_path('module', 'bible_field') .'/bible_field.js');
    $field = field_info_field($this->definition['field_name']);
    $options = bible_field_book_options($field['settings']['version']);
    parent::value_form($form, $form_state);
    $class = 'bible_field_'. str_replace($this->definition['field_name'] .'_', '', $this->definition['field']) .'_filter';
    $options = array('' => '') + drupal_map_assoc(range(1, BIBLE_FIELD_DEFAULT_COUNT));
    
    if ($field['type'] == 'bible_field') {
      $form['value']['#title'] = $this->options['expose']['label'] .' '. t('range');
      if ($form['value']['min']) {
        $form['value']['#type'] = 'fieldset';
        $form['value']['min'] = array(
          '#type' => 'select',
          '#attributes' => array('class' => $class),
          '#options' => $options,
          '#default_value' => $this->value,
        );
        $form['value']['max'] = array(
          '#type' => 'select',
          '#attributes' => array('class' => $class),
          '#options' => $options,
          '#default_value' => $this->value,
        );
      } else {
        $form['value'] = array(
          '#type' => 'select',
          '#title' => t('Value'),
          '#attributes' => array('class' => $class),
          '#options' => $options,
          '#default_value' => $this->value,
        );
      }
    }
    // Create hidden inputs with chapter ranges
    $books = bible_field_load_books($field['settings']['version']);
    $chapter_hidden_fields = '';
    foreach ($books as $book => $settings) {
      $chapter_hidden_fields .= '<input type="hidden" name="'. $book .'" value="'. $settings['chapters'] .'" />';
    }
    $form['hidden_chapters'] = array(
      '#type' => 'markup',
      '#value' => $chapter_hidden_fields,
    );
  }
}