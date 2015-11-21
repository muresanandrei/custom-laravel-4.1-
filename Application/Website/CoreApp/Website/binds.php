<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:25 AM
 */

/*
 * Journal
 */
App::bind('WebsiteJournalModel', 'CoreApp\Website\Models\WebsiteJournal');


/*
 * Journal Categories
 */
App::bind('WebsiteJournalCategoryModel', 'CoreApp\Website\Models\JournalCategory');


/*
 * Journal Post Category
 */
App::bind('WebsiteJournalPostCategoryModel','CoreApp\Website\Models\JournalPostCategory');


/*
 * Journal tags
 */
App::bind('WebsiteJournalTagModel','CoreApp\Website\Models\JournalTag');


/*
 * Journal post tags
 */
App::bind('WebsiteJournalPostTagModel','CoreApp\Website\Models\JournalPostTag');


/*
 * Meta Pages
 */
App::bind('WebsiteMetaPagesModel', 'CoreApp\Website\Models\MetaPages');

/*
 * Movies
 */
App::bind('WebsiteMoviesModel', 'CoreApp\Website\Models\Movie\Movies');


/*
 * Movie category 
 */
App::bind('WebsiteMovieCategoryModel','CoreApp\Website\Models\Movie\MovieCategory');

/*
 * Movie categories
 */
App::bind('WebsiteMovieCategoriesModel','CoreApp\Website\Models\Movie\MovieCategories');

/*
 * Movie tag
 */
App::bind('WebsiteMovieTagModel','CoreApp\Website\Models\Movie\MovieTag');

 /*
 * Movie tags
 */
 App::bind('WebsiteMovieTagsModel','CoreApp\Website\Models\Movie\MovieTags');

 /*
  * User ip
  */
 App::bind('UserIpModel','CoreApp\Website\Models\UserIp');

 /*
  * User ip for spanks
  */
 App::bind('UserIpSpankModel','CoreApp\Website\Models\UserIpSpank');

 /*
  * Movie comments
  */
 App::bind('MovieCommentsModel','CoreApp\Website\Models\Movie\MovieComments');

 /*
  * Photo gallery
  */
 App::bind('WebsitePhotosCategoriesModel','CoreApp\Website\Models\Photo\Photos');