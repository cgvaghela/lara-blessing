<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category as Category;
use App\Helpers\Datatable\SSP;
use Validator;

class CategoryController extends Controller {

    /**
     * Category Model
     * @var Category
     */
    protected $category;
    protected $pageLimit;

    /**
     * Inject the models.
     * @param Category $category
     */
    public function __construct(Category $category) {
        //$this->getSettings();
        $this->category = $category;
        $this->pageLimit = config('settings.pageLimit');
    }

    /**
     * Display a listing of category
     *
     * @return Response
     */
    public function index() {

        // Grab all the category
        $categories = Category::paginate($this->pageLimit);

        // Show the page
        return view('admin/categoryList', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return Response
     */
    public function create() {
        return view('admin.category');
    }

    /**
     * Store a newly created category in storage.
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

        $category = Category::create($data);
        
        return redirect()->route('category.index')->with('success_message', 'Category added successfully!');
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $category = Category::find($id);
        
        if ($category) {
            return view('admin/category', compact('category'));
        } else {
            return redirect('admin/category')->with('error_message', 'Invalid category id');
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
            'name' => 'required|unique:portfolio_categories,name,'.$id,
        );
        $category = Category::findOrFail($id);

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category->update($data);

        return redirect()->route('category.index')->with('success_message', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        $category = Category::findOrFail($id);
        
        Category::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Category deleted successfully!';
        echo json_encode($array);
    }

    public function changeCategoryStatus(Request $request) {
        $data = $request->all();
        $category = Category::find($data['id']);
        
        if ($category->status) {
            $category->status = '0';
        } else {
            $category->status = '1';
        }
        $category->save();

        $array = array();
        $array['status'] = $category->status;
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getCategoryData() {
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
        $table = 'portfolio_categories';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'name', 'dt' => 0, 'field' => 'name'),
            array('db' => 'status', 'dt' => 1, 'formatter' => function( $d, $row ) {
                    if ($row['status']) {
                        return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '" title="click to inactive" data-toggle="tooltip">Active</a>';
                    } else {
                        return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '" title="click to active" data-toggle="tooltip">Inactive</a>';
                    }
                }, 'field' => 'status'),
            array('db' => 'id', 'dt' => 2, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="category/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
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
