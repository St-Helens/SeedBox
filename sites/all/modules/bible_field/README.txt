
### Bible Field

Bible Field is sponsored by Calvary Chapel (http://www.ccboise.org/) and
written by Chris Shattuck (http://drupal.org/user/166383). A live version
of this README file can be found at 


### Introduction

The idea behind the Bible Field module is to provide a CCK field that can
reference a body of work by book, chapter and verse. Below are some
features:

* The ability to reference a range or single point
* A special Views 'range filter' that allows for search within a ranged
entry (like chapters 2 to 10)
* A compound Views filter that allows you to specify the granularity of the
filter to book, chapter or verse
* Books are pulled from a CVS file, so you can reference arbitrary bodies
of work (not just Bibles)
* Chapter selectors are automatically adjusted to the number of chapters in
the currently selected book


### Installation

See http://drupal.org/getting-started/install-contrib for instructions on
how to install or update Drupal modules.


### Usage

The Bible Field module adds two features: a new CCK field type, and
additional filters for views. For a guide with screenshots, see
http://chrisshattuck.com/node/119.

To add the CCK field:

1. Click the "Manage Fields" link next to your content type in
/admin/content/types and scroll down to the bottom. 
2. Select the "Bible reference" type and fill in the rest of the form.
3. Next, choose your settings. There are two settings specific to Bible
Field, the Version and the alphabetical sorting. If set to sort
alphabetically, any book fields will be sorted from 1-9 and A-Z, otherwise
the sorting will follow the default, which is likely the real order.

Now, you can add references in that node type.

To add a chapter range filter:

1. Click the plus button next to the Filters section of a view to add a new
filter, and select the Content category. 
2. Scroll down until you see the fields ending in "Ending chapter" or
"Starting chapter"check the 'Ending chapter' or 'Starting chapter'.
3. Click the Add button.
4. Under the 'Operator' select field, select 'Within start and end range'.
5. Optionally, expose the filter

This will add a select input with a chapter select input. Searching for a
particular chapter will allow you to search for nodes that match a
particular chapter range. For example, if I have a node that references
Genesis chapter 5-12, and I filter for chapter 7, it will be a match.

If you add a filter for the book as well, the numbers in the chapter select
input will be auto-loaded with each change to match the number of chapters
in the book.

To add a granular filter (filter by book, by book and chapter or by
book,chapter and verse)

1. Click the plus button next to the Filters section of a view to add a new
filter, and select the Content category. 
2. Scroll down until you see the "Bible field composite" option.

3. Select this and click the Add button.
4. Select the granularity (book, chapter or verse)
5. Expose the filter

This filter is like a ranged search for chapter and verse with the book
filter as well.


### To add other books or bibles

Bible Field doesn't work for just bibles - it can function to reference any
body of work, and even co-releate references across multiple works. You can
have multiple reference fields in the same content type that reference
different bodies of work.

To add a new reference list, you can look in the module directory under
/optional_csv/hitchhikers_guide_to_the_galaxy.txt. In this file, you can
see the structure required to feed Bible Field the correct information. On
each new line there is the name of the book, a comma, and the number of
chapters in the book.

If you copy this file over to bible_csv, you will see a new option when you
add a CCK field for referencing the Hitchhiker's Guide to the Galaxy. Using
this as an example, you can add any body of work you'd like.
