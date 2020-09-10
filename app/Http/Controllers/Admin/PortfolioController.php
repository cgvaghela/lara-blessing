<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Portfolio as Portfolio;
use App\Category as Category;
use App\Helpers\Datatable\SSP;
use App\Helpers\Common;
use Validator;
use File;

class PortfolioController extends Controller {

    /**
     * Portfolio Model
     * @var Portfolio
     */
    protected $portfolio;
    protected $pageLimit;
    protected $categoryList;
    /**
     * Inject the models.
     * @param Portfolio $portfolio
     */
    public function __construct(Portfolio $portfolio) {
        $this->portfolio = $portfolio;
        $this->pageLimit = config('settings.pageLimit');
        $this->categoryList = ['' => 'Select Category'] + Category::active()->pluck('name', 'id')->all();
    }

    /**
     * Display a listing of portfolio
     *
     * @return Response
     */
    public function index() {

        // Grab all the portfolio
        $portfolio = Portfolio::paginate($this->pageLimit);

        // Show the portfolio
        return view('admin/portfolioList', compact('portfolio'));
    }

    /**
     * Show the form for creating a new portfolio
     *
     * @return Response
     */
    public function create() {
        $categoryList =  $this->categoryList;
        return view('admin.portfolio',  compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = array(
            'category_id' => 'required',
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $data = $request->all();
        $data['link'] = $data['link'] != "" ? Common::addScheme($data['link']) : "";
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $portfolio = Portfolio::create($data);
        $lastInsertId = $portfolio->id;
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = $lastInsertId . '.' . $ext;
                $targetPath = PORTFOLIO_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $portfolio->image = $filename;
            $portfolio->save();
        }
        return redirect()->route('portfolio.index')->with('success_message', 'Portfolio added successfully!');
    }

    /**
     * Display the specified portfolio.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.portfolioDetail', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified portfolio.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $categoryList =  $this->categoryList;
        $portfolio = Portfolio::find($id);
        //$portfolio = $portfolio->toArray();
        if ($portfolio) {
            return view('admin/portfolio', compact('portfolio','categoryList'));
        } else {
            return redirect('admin/portfolio')->with('error_message', 'Invalid portfolio id');
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
            'category_id' => 'required',
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $portfolio = Portfolio::findOrFail($id);
        
        $data = $request->all();
        $data['link'] = $data['link'] != "" ? Common::addScheme($data['link']) : "";
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                
                $oldFile = PORTFOLIO_IMAGE_PATH.$portfolio->image;
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
                
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = $id . '.' . $ext;
                $targetPath = PORTFOLIO_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);

            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['image'] = $filename;
        }else{
            $data['image'] = $portfolio->image;
        }
        $portfolio->update($data);
        
        return redirect()->route('portfolio.index')->with('success_message', 'Portfolio updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $portfolio = Portfolio::findOrFail($id);
        $oldFile = PORTFOLIO_IMAGE_PATH.$portfolio->image;
        if (File::exists($oldFile)) {
            File::delete($oldFile);
        }
        Portfolio::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Portfolio deleted successfully!';
        echo json_encode($array);
    }

    public function changePortfolioStatus(Request $request) {
        $data = $request->all();

        $portfolio = Portfolio::find($data['id']);
        
        if ($portfolio->status) {
            $portfolio->status = '0';
        } else {
            $portfolio->status = '1';
        }
        $portfolio->save();

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getPortfolioData() {

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
        $table = 'portfolio';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'c.name', 'dt' => 0, 'field' => 'name'),
            array('db' => 'title', 'dt' => 1, 'field' => 'title'),
            array('db' => 'description', 'dt' => 2, 'formatter' => function($d, $row) {
                    return Common::shorteningString($d, 100);
                }, 'field' => 'description'),
            array('db' => 'image', 'dt' => 3, 'formatter' => function($d, $row) {
                    if($d){
                        return '<img src="' . PORTFOLIO_IMAGE_ROOT . $d . '" width="200">';
                    }else{
                        return '<img src="' . PORTFOLIO_IMAGE_ROOT . 'default.png" width="200">';
                    }
                }, 'field' => 'image'),
            array('db' => 'portfolio.status', 'dt' => 4, 'formatter' => function( $d, $row ) {
                    if ($row['status']) {
                        return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '">Active</a>';
                    } else {
                        return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '">Inactive</a>';
                    }
                }, 'field' => 'status'),
            array('db' =>  'portfolio.id', 'dt' => 5, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="portfolio/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
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


        $joinQuery = "LEFT JOIN portfolio_categories AS c ON c.id = portfolio.category_id ";
        $extraWhere = "";
        $groupBy = "";

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy)
        );
    }

}
