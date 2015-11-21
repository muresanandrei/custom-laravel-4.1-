<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:26 AM
 */


/*
 * Website frontend routes
 */

//Change language
Route::get('lang/{lang}',function($lang)
{
	$l = new \SystemTools\WebsiteLanguage();

	$l->set_language($lang);

	return Redirect::back();

});

//Home
Route::get('home', 'CoreApp\Website\Controllers\Frontend\Home@index');

//Default
Route::get('/','CoreApp\Website\Controllers\Frontend\Home@index');

//Portfolio
Route::get('work', 'CoreApp\Website\Controllers\Frontend\Work@index');

//All journal posts
Route::get('journal', 'CoreApp\Website\Controllers\Frontend\Journal@index');

//Single journal
Route::get('journal/{journal_id}/{post_url}','CoreApp\Website\Controllers\Frontend\Journal@single_journal');

//journal Search
Route::post('journal-search','CoreApp\Website\Controllers\Frontend\Journal@journal_search');

//journal category
Route::get('journal/category/{category_id}/{category_url}','CoreApp\Website\Controllers\Frontend\Journal@journals_by_category_id');

//Journal tag
Route::get('journal/tag/{tag_id}/{tag_url}','CoreApp\Website\Controllers\Frontend\Journal@journals_by_tag_id');

//Journal Archive
Route::get('journal/archive/{month}/{year}','CoreApp\Website\Controllers\Frontend\Journal@archived_journals');

//About
Route::get('company', 'CoreApp\Website\Controllers\Frontend\Company@index');

//Contact
Route::get('contact', 'CoreApp\Website\Controllers\Frontend\Contact@index');

Route::post('contact','CoreApp\Website\Controllers\Frontend\Contact@process_contact');


/*
 * Movie Routes
 */
Route::get('watch/{movie_id}/{movie_url}','CoreApp\Website\Controllers\Frontend\Movie@single_movie');

Route::post('movie/{movie_id}/spank','CoreApp\Website\Controllers\Frontend\Movie@spank');

Route::post('movie/{movie_id}/comment','CoreApp\Website\Controllers\Frontend\Movie@comment');

Route::get('movie/category/{cat_id}/{cat_url}','CoreApp\Website\Controllers\Frontend\Movie@movies_by_category_id');

Route::get('movie/tag/{tag_id}/{tag_url}','CoreApp\Website\Controllers\Frontend\Movie@movies_by_tag_id');

Route::get('movies-search','CoreApp\Website\Controllers\Frontend\Movie@search');


Route::get('photo-category/{id}/{url}','CoreApp\Website\Controllers\Frontend\PhotoGallery@index');

/*
 * Admin Routes
 */
//Redactor image upload
Route::post('admin/redactor/image_upload','CoreApp\Website\Controllers\Admin\Redactor@image_upload');

//Journal
Route::get('admin/journal/create','CoreApp\Website\Controllers\Admin\JournalCreate@create');
Route::post('admin/journal/create','CoreApp\Website\Controllers\Admin\JournalCreate@process_create');

Route::get('admin/journal/{journal_id}/update','CoreApp\Website\Controllers\Admin\JournalUpdate@update');
Route::post('admin/journal/{journal_id}/update','CoreApp\Website\Controllers\Admin\JournalUpdate@process_update');

Route::get('admin/journal/all','CoreApp\Website\Controllers\Admin\JournalAll@all');

Route::get('admin/journal/{journal_id}/delete','CoreApp\Website\Controllers\Admin\JournalDelete@delete');

//Journal tags
Route::get('admin/journal/tag/create','CoreApp\Website\Controllers\Admin\JournalTag@create');
Route::post('admin/journal/tag/create','CoreApp\Website\Controllers\Admin\JournalTag@process_create');

Route::get('admin/journal/tag/{tag_id}/update','CoreApp\Website\Controllers\Admin\JournalTag@update');
Route::post('admin/journal/tag/{tag_id}/update','CoreApp\Website\Controllers\Admin\JournalTag@process_update');

Route::get('admin/journal/tags','CoreApp\Website\Controllers\Admin\JournalTag@all');

Route::get('admin/journal/tag/{tag_id}/delete','CoreApp\Website\Controllers\Admin\JournalTag@delete');

//Journal categories
Route::get('admin/journal/category/create','CoreApp\Website\Controllers\Admin\JournalCategory@create');
Route::post('admin/journal/category/create','CoreApp\Website\Controllers\Admin\JournalCategory@process_create');

Route::get('admin/journal/category/{category_id}/update','CoreApp\Website\Controllers\Admin\JournalCategory@update');
Route::post('admin/journal/category/{category_id}/update','CoreApp\Website\Controllers\Admin\JournalCategory@process_update');

Route::get('admin/journal/categories','CoreApp\Website\Controllers\Admin\JournalCategory@all');

Route::get('admin/journal/category/{category_id}/delete','CoreApp\Website\Controllers\Admin\JournalCategory@delete');


