
var BibleField = BibleField || {};

Drupal.behaviors.bible_field = {
  attach: (function(context) { 
    $('.biblefield-book-input').parents('div:not(.biblefield-processed)').each(function () {
      var chapters;
      var i;
      var $table;
      $table = $(this);
      var style = 'color:silver;font-style:italic';
      // Initial load of chapter numbers and coloring
      $(this).find('.biblefield-book-input').each(function() {
        BibleField.loadChapters($(this));
      });
      var chapters = $table.find('input[name="' + $(this).val() + '"]:first').val();
      $table.find('select').find('option:first').attr('style', style);
      $(this).find('select').change(function () { // When a select changes
        if ($(this).hasClass('biblefield-book-input')) { // Book has changing
          BibleField.loadChapters($(this));
        }
        if ($(this).hasClass('biblefield-chapter-start-input')) { // Beginning chapter is changing
          $end = $(this).parents('tr').find('.biblefield-chapter-end-input');
          if (Number($end.val()) < Number($(this).val())) {
            $end.val($(this).val());
          }
        }
        $table.find('select').find('option:first').attr('style', style);
      });
    });
    
    $('.views-exposed-widgets').find('.bible_field_book_filter:not(.bible_field_book_filter_processed)').each(function() {
      $(this).addClass('bible_field_book_filter_processed');
      BibleField.loadChaptersViewsWidget($(this));
      // When the book search filter changes
      $(this).change(function () {
        BibleField.loadChaptersViewsWidget($(this));
      });
    });
  }) (jQuery);
}

/**
 * Loads the number of chapters in the chapter input(s) to match the book
 */
BibleField.loadChapters = function ($element) {
  var chapters = $element.parents('table').find('input[name="' + $element.val() + '"]:first').val();
  var end_val = $element.parents('tr').find('.biblefield-chapter-end-input').val();
  var start_val = $element.parents('tr').find('.biblefield-chapter-start-input').val();
  var options = '';
  for (i=1; i<chapters; i++) {
    options += '<option value="' + i + '">' + i + '</option>';
  }
  options = '<option value="0" class="form-option-disabled">' + Drupal.t('Chapter') + '</option>' + options;
  $element.parents('tr').find('.biblefield-chapter-end-input').html(options).val(end_val);
  $element.parents('tr').find('.biblefield-chapter-start-input').html(options).val(start_val);
  $element.parents('.views-exposed-form').find('.bible_field_chapter_range_start_filter').html(options).val(start_val);
  $element.parents('.views-exposed-form').find('.bible_field_chapter_range_end_filter').html(options).val(end_val);
}

/**
 * Loads the number of chapters in the chapter input(s) to match the book, but for a Views filter
 */
BibleField.loadChaptersViewsWidget = function ($element) {
  var chapters = $element.parents('.views-exposed-form').find('input[name="' + $element.val() + '"]:first').val();
  var start_val = $element.parents('.views-exposed-form').find('.bible_field_chapter_range_start_filter').val();
  var end_val = $element.parents('.views-exposed-form').find('.bible_field_chapter_range_end_filter').val();
  
  var first_chapter_element = $element.parents('.views-exposed-form').find('.bible_field_chapter_range_start_filter').find('option:first').wrap('<div></div>').parent().html();
  if (first_chapter_element == null) {
    var first_chapter_element = $element.parents('.views-exposed-form').find('.bible_field_chapter_range_end_filter').find('option:first').wrap('<div></div>').parent().html();
  }
  var options = '';
  for (i=1; i<chapters; i++) {
    options += '<option value="' + i + '">' + i + '</option>';
  }
  options = first_chapter_element + options;
  $element.parents('.views-exposed-form').find('.bible_field_chapter_range_start_filter').html(options).val(start_val);
  $element.parents('.views-exposed-form').find('.bible_field_chapter_range_end_filter').html(options).val(end_val);
}