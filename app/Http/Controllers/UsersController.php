<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Repair;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index')->with('users', $users);
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');

            if ($query != '') {
                $data = User::where('name', 'like', '%' . $query . '%')->orWhere('lastname', 'like', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $data = User::orderBy('created_at', 'desc')->get();
            }
            $total_row = $data->count();
            $output = '';
            if ($total_row > 0) {
                foreach ($data as $user) {
                    $output .= '
            <tr>
                <td>' . $user->name . '</td>
                <td>' . $user->lastname . '</td>
                <td>' . $user->created_at->format('d/m/Y') . '</td>
                <td><a href=/user/' . $user->id . ' class="btn btn-primary"><i class="fas fa-eye mr-2"></i>Prikaži</a></td>
            </tr>
            ';
                }
            } else {
                $output = '
            <tr>
            <td class="text-center" colspan="4">Nije pronađen ni jedan klijent</td>
        </tr>
            ';
            }
            $data = array('table_data' => $output);
            return Response::json($data);
        }
    }

    public function action__user(Request $request, $id)
    {
        if ($request->ajax()) {

            $query = $request->get('query');

            if ($query != '') {

                $data = Repair::where('title', 'like', '%' . $query . '%')->orWhere('body', 'like', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $data = Repair::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);
            }
            $total_row = $data->count();
            $output = '';
            if ($total_row > 0) {
                foreach ($data as $repair) {
                    $output .= '
                    <div id="card" class="card w-90">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <h5 class="pt-2">Popravka: ' . $repair->title . '</h5>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 text-right">
                                <a href="/user/repairs/' . $repair->id . '/edit" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Izmenite popravku</a>
                                {!! Form::open(array("action" => array("UsersController@repairs_destroy", ' . $repair->id . '), "method" => "POST", "class" =>"d-inline-block")) !!}
                                {{ Form::hidden("_method", "DELETE") }}
                                <button class="btn btn-danger" type="submit" value="submit" onclick="return confirm("Da li Ste sigurni da želite da obrišete popravku ' . $repair->title . '?")">
                                    <i class="fas fa-trash-alt mr-2"></i>Izbrišite popravku
                                </button>
                                {!! Form::close() !!}

                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5><i class="fas fa-calendar-alt mr-1"></i>Datum popravke(dan/mesec/godina): ' . $repair->created_at->format("d/m/Y") . ' <span>|</span><i class="fas fa-car ml-1"></i> Kilometraža: ' . $repair->kilometers . ' km</h5>
                        <hr>
                        <h5><i class="fas fa-exclamation-circle mr-1"></i>Napomena:</h5>
                        <p>' . $repair->body . '</p>
                    </div>
                </div>
            ';
                }
            } else {
                $output = '

            <h3 class="text-center">Nije pronađena ni jedana popravka</h3>

            ';
            }
            $data = array('repair_data' => $output);
            return Response::json($data);
        }
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'number' => 'required',
            'brand' => 'required',
            'model' => 'required'
        ]);

        $user = new User();

        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->number = $request->input('number');
        $user->brand = $request->input('brand');
        $user->model = $request->input('model');

        $user->save();

        return Redirect::to('/')->with('success', 'Uspešno Ste kreirali klijenta');
    }

    public function show($id)
    {
        $user = User::find($id);
        $repairs = Repair::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);

        return view('users.show')->with(array('user' => $user, 'repairs' => $repairs));
    }

    public function repairs($id)
    {
        $user = User::find($id);

        return view('repairs.create')->with('user', $user);
    }

    public function repairs_store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'kilometers' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        $repair = new Repair();

        $repair->user_id = $request->input('user_id');
        $repair->kilometers = $request->input('kilometers');
        $repair->title = $request->input('title');
        $repair->body = $request->input('body');

        $repair->save();

        return Redirect::to('/user/' . $request->input('user_id'))->with('success', 'Uspešno Ste dodali popravku');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit')->with('user', $user);
    }

    public function repairs_edit($id)
    {
        $repair = Repair::find($id);

        return view('repairs.edit')->with('repair', $repair);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'number' => 'required',
            'brand' => 'required',
            'model' => 'required'
        ]);

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->number = $request->input('number');
        $user->brand = $request->input('brand');
        $user->model = $request->input('model');

        $user->save();

        return Redirect::to('/user/' . $id)->with('success', 'Uspešno Ste izmenili podatke');
    }

    public function repairs_update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'kilometers' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        $repair = Repair::find($id);

        $repair->user_id = $request->input('user_id');
        $repair->kilometers = $request->input('kilometers');
        $repair->title = $request->input('title');
        $repair->body = $request->input('body');

        $repair->save();

        return Redirect::to('/user/' . $request->input('user_id'))->with('success', 'Uspešno Ste izmenili podatke popravke');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return Redirect::to('/')->with('success', 'Uspešno Ste izbrisali klijenta');
    }

    public function repairs_destroy($id)
    {
        $repair = Repair::find($id);

        $repair->delete();

        return redirect()->back()->with('success', 'Uspešno Ste izbrisali popravku');
    }
}
