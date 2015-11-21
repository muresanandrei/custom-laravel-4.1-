<?php

include 'Html_dom.php';

include 'words_helper.php';
       
class SpankWire extends \Controller {

        $url = "http://www.spankwire.com/categories/Straight/Amateur/Submitted/16";

            // $url = 'http://www.tube8.com/newest.html';
           
        $html = file_get_html($url);   
                
        //gets all movie links
        $movies = $html->find('div[class=thmb-wrapper] a');

        // $movies = $html->find('div[class=box-thumbnail] a');
        //it's a big object so we clear the memory 
        unset ($html);

                                //here we will have movie links as key and link to images(thumbs) as value
                                $movies_list = array();

                                //foreach link
                                foreach( $movies as $m ){

                                                //image is in a
                                                $image_content = str_get_html($m->innertext);

                                                //just to filter
                                                $image = $image_content->find('img');

                                                //it's a single image but I couldn't access it without a foreach
                                                //UPDATE Found how to access, find() needed a second parameter: 0
                                                foreach ( $image as $i ){
                                                                 
                                                                // if( substr($m->href, 0, 4) == 'http' && substr($i->src, 0, 4) == 'http')
                                                                // {
                                                                //       $movies_list[$m->href] = $i->src;     
                                                                // }//
                                                      
                                                                                 $p = 'src';
                                                                                 $movies_list['http://www.spankwire.com'.$m->href] = $i->$p;
                                                                    
                                                    
                                                }//foreach image
                                             
                                                //clear some memory
                                                unset ($movies);
                                                unset ($image_content);
                                                unset ($image);
                                                
                                }//foreach link
         
                               // echo '<pre>';
                               // print_r($movies_list);exit;
                               // echo '</pre>';

                      // foreach($movies_list as $m)       
                      // {   
                      //     echo '<img src="'.$m.'"/>';  