//Movie
Route::get('admin/movie/create','CoreApp\Website\Controllers\Admin\Movie\MovieCreate@create');
Route::post('admin/movie/create','CoreApp\Website\Controllers\Admin\Movie\MovieCreate@process_create');

Route::get('admin/movie/{movie_id}/update','CoreApp\Website\Controllers\Admin\Movie\MovieUpdate@update');
Route::post('admin/movie/{movie_id}/update','CoreApp\Website\Controllers\Admin\Movie\MovieUpdate@process_update');

Route::get('admin/movie/{movie_id}/photos','CoreApp\Website\Controllers\Admin\Movie\MovieUpdate@images');

Route::get('admin/movie/all','CoreApp\Website\Controllers\Admin\Movie\MovieAll@all');

Route::get('admin/movie/{movie_id}/delete','CoreApp\Website\Controllers\Admin\Movie\MovieDelete@delete');

//Movie tags
Route::get('admin/movie/tag/create','CoreApp\Website\Controllers\Admin\Movie\MovieTag@create');
Route::post('admin/movie/tag/create','CoreApp\Website\Controllers\Admin\Movie\MovieTag@process_create');

Route::get('admin/movie/tag/{tag_id}/update','CoreApp\Website\Controllers\Admin\Movie\MovieTag@update');
Route::post('admin/movie/tag/{tag_id}/update','CoreApp\Website\Controllers\Admin\Movie\MovieTag@process_update');

Route::get('admin/movie/tags','CoreApp\Website\Controllers\Admin\Movie\MovieTag@all');

Route::get('admin/movie/tag/{tag_id}/delete','CoreApp\Website\Controllers\Admin\Movie\MovieTag@delete');

//Movie categories
Route::get('admin/movie/category/create','CoreApp\Website\Controllers\Admin\Movie\MovieCategory@create');
Route::post('admin/movie/category/create','CoreApp\Website\Controllers\Admin\Movie\MovieCategory@process_create');

Route::get('admin/movie/category/{category_id}/update','CoreApp\Website\Controllers\Admin\Movie\MovieCategory@update');
Route::post('admin/movie/category/{category_id}/update','CoreApp\Website\Controllers\Admin\Movie\MovieCategory@process_update');

Route::get('admin/movie/categories','CoreApp\Website\Controllers\Admin\Movie\MovieCategory@all');

Route::get('admin/movie/category/{category_id}/delete','CoreApp\Website\Controllers\Admin\Movie\MovieCategory@delete');


//Movie dropzone
Route::post('movie_dropzone/{movie_id}','CoreApp\Website\Controllers\Admin\Movie\MovieCreate@thumbnails');

//Delete movie dropzone pictures
Route::post('movie_dropzone/delete/{movie_id}','CoreApp\Website\Controllers\Admin\Movie\MovieDropzoneDelete@movie_thumbnails');

//Movie comments
Route::get('admin/movie/comments','CoreApp\Website\Controllers\Admin\Movie\MovieComments@comments');
Route::post('admin/movie/comment/{comment_id}/approve','CoreApp\Website\Controllers\Admin\Movie\MovieComments@approve');
Route::post('admin/movie/comment/{comment_id}/disable','CoreApp\Website\Controllers\Admin\Movie\MovieComments@disable');

Route::get('admin/movie/comment/{comment_id}/delete','CoreApp\Website\Controllers\Admin\Movie\MovieComments@delete');

//Photo gallery
Route::get('admin/photo/create','CoreApp\Website\Controllers\Admin\Photo\Create@create');
Route::post('admin/photo/category/create','CoreApp\Website\Controllers\Admin\Photo\Create@process_photos_category_id');
Route::post('admin/photos/{cat_id}/create','CoreApp\Website\Controllers\Admin\Photo\Create@process_photos');

Route::get('admin/photo/category/{cat_id}/update','CoreApp\Website\Controllers\Admin\Photo\Update@update');
Route::get('admin/photo/category/{cat_id}/photos','CoreApp\Website\Controllers\Admin\Photo\Update@images');

Route::get('admin/movie/{movie_id}/photos','CoreApp\Website\Controllers\Admin\Movie\MovieUpdate@images');

Route::get('admin/photos/all/categories','CoreApp\Website\Controllers\Admin\Photo\All@all');

//Delete photos
Route::post('admin/photos/delete/{cat_id}','CoreApp\Website\Controllers\Admin\Photo\Delete@delete');

//Delete photo category
Route::get('admin/photo/category/{cat_id}/delete','CoreApp\Website\Controllers\Admin\Photo\Delete@delete_photo_category');

//Meta
Route::get('admin/meta_pages/all','CoreApp\Website\Controllers\Admin\MetaPages@all');

Route::get('admin/meta_page/{page_id}/update','CoreApp\Website\Controllers\Admin\MetaPages@update');

Route::post('admin/meta_page/{page_id}/update','CoreApp\Website\Controllers\Admin\MetaPages@process_update');