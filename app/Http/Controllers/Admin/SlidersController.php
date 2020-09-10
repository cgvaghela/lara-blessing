<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Slider as Slider;
use App\Helpers\Datatable\SSP;
use Validator;
use File;

class SlidersController extends Controller {

    /**
     * Slider Model
     * @var Slider
     */
    protected $slider;

    /**
     * Inject the models.
     * @param Slider $slider
     */
    public function __construct(Slider $slider) {
        $this->slider = $slider;
    }

    /**
     * Display a listing of sliders
     *
     * @return Response
     */
    public function index() {

        // Grab all the sliders
        $sliders = Slider::all();

        // Show the page
        return view('admin/slidersList', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider
     *
     * @return Response
     */
    public function create() {
        return view('admin.sliders');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $rules = array(
            'imgPath' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $slider = Slider::create($data);
        $lastInsertId = $slider->id;
        $slider->link = $data['link'];

        if ($request->hasFile('imgPath')) {
            if ($request->file('imgPath')->isValid()) {
                $file = $request->file('imgPath');
                $ext = $file->getClientOriginalExtension();
                $filename = $lastInsertId . '.' . $ext;
                $targetPath = SLIDER_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $slider->imgPath = $filename;
            $slider->save();
        }
        return redirect()->route('sliders.index')->with('success_message', 'Slider added successfully!');
    }

    /**
     * Display the specified slider.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $slider = Slider::findOrFail($id);

        return view('admin.sliders.sliderDetail', compact('slider'));
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $slider = Slider::find($id);
        if ($slider) {
            return view('admin/sliders', compact('slider'));
        } else {
            return redirect('admin/sliders')->with('error_message', 'Invalid slider id');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {

        $rules = array(
            'imgPath' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $slider = Slider::findOrFail($id);
        
        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('imgPath')) {
            
            if ($request->file('imgPath')->isValid()) {
                
                $oldFile = SLIDER_IMAGE_PATH.$slider->imgPath;

                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
                
                $file = $request->file('imgPath');
                $ext = $file->getClientOriginalExtension();
                $filename = $id . '.' . $ext;
                $targetPath = SLIDER_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);

            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['imgPath'] = $filename;
            
        }else{
           $data['imgPath'] = $slider->imgPath;
        }
        $slider->link = $data['link'];
        $slider->update($data);
        
        return redirect()->route('sliders.index')->with('success_message', 'Slider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        $slider = Slider::findOrFail($id);
        
        $oldFile = SLIDER_IMAGE_PATH.$slider->image_name;

        if (File::exists($oldFile)) {
            File::delete($oldFile);
        }
        
        Slider::destroy($id);
        
        $array = array();
        $array['success'] = true;
        $array['message'] = 'Slider deleted successfully!';
        echo json_encode($array);
    }

    public function changeSliderStatus(Request $request) {
        $data = $request->all();

        $slider = Slider::find($data['id']);
        
        if ($slider->status) {
            $slider->status = '0';
        } else {
            $slider->status = '1';
        }
        $slider->save();

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getSlidersData() {
        /*
         * DataTables example server-side processing script.
         *
         * Please note that this script is intentionally extremely simply to show how
         * server-side processing can be implemented, and probably shouldn't be used as
         * the basis for a large complex system. It is suitable for simple use cases as
         * for learning.
         *
         * See http://datatables.net/usage/server-side for full details on the server-
         * side processing requirements of DataTables.
         *
         * @license MIT - http://datatables.net/license_mit
         */

        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        // DB table to use
        $table = 'sliders';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'image_name', 'dt' => 0, 'field' => 'image_name'),
            array('db' => 'link', 'dt' => 1, 'field' => 'link'),
            array('db' => 'imgPath', 'dt' => 2, 'formatter' => function($d, $row){
                    return '<img src="'.SLIDER_IMAGE_ROOT.$d.'" width="200">';
            }, 'field' => 'imgPath'),
            array('db' => 'status', 'dt' => 3, 'formatter' => function( $d, $row ) {
            if ($row['status']) {
                return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '">Active</a>';
            } else {
                return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '">Inactive</a>';
            }
        }, 'field' => 'status'),
            array('db' => 'id', 'dt' => 4, 'formatter' => function( $d, $row ) {
            $operation = '<a href="sliders/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
            $operation .='<a href="javascript:;" id="' . $d . '" class="btn btn-danger delete-btn" title="Delete" data-toggle="tooltip"><i class="fa fa-times"></i></a>&nbsp;';
            return $operation;
        }, 'field' => 'id')
        );

        // SQL server connection information
        $sql_details = array(
            'user' => config('database.connections.mysql.username'),
            'pass' => config('database.connections.mysql.password'),
            'db' => config('database.connections.mysql.database'),
            'host' => config('database.connections.mysql.host')
        );

        $joinQuery = NULL;
        $extraWhere = "";
        $groupBy = "";

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy)
        );
    }

}