                      // }
                      // die();
/************************************************************
 * 
 * NOW LETS GET EACH MOVIE
 * 
 */
   foreach( $movies_list as $movie => $thumb ){
       
    /**#########################################################
     * 
     * FIRST WE TAKE THE MOVIE DATA
     *
     #########################################################*/       
      
       $movie_page = file_get_html($movie);
            
       /*********************************
        * EMBED CODE
        *********************************/
       $embed_code = $movie_page->find('textarea[id=embedTextarea]', 0)->innertext;

       //let's remove additional links
       // $embed_code = strstr($embed_code, '</iframe>', TRUE) . '</iframe>';


       //name
       $name = trim( strip_tags( $movie_page->find('div[class=header-bar] h1', 0)->innertext ) );
  
       /*********************************
        * GET TAGS
        *********************************/
      
       //tags
       $tags   = $movie_page->find('div[class=video-info-tags]', 0);
 

       $tags = str_get_html( $tags->innertext );

      
       $tags = $tags->find('a');
       
       $tags_list = array();
        
       foreach( $tags as $t ){
           
                       $tags_list[] = $t->innertext;
           
       }//foreach tags

        
       /*********************************
        * GET DESCRIPTION
        *********************************/
       
   
       $description = strip_tags( $movie_page->find('div[id=descriptionContent]',0)->innertext );
       
       $description = trim( $description );
       

        /*********************************
        * GET DURATION
        *********************************/
       
       // $time            = explode(' ', strip_tags( $video_info_1->children(2)->innertext ) );
       
       // $time            = $time[1];
       
      
       //  print_r($time);exit;
       
        /*********************************
        * GET CATEGORIES
        *********************************/
       
      //tags, description, duration
       $video_info_2      = $movie_page->find('div[class=video-info-uploaded]', 0);
       
       $cat = str_get_html( $video_info_2->innertext );

       $cat = $cat->find('a');
       
       $cat_list = array();
       
       foreach( $cat as $c ){
           
                       $cat_list[] = $c->innertext;
           
       }//foreach category
       
    /**#########################################################
     * 
     * END GETTING MOVIE DATA
     *
     #########################################################*/       

              #         #           #
      ### ## #  #### ##
              #        #           #   
       
    /**#########################################################
     * 
     * NOW ADD MOVIE TO DB
     *
     #########################################################*/       
       
       $month = rand(1, 12);
       
       $day       = rand(1, 28);
       
       $date_added = date("Y-$month-$day");
       
       $data = array(
                                'embed'            => $embed_code,
                                'name'             => convert_description($name),
                                'description'      => convert_description($description),
                                'time'             => '7:30',
                                'plus'             => rand(1234, 7355),
                                'minus'            => 0,
                                'site'             => 2,
                                'views'            => rand(3412, 56022),
                                'date'             => $date_added
        );

        //Insert movie get id
        if(!$id = \DB::table('movies')->insertGetId($data)) mail('muresanandrei.web@gmail.com', 'Pula',$id);
       
        $movie_id = $id;
       
       die($movie_id);

       /************************************
        * ADD TO CATEGORIES TABLE
        */
       
       foreach( $cat_list as $c  ){
                      
                      //check if we have the category  
                      $category_obj = new Movie_Category();

                      $category = $category_obj->where(array('name','like',ucfirst('%$c%')))->take(1)->get();

                      die($category);

                      if( count( $category ) == 1 ){
                          
                                          $cat_db_data = array(
                                                                                  'movie_id'    => $movie_id,
                                                                                  'cat_id'      => $category->cat_id  
                                           );//$cat_db_data

                                          $this->db->insert('movie_categories', $cat_db_data); 
                                      
                      }//if we have the category
                       else{
                           
                                            /******************************************
                                             * We create a new category
                                             */
                                            $cat_db_data = array(
                                                                                  'name' => ucfirst($c)  
                                            );//$cat_db_data

                                            //add new category
                                            $this->db->insert('categories', $cat_db_data); 

                                            
                                            /**
                                             * AND WE INSERT THE IN movie_categories
                                             */
                                            
                                            //new category id 
                                            $new_cat_id = $this->db->insert_id();
                                            
                                            $cat_db_data2 = array(
                                                                                      'movie_id' => $movie_id,
                                                                                      'cat_id'   => $new_cat_id
                                           );//$cat_db_data2
                                            
                                           $this->db->insert('movie_categories', $cat_db_data2);  
                                            
                       }//else: we don't have the category, we need to add it 
                      
                      
       }//foreach category
  
       
       
       
       /************************************
        * ADD TO TAGS TABLE
        */
       
       foreach( $tags_list as $t  ){
                     
                     //remove tags
                     $t = strip_tags( ucfirst($t) );
                     
                     //remove brackets and numbers 
                     $t = trim( strstr($t, '(', TRUE) );
           
                      //check if we have the tag  
                      $tag = $this->db->get_where('tags', array('name' => $t), 1)->row();  
           
                      if( count( $tag ) == 1 ){
                          
                                          $tag_db_data = array(
                                                                                  'tag_id'      => $tag->tag_id,
                                                                                  'movie_id' => $movie_id
                                           );//$tag_db_data

                                          $this->db->insert('movie_tags', $tag_db_data); 
                                      
                      }//if we have the tag
                       else{
                           
                                            /******************************************
                                             * We create a new tag
                                             */
                                            $tag_db_data = array(
                                                                                  'name' => ucfirst($t)  
                                            );//$cat_db_data

                                            //add new tag
                                            $this->db->insert('tags', $tag_db_data); 

                                            
                                            /**
                                             * AND WE INSERT THE IN movie_tags
                                             */
                                            
                                            //new tag id 
                                            $new_tag_id = $this->db->insert_id();
                                            
                                            $tag_db_data2 = array(
                                                                                      'tag_id'      => $new_tag_id,
                                                                                      'movie_id' => $movie_id
                                           );//$tag_db_data2
                                            
                                            $this->db->insert('movie_tags', $tag_db_data2); 
                                            
                       }//else: we don't have the tag, we need to add it 
                      
                      
       }//foreach tag
       
       /**######*######*######*######*######*######*######
        * 
        * NOW LETS STEAL THE IMAGES :D
        * 
        */
         $url = strstr($thumb, '190x143/', TRUE);
       
         $url_final = $url.'190x143/';
         
         
          mkdir('./images/movies/'.$movie_id);
         
          for( $i = 1; $i <= 10; $i++ ){
              
                           copy($url_final.$i.'.jpg', './images/movies/'.$movie_id.'/'.$i.'.jpg');
   
          }//steal 10 thumbs
          
          
          /**###**###**###**###**###**###**###**###**###**###**###**###**###
           * 
           * Now add some fake comments.... :D
           * 
           */
          
   }//foreach movie                              
                                
                                
                                // echo '<pre>';
                                // print_r($movies_list);
                                // echo '</pre>';                                
 }//end class