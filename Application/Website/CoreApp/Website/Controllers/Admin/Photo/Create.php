<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Photo;

use \View, \App,\Input,\Response;

class Create extends \BaseControllers\Webrising {


    public function create()
    {


        //Photos model
        $photos_categories_model = App::make('WebsitePhotosCategoriesModel');
        
        $data = array(
            'page_title'  => trans('common.photo'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                'admin/photo/all'   => trans('common.photos'),
                '!'                 => trans('common.create')
            ),

            'photos_categories'     => $photos_categories_model->all()
        );



        return View::make('CoreApp/Website/Views/Backend/Photo/create',$data);

    }//create


    public function process_photos_category_id()
    {

        $category_id = (int)Input::get('category',1);

        \Session::flash('category_id',$category_id);

        return \Redirect::to('admin/photo/create');

    }//process_photos_category_id


    public function process_photos($category_id)
    {

        //Images
        $file = Input::file('images');
        
        if($file) {

        foreach($file as $f)
        {
            //Image name
            $imageName = $f->getClientOriginalName();


            $f->move('photo_gallery/'.$category_id, '/'.$imageName);

            \Image::make('photo_gallery/'.$category_id.'/'.$imageName)->resize(500, 367,false)->save('photo_gallery/'.$category_id.'/'.$imageName);

        }//foreach file

 
            return Response::json(['success' => true ]);
        }//return sucess 
        else {
            return Response::json('error', 400);

        }//else return error


    }//process create

    
}//end Photo