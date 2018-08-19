<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;



class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 3;//每页显示几条
        if ($request->has('page')) {
            $currentPage = $request->input('page');
            $currentPage = $currentPage <= 0 ? 1 : $currentPage;
        } else {
            $currentPage = 1;
        }
        $currentNum = $perPage * ($currentPage - 1);//从哪里开始产找数据
        $list = DB::connection('mysql')->select('select * from  t_app_version ORDER  BY  id desc limit ?,?', [$currentNum, $perPage]);
        $total = DB::connection('mysql')->select('select COUNT(id) as id from t_app_version ');//数据总数
        $total_num = $total[0]->id;
        $paginator = new LengthAwarePaginator($list, $total_num, $perPage, $currentPage, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        return view('admin.version.version', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.version.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'version' => ['required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2}$/'],
                'update_version' => ['required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2}$/'],
                'os_type' => 'integer',
                'content' => 'required|max:500'
            ],
            [
                'version.required' => '提示版本号不能为空',
                'version.regex' => '提示版本号格式不正确',
                'update_version.required' => '更新版本号不能为空',
                'update_version.regex' => '更新版本号格式不正确',
                'os_type.integer' => '请选择系统',
                'content.required' => '更新文案不能为空',
                'content.max' => '更新文案不能超过150个汉子'
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->errors()->getMessages();
            $first_message = current($messages);
            return ['code' => 1, 'message' => $first_message[0]];
        }

        $insert = DB::connection('mysql')->insert('insert into t_app_version (version,update_version,mandatory_update,os_type,content) 
			values(?,?,?,?,?) ', [$request->input('version'), $request->input('update_version'), $request->input('mandatory_update'),
            $request->input('os_type'), $request->input('content')]);
        $return = ['code' => 200, 'url' => route('version')];
        if (!$insert) {
            $return = ['code' => 1, 'message' => '数据插入失败'];
        }
        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $version = DB::connection('mysql')->select('select * from t_app_version  where id=?', [$id]);//数据总数
        if (!$version) {
            abort(404);
        }
        $new_data = $version[0];
        return view('admin.version.edit', compact('new_data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'version' => ['required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2}$/'],
                'update_version' => ['required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2}$/'],
                'os_type' => 'integer',
                'content' => 'required|max:500'
            ],
            [
                'version.required' => '提示版本号不能为空',
                'version.regex' => '提示版本号格式不正确',
                'update_version.required' => '更新版本号不能为空',
                'update_version.regex' => '更新版本号格式不正确',
                'os_type.integer' => '请选择系统',
                'content.required' => '更新文案不能为空',
                'content.max' => '更新文案不能超过150个汉子'
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->errors()->getMessages();
            $first_message = current($messages);
            return ['code' => 1, 'message' => $first_message[0]];
        }
        $update = DB::connection('mysql')->update('update t_app_version set version=?,update_version=?,mandatory_update=?,os_type=?,content=?  where id=?',
            [$request->input('version'), $request->input('update_version'), $request->input('mandatory_update'), $request->input('os_type'), $request->input('content'), $request->input('id')]);
        $return = ['code' => 200, 'url' => route('version')];
        if (!$update) {
            $return = ['code' => 1, 'message' => '数据更新失败'];
        }
        return $return;
    }
}
