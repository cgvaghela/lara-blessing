<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Metadata;
use App\Helpers\Datatable\SSP;
use App\Helpers\Common;
use Validator;
use Illuminate\Support\Str;

class MetadataController extends Controller
{
    
    /**
     * Inject the models.
     * @param Pages $pages
     */
    public function __construct() {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/metadataList');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.metadata');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'url' => 'required|unique:metadata',
            'title' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required'
        );
        $data = $request->all();
        
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $metadata = Metadata::create($data);
       
        $lastInsertId = $metadata->id;
        
        return redirect()->route('metadata.index')->with('success_message', 'Metadata added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metadata = Metadata::find($id);
        //$pages = $pages->toArray();
        if ($metadata) {
            return view('admin/metadata', compact('metadata'));
        } else {
            return redirect('admin/metadata')->with('error_message', 'Invalid Metadata id');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $rules = array(
            'url' => 'required|unique:metadata,url,'.$id,
            'title' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required'
        );
         
        $metadata = Metadata::findOrFail($id);
       
        $data = $request->all();
        
       
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $metadata->update($data);

        return redirect()->route('metadata.index')->with('success_message', 'Metadata updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Metadata::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Metadata deleted successfully!';
        echo json_encode($array);
    }
    
    public function getMetadataData() {
        
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
        $table = 'metadata';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'url', 'dt' => 0, 'field' => 'url'),
            array('db' => 'title', 'dt' => 1, 'field' => 'title'),
            array('db' => 'id', 'dt' => 2, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="metadata/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
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


        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */


        $joinQuery = NULL;
        $extraWhere = "";
        $groupBy = "";

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy)
        );
       
    }
}
