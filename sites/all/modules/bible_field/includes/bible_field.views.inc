<?php

/**
 * Implements hook_field_views_data().
 */
function bible_field_field_views_data($field) {
  $data = field_views_field_default_views_data($field);
  
  // Add handler for books
  foreach ($field['storage']['details']['sql'] as $type => $tables) {
    foreach ($tables as $table_name => $columns) {
      if(!isset($columns['book_name'])) {
        continue;
      }
      
      $column_real_name = $columns['book_name'];
      if (!isset($data[$table_name][$column_real_name]['filter'])) {
        continue;
      }

      $data[$table_name][$column_real_name]['filter']['handler'] = 'bible_field_views_handler_filter_book_name';
    }
  }
  
  // Add handlers for chapter_verse ranges
  foreach ($field['storage']['details']['sql'] as $type => $tables) {
    foreach ($tables as $table_name => $columns) {
      if(!isset($columns['reference_start_weight'])) {
        continue;
      }
      
      $column_real_name = $columns['reference_start_weight'];
      if (!isset($data[$table_name][$column_real_name]['filter'])) {
        continue;
      }

      $data[$table_name][$column_real_name]['filter']['handler'] = 'bible_field_views_handler_filter_start_end';
    }
  }
  
  // Add handler for ordering
  foreach ($field['storage']['details']['sql'] as $type => $tables) {
    foreach ($tables as $table_name => $columns) {
      if(isset($columns['reference_start_weight'])) {
        $column_real_name = $columns['reference_start_weight'];
        if (!isset($data[$table_name][$column_real_name]['filter'])) {
          continue;
        }

        $data[$table_name][$column_real_name]['sort']['handler'] = 'views_handler_sort';
      }
      else if(isset($columns['reference_end_weight'])) {
        $column_real_name = $columns['reference_end_weight'];
        if (!isset($data[$table_name][$column_real_name]['filter'])) {
          continue;
        }

        $data[$table_name][$column_real_name]['sort']['handler'] = 'views_handler_sort';
      }
    }
  }
  
  return $data;
}