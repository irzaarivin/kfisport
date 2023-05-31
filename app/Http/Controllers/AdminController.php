<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        return view("employee");

    }

    public function attendance(Request $request) {

            if($request->has("id")) {

                $id = $request->id;

                $result = DB::table('attendances')->where("user_id", $id)->latest()->get();
                $user = User::find($id);

                return view('attendance-detail', [

                    "data" => $result,
                    "user" => $user

                ]);

            } else {

                $tanggal = Carbon::now()->format('Y-m-d');
                $result = DB::table('attendances')->where("date", $tanggal)->get();

                return view("attendance-check", [

                    "data" => $result

                ]);

            }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
