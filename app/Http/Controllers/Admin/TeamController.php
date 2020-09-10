<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team as Team;
use App\Helpers\Datatable\SSP;
use App\Helpers\Common;
use Validator;
use File;

class TeamController extends Controller {

    /**
     * Team Model
     * @var Team
     */
    protected $team;
    protected $pageLimit;

    /**
     * Inject the models.
     * @param Team $team
     */
    public function __construct(Team $team) {
        $this->team = $team;
        $this->pageLimit = config('settings.pageLimit');
    }

    /**
     * Display a listing of team
     *
     * @return Response
     */
    public function index() {

        // Grab all the team
        $team = Team::paginate($this->pageLimit);

        // Show the team
        return view('admin/teamList', compact('team'));
    }

    /**
     * Show the form for creating a new team
     *
     * @return Response
     */
    public function create() {
        return view('admin.team');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $data = $request->all();
        
        //add http/https to url
        $data['facebook'] = $data['facebook'] != "" ? Common::addScheme($data['facebook']) : "";
        $data['linkedin'] = $data['linkedin'] != "" ? Common::addScheme($data['linkedin']) : "";
        $data['twitter'] = $data['twitter'] != "" ? Common::addScheme($data['twitter']) : "";
        $data['googleplus'] = $data['googleplus'] != "" ? Common::addScheme($data['googleplus']) : "";
        $data['stackoverflow'] = $data['stackoverflow'] != "" ? Common::addScheme($data['stackoverflow']) : "";
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $team = Team::create($data);
        $lastInsertId = $team->id;
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = $lastInsertId . '.' . $ext;
                $targetPath = TEAM_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $team->image = $filename;
            $team->save();
        }
        return redirect()->route('team.index')->with('success_message', 'Team added successfully!');
    }

    /**
     * Display the specified team.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $team = Team::findOrFail($id);

        return view('admin.team.teamDetail', compact('team'));
    }

    /**
     * Show the form for editing the specified team.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $team = Team::find($id);
        
        if ($team) {
            return view('admin/team', compact('team'));
        } else {
            return redirect('admin/team')->with('error_message', 'Invalid team id');
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
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp|max:3072'
        );
        $team = Team::findOrFail($id);
        $data = $request->all();
        
        //add http/https to url
        $data['facebook'] = $data['facebook'] != "" ? Common::addScheme($data['facebook']) : "";
        $data['linkedin'] = $data['linkedin'] != "" ? Common::addScheme($data['linkedin']) : "";
        $data['twitter'] = $data['twitter'] != "" ? Common::addScheme($data['twitter']) : "";
        $data['googleplus'] = $data['googleplus'] != "" ? Common::addScheme($data['googleplus']) : "";
        $data['stackoverflow'] = $data['stackoverflow'] != "" ? Common::addScheme($data['stackoverflow']) : "";
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {

                $oldFile = TEAM_IMAGE_PATH . $team->image;
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }

                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = $id . '.' . $ext;
                $targetPath = TEAM_IMAGE_PATH;
                $imagelocation = $file->move($targetPath, $filename);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['image'] = $filename;
        }else{
            $data['image'] = $team->image;
        }
        $team->update($data);

        return redirect()->route('team.index')->with('success_message', 'Team updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $team = Team::findOrFail($id);
        $oldFile = TEAM_IMAGE_PATH . $team->image;
        if (File::exists($oldFile)) {
            File::delete($oldFile);
        }
        Team::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Team deleted successfully!';
        echo json_encode($array);
    }

    public function changeTeamStatus(Request $request) {
        $data = $request->all();

        $team = Team::find($data['id']);
        
        if ($team->status) {
            $team->status = '0';
        } else {
            $team->status = '1';
        }
        $team->save();

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Status changed successfully!';
        echo json_encode($array);
    }

    public function getTeamData() {

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
        $table = 'team';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'firstname', 'dt' => 0, 'formatter' => function($d, $row) {
                    return $row['firstname'] . ' ' . $row['lastname'];
                }, 'field' => 'firstname'),
            
            array('db' => 'role', 'dt' => 1, 'field' => 'role'),
            array('db' => 'description', 'dt' => 2, 'formatter' => function($d, $row) {
                    return Common::shorteningString($d, 100);
                }, 'field' => 'description'),
            array('db' => 'image', 'dt' => 3, 'formatter' => function($d, $row) {
                    if ($d) {
                        return '<img src="' . TEAM_IMAGE_ROOT . $d . '" width="200">';
                    } else {
                        return '<img src="' . TEAM_IMAGE_ROOT . 'default.png" width="200">';
                    }
                }, 'field' => 'image'),
            array('db' => 'status', 'dt' => 4, 'formatter' => function( $d, $row ) {
                    if ($row['status']) {
                        return '<a href="javascript:;" class="btn btn-success status-btn" id="' . $row['id'] . '">Active</a>';
                    } else {
                        return '<a href="javascript:;" class="btn btn-danger status-btn" id="' . $row['id'] . '">Inactive</a>';
                    }
                }, 'field' => 'status'),
            array('db' => 'id', 'dt' => 5, 'formatter' => function( $d, $row ) {
                    $operation = '<a href="team/' . $d . '/edit" class="btn btn-primary" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;';
                    $operation .='<a href="javascript:;" id="' . $d . '" class="btn btn-danger delete-btn" title="Delete" data-toggle="tooltip"><i class="fa fa-times"></i></a>&nbsp;';
                    return $operation;
                }, 'field' => 'id'),
                        
            array('db' => 'lastname', 'dt' => 6, 'field' => 'lastname'),
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
