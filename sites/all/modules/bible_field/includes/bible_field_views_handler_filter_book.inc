<?php

/**
 * A book filter - pulls in a select input with the books listed by machine name
 */
class bible_field_views_handler_filter_book_name extends views_handler_filter_in_operator {
  function get_value_options() {
    if (isset($this->value_options)) {
      return;
    }
    
    $this->value_title = t('Book');
    $field = field_info_field($this->definition['field_name']);
    
    $load_opts = array(
      'value' => 'machine_name',
    );
    
    $this->value_options = bible_field_book_options(array(), $load_opts);
  }
}