<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service as Service;
use App\Helpers\Datatable\SSP;
use App\Helpers\Common;
use Validator;
use File;

class ServicesController extends Controller {

    /**
     * Service Model
     * @var Service
     */
    protected $service;
    protected $pageLimit;

    /**
     * Inject the models.
     * @param Service $service
     */
    public function __construct(Service $service) {
        $this->service = $service;
        $this->pageLimit = config('settings.pageLimit');
    }

    /**
     * Display a listing of services
     *
     * @return Response
     */
    public function index() {

        // Grab all the services
        $services = Service::paginate($this->pageLimit);

        // Show the service
        return view('admin/servicesList', compact('services'));
    }

    /**
     * Show the form for creating a new service
     *
     * @return Response
     */
    public function create() {
        return view('admin.services');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = array(
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $service = Service::create($data);
        $lastInsertId = $service->id;
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = $lastInsertId . '.' . $ext;
                $targetPath = SERVICE_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $service->image = $filename;
            $service->save();
        }
        return redirect()->route('services.index')->with('success_message', 'Service added successfully!');
    }

    /**
     * Display the specified service.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $service = Service::findOrFail($id);

        return view('admin.services.serviceDetail', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $service = Service::find($id);
        
        if ($service) {
            return view('admin/services', compact('service'));
        } else {
            return redirect('admin/services')->with('error_message', 'Invalid service id');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = array(
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $service = Service::findOrFail($id);
        $data = $request->all();
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                
                $oldFile = SERVICE_IMAGE_PATH.$service->image;
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
                
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = $id . '.' . $ext;
                $targetPath = SERVICE_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);

            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['image'] = $filename;
        }else{
            $data['image'] = $service->image;
        }
        $service->update($data);
        
        return redirect()->route('services.index')->with('success_message', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $service = Service::findOrFail($id);
        $oldFile = SERVICE_IMAGE_PATH.$service->image;
        if (File::exists($oldFile)) {
            File::delete($oldFile);
        }
        Service::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Service deleted successfully!';
        echo json_encode($array);
    }

    public function changeServiceStatus(Request $request) {
        $data = $request->all();

        $service = Service::find($data['id']);
        
        if ($service->status) {
            $service->status = '0';
        } else {
            $service->status = '1';
        }
        $service->save();

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getServicesData() {

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
        $table = 'services';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'title', 'dt' => 0, 'field' => 'title'),
            array('db' => 'description', 'dt' => 1, 'formatter' => function($d, $row) {
                    return Common::shorteningString($d, 100);
                }, 'field' => 'description'),
            array('db' => 'image', 'dt' => 2, 'formatter' => function($d, $row) {
                    if($d){
                        return '<img src="' . SERVICE_IMAGE_ROOT . $d . '" width="200">';
                    }else{
                        return '<img src="' . SERVICE_IMAGE_ROOT . 'default.png" width="200">';
                    }
                }, 'field' => 'image'),
            array('db' => 'status', 'dt' => 3, 'formatter' => function( $d, $row ) {
                    if ($row['status']) {
                        return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '">Active</a>';
                    } else {
                        return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '">Inactive</a>';
                    }
                }, 'field' => 'status'),
            array('db' => 'id', 'dt' => 4, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="services/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
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
