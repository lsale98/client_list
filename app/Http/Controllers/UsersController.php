<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index')->with('users', $users);
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');

            if ($query != '') {
                $data = User::where('name', 'like', '%' . $query . '%')->orWhere('lastname', 'like', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $data = User::orderBy('created_at', 'desc')->paginate(10);
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
                <td><a href=/user/' . $user->id . '>Prikaži</a></td>
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
}
