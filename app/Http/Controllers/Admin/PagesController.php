<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page as Page;
use App\Helpers\Datatable\SSP;
use App\Helpers\Common;
use Validator;
use Illuminate\Support\Str;

class PagesController extends Controller {

    /**
     * Page Model
     * @var Page
     */
    protected $page;
    protected $pageLimit;

    /**
     * Inject the models.
     * @param Page $page
     */
    public function __construct(Page $page) {
        $this->page = $page;
        $this->pageLimit = config('settings.pageLimit');
    }

    /**
     * Display a listing of pages
     *
     * @return Response
     */
    public function index() {

        // Grab all the pages
        $pages = Page::paginate($this->pageLimit);

        // Show the page
        return view('admin/pagesList', compact('pages'));
    }

    /**
     * Show the form for creating a new page
     *
     * @return Response
     */
    public function create() {
        return view('admin.pages');
    }

    /**
     * Store a newly created page in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        $rules = array(
            'slug' => 'required|unique:pages',
            'title' => 'required'
        );
        $messages = array(
            'slug.unique' => 'Page already exist please enter different title.'
        );
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        //dd($data);

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $page = Page::create($data);

        return redirect()->route('pages.index')->with('success_message', 'Page added successfully!');
    }

    /**
     * Display the specified page.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $page = Page::find($id);
        //$page = $page->toArray();
        if ($page) {
            return view('admin/pages', compact('page'));
        } else {
            return redirect('admin/pages')->with('error_message', 'Invalid page id');
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
            'slug' => 'required|unique:pages,slug,' . $id,
            'title' => 'required'
        );

        $messages = array(
            'slug.unique' => 'Page already exist please enter different title.'
        );

        $page = Page::findOrFail($id);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $page->update($data);

        return redirect()->route('pages.index')->with('success_message', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        Page::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Page deleted successfully!';
        echo json_encode($array);
    }

    public function changePageStatus(Request $request) {
        $data = $request->all();

        $page = Page::find($data['id']);
        //$page = $page->toArray();
        if ($page->status) {
            $page->status = '0';
        } else {
            $page->status = '1';
        }
        $page->save();

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getPagesData() {

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
        $table = 'pages';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'title', 'dt' => 0, 'field' => 'title'),
            array('db' => 'slug', 'dt' => 1, 'field' => 'slug'),
            array('db' => 'content', 'dt' => 2, 'formatter' => function($d, $row) {
                    return Common::shorteningString($d, 100);
                }, 'field' => 'content'),
            array('db' => 'status', 'dt' => 3, 'formatter' => function( $d, $row ) {
                    if ($row['status']) {
                        return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '">Active</a>';
                    } else {
                        return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '">Inactive</a>';
                    }
                }, 'field' => 'status'),
            array('db' => 'id', 'dt' => 4, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="pages/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
                    $operation .= '<a href="javascript:;" id="' . $d . '" class="btn btn-danger delete-btn" title="Delete" data-toggle="tooltip"><i class="fa fa-times"></i></a>&nbsp;';
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
