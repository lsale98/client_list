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

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return Redirect::to('/')->with('success', 'Uspešno Ste izbrisali klijenta');
    }
}
