<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Prayers as Prayers;
use App\Helpers\Datatable\SSP;
use Validator;

class ActiveController extends Controller {

    /**
     * Prayers Model
     * @var Prayers
     */
    protected $prayers;
    protected $pageLimit;

    /**
     * Inject the models.
     * @param Prayers $prayers
     */
    public function __construct(Prayers $prayers) {
        //$this->getSettings();
        $this->prayers = $prayers;
        $this->pageLimit = config('settings.pageLimit');
    }

    /**
     * Display a listing of Prayers
     *
     * @return Response
     */
    public function index() {

        // Grab all the prayers
        $prayers = Prayers::where('active','1')->get();

        // Show the page
        return view('admin/activeList', compact('prayers'));
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
     * Show the form for editing the specified requests.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $requests = Requests::find($id);
        
        if ($requests) {
            return view('admin/requests', compact('requests'));
        } else {
            return redirect('admin/requests')->with('error_message', 'Invalid requests id');
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
        $requests = Requests::findOrFail($id);

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $requests->update($data);

        return redirect()->route('requests.index')->with('success_message', 'Requests updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        $requests = Requests::findOrFail($id);
        
        Requests::destroy($id);

        $array = array();
        $array['success'] = true;
        $array['message'] = 'Requests deleted successfully!';
        echo json_encode($array);
    }

    public function changeRequestsStatus(Request $request) {
        $data = $request->all();
        $requests = Requests::find($data['id']);
        
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

    // listing data
    public function getActiveData()
    {
        $prayers = Prayers::where('active','1')->get();
        $main_array = array();
        
        foreach ($prayers as $key=>$value)
        {
            print_r($value);

            $array = array();
            $array['id'] = $id;
            $array['info'] = $value['first_name']." ".$value['last_name']." <br>".$value['email'];
            
            $array['request'] = "<b>".$value['title']."</b><br>".nl2br(substr($value['body'],0,25));
            $array['ip'] = $value['ip_address'];
            $array['date'] = date("Y-m-d",$value['submitted']);

            //$prayes = Prayedfor::where('request_id',$value['id'])->count();
            //$array['prayes'] = $prayes;
            
            $array['action'] = "<a title='Click To Edit' class='btn btn-success btn-squared' href=\"request.php?aid=".$value['id']."\"><i class=\"fa fa-edit\"></i></a> <a title='Click To Remove' class='btn btn-danger btn-squared to_delete' id=\"".$value['id']."\" href ><i class=\"fa fa-trash-o\"></i></a> <a title='Click To Close' class='btn btn-info btn-squared to_closed' id=\"".$value['id']."\" href ><i class=\"fa fa-times\"></i></a> <a title='Click To Banned' class='btn btn-blue btn-squared to_banned' id=\"".$value['id']."\" href ><i class=\"fa fa-eraser\"></i></a>";
        
            $main_array['data'][$i++] = $array;
        }
        exit();

        $array = json_encode($main_array);
        echo $array;
    }
}
