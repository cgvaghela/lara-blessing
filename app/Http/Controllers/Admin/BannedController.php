<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BannedIps as BannedIps;
use App\Helpers\Datatable\SSP;
use Validator;

class BannedController extends Controller {

    /**
     * BannedIps Model
     * @var BannedIps
     */
    protected $bannedIps;
    protected $pageLimit;

    /**
     * Inject the models.
     * @param BannedIps $bannedIps
     */
    public function __construct(BannedIps $bannedIps) {
        //$this->getSettings();
        $this->bannedIps = $bannedIps;
        $this->pageLimit = config('settings.pageLimit');
    }

    /**
     * Display a listing of BannedIps
     *
     * @return Response
     */
    public function index() {

        // Grab all the bannedIps
        $bannedIps = BannedIps::all();

        // Show the page
        return view('admin/bannedList', compact('bannedIps'));
    }

    /**
     * Show the form for creating a new requests
     *
     * @return Response
     */
    public function create() {
        return view('admin.requests');
    }

    /**
     * Store a newly created requests in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        $rules = array(
            'name' => 'required|unique:portfolio_categories',
        );
        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $requests = Requests::create($data);
        
        return redirect()->route('requests.index')->with('success_message', 'Requests added successfully!');
    }

    /**
     * Display the specified requests.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        $requests = BannedIps::findOrFail($id);
        
        BannedIps::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'IP deleted successfully!';
        echo json_encode($array);
    }

    public function changeBannedIpsStatus(Request $request) {
        $data = $request->all();
        $requests = BannedIps::find($data['id']);
        
        if ($requests->status) {
            $requests->status = '0';
        } else {
            $requests->status = '1';
        }
        $requests->save();

        $array = array();
        $array['status'] = $requests->status;
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getActiveData() {
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
        $table = 'requests';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'name', 'dt' => 0, 'field' => 'first_name'),
            array('db' => 'status', 'dt' => 1, 'formatter' => function( $d, $row ) {
                    if ($row['status']) {
                        return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '" title="click to inactive" data-toggle="tooltip">Active</a>';
                    } else {
                        return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '" title="click to active" data-toggle="tooltip">Inactive</a>';
                    }
                }, 'field' => 'status'),
            array('db' => 'id', 'dt' => 2, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="requests/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
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
        $extraWhere = "active = '1'";
        $groupBy = "";

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy)
        );
    }
}
