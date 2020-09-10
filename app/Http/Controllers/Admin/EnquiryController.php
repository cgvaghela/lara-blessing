<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Enquiry as Enquiry;
use App\Helpers\Datatable\SSP;
use App\Helpers\Common;

class EnquiryController extends Controller {

    /**
     * Enquiry Model
     * @var Enquiry
     */
    protected $enquiry;
    protected $pageLimit;

    /**
     * Inject the models.
     * @param Enquiry $enquiry
     */
    public function __construct(Enquiry $enquiry) {
        $this->enquiry = $enquiry;
        $this->pageLimit = config('settings.pageLimit');
    }

    /**
     * Display a listing of enquiry
     *
     * @return Response
     */
    public function index() {

        // Grab all the enquiry
        $enquiries = Enquiry::paginate($this->pageLimit);

        // Show the page
        return view('admin/enquiryList', compact('enquiries'));
    }

    /**
     * Display the specified enquiry.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $enquiry = Enquiry::findOrFail($id);
        return view('admin/enquiryDetails', compact('enquiry'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        $enquiry = Enquiry::findOrFail($id);
        
        Enquiry::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Enquiry deleted successfully!';
        echo json_encode($array);
    }

    public function changeEnquiryStatus(Request $request) {
        $data = $request->all();
        $enquiry = Enquiry::find($data['id']);
        
        if ($enquiry->status=='pending') {
            $enquiry->status = 'answered';
        } else {
            $enquiry->status = 'pending';
        }
        $enquiry->save();

        $array = array();
        $array['status'] = $enquiry->status;
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getEnquiryData() {
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
        $table = 'enquiries';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'fullname', 'dt' => 0, 'field' => 'fullname'),
            array('db' => 'email', 'dt' => 1, 'field' => 'email'),
            array('db' => 'subject', 'dt' => 2, 'formatter' => function($d, $row) {
                    return Common::shorteningString($d, 100);
                }, 'field' => 'subject'),
            array('db' => 'status', 'dt' => 3, 'formatter' => function( $d, $row ) {
                    if ($row['status']=='answered') {
                        return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '" title="click to pending" data-toggle="tooltip">Answered</a>';
                    } else {
                        return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '" title="click to answered" data-toggle="tooltip">Pending</a>';
                    }
                }, 'field' => 'status'),
            array('db' => 'id', 'dt' => 4, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="enquiry/' . $d . '" class="btn btn-primary" title="View" data-toggle="tooltip"><i class="fa fa-eye"></i></a>&nbsp;';
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
