<?php

/**
 * A filter for a chapter range
 */
class bible_field_handler_filter_composite extends views_handler_filter {
  /**
   * Need to make sure the input is accepted if at least the book is set
   */
  function accept_exposed_input($input) {
    if (empty($this->options['exposed'])) {
      return TRUE;
    }
    if ($input['book']['book'] != '') {
      return TRUE;
    }
  }
  
  function option_definition() {
    $options = parent::option_definition();

    $options['value'] = array(
      'contains' => array(
        'book' => array('default' => ''),
        'chapter' => array('default' => ''),
        'verse' => array('default' => ''),
        'value' => array('default' => ''),
      ),
    );

    return $options;
  }
  
  function query() {
    $this->ensure_my_table();
    $field_name = str_replace('_chapter_verse_range_start', '', $this->real_field);
    $book_field_name = $field_name .'_book';
    $start_field_name = $field_name .'_chapter_verse_range_start';
    $end_field_name = $field_name .'_chapter_verse_range_end';
    $chapter_verse_value = $this->view->exposed_data['chapter'] . str_pad($this->view->exposed_data['verse'], 5, "0", STR_PAD_LEFT);
    if ($this->view->exposed_data['book'] != '') {
      $this->query->add_where($this->options['group'], "$this->table_alias.$book_field_name = '%s'", $this->view->exposed_data['book']);
    }
    if ($this->view->exposed_data['chapter'] != '') {
      $this->query->add_where($this->options['group'], "$this->table_alias.$start_field_name <= '%d'", $chapter_verse_value);
      $this->query->add_where($this->options['group'], "$this->table_alias.$end_field_name >= '%d'", $chapter_verse_value);
    }
    //$this->query->add_where($this->options['group'], "$this->table_alias.$this->real_field " . $this->operator . " '%s'", $this->value);
  }
  
  function value_form(&$form, &$form_state) {
    $form['value'] = array(
      '#tree' => TRUE,
      '#value' => 1,
      '#type' => 'value',
    );
    drupal_add_js(drupal_get_path('module', 'bible_field') .'/bible_field.js');
    $field = content_fields($this->definition['content_field_name']);
    parent::value_form(&$form, &$form_state);
    $class = str_replace($this->definition['content_field_name'] .'_', '', $this->definition['field']);
    if ($form_state['form_key'] != 'config-item') { // It's a filter, not a config form
      $test = '';
      $hidden_chapter_lenth = bible_field_book_to_chapter_hidden_inputs($field['version']);
        // Create hidden inputs with chapter ranges
      $form['hidden_chapters'] = array(
        '#type' => 'markup',
        '#value' => bible_field_book_to_chapter_hidden_inputs($field['version']),
      );
      if (in_array($this->options['granularity'], array('book', 'chapter', 'verse'))) {
        $options = array_merge(array('' => ''), bible_field_book_options($field['version']));
        $form['value']['book'] = array(
          '#type' => 'select',
          '#title' => t('Book'),
          '#attributes' => array('class' => 'bible_field_book_filter'),
          '#options' => $options,
          '#prefix' => '<div class="views-exposed-widget" style="padding-top:0px">',
          '#suffix' => '</div>',
          '#default_value' => $this->value,
        );
      }
      if (in_array($this->options['granularity'], array('chapter', 'verse'))) {
        $options = drupal_map_assoc(array_merge(array(''), range(1, BIBLE_FIELD_DEFAULT_COUNT)));
        $form['value']['chapter'] = array(
          '#type' => 'select',
          '#title' => t('Chapter'),
          '#attributes' => array('class' => 'bible_field_chapter_range_start_filter'),
          '#options' => $options,
          '#prefix' => '<div class="views-exposed-widget" style="padding-top:0px">',
          '#suffix' => '</div>',
          '#default_value' => $this->value,
        );
      }
      if (in_array($this->options['granularity'], array('verse'))) {
        $options = drupal_map_assoc(array_merge(array(''), range(1, BIBLE_FIELD_DEFAULT_COUNT)));
        $form['value']['verse'] = array(
          '#type' => 'select',
          '#title' => t('Verse'),
          '#attributes' => array('class' => 'bible_field_verse_range_start_filter'),
          '#options' => $options,
          '#prefix' => '<div class="views-exposed-widget" style="padding-top:0px">',
          '#suffix' => '</div>',
          '#default_value' => $this->value,
        );
      }
    }
  }
  
    // Set default values for the date filter.
  function options(&$options) {
    parent::options($options);
    $options['granularity'] = 'book';  
  }
  

  /**
   * Set the granularity of the date parts to use in the filter.
    */
  function has_extra_options() {
    return TRUE;
  }

  function extra_options_form(&$form, &$form_state) {
    $test = '';
    $form['granularity'] = array(
      '#type' => 'radios',
      '#title' => 'Granularity',
      '#options' => array(
        'book' => 'Book',
        'chapter' => 'Chapter',
        'verse' => 'Verse',
      ),
      '#default_value' => $this->options['granularity'],
      '#description' => t('If you select "Book", only the book input will display. For "Chapter", both the book and chapter inputs will display, and so on.'),
    );
  }
  
}