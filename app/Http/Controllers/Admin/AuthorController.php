<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaBread = json_encode([
            ['title'=> 'Admin', 'url'=> route('admin')],
            ['title'=> 'Lista de Autores', 'url'=> '']
        ]);

        $authors = User::select('id', 'name', 'email')->where('author', 'S')->paginate(2);

        return view('admin.authors.index', compact('listaBread', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = array_filter($request->all());

        $validate = \Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $input['password'] = bcrypt($input['password']);

        User::create($input);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $input = array_filter($request->all());

        if(isset($input['password']) && $input['password'] != ""){
            $validate = \Validator::make($input, [
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($id)],
                'password' => 'required|string|min:6',
            ]);

            $input['password'] = bcrypt($input['password']);
        }else{
            $validate = \Validator::make($input, [
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($id)]
            ]);
            unset($input['password']);
        }

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        User::find($id)->update($input);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }
}
