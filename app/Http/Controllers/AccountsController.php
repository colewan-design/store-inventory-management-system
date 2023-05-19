<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\accounts;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('users')->get();
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
        DB::beginTransaction();
    
        try {
            // Insert a new record into the accounts table
            $accounts = new accounts();
            columnSetter($accounts, $request);
    
            $role = auth()->user()->role; // Get the role of the authenticated user
            switch ($role) {
                case 'Parent':
                    $prefix = 'P';
                    break;
                case 'Staff':
                    $prefix = 'S';
                    break;
                case 'Finance Officer':
                    $prefix = 'FO';
                    break;
                case 'Student':
                    $prefix = 'ST';
                    break;
                case 'School Admin':
                case 'Super Admin':
                    $prefix = 'SAD';
                    break;
                default:
                    $prefix = 'USR';
            }
    
            $id = IdGenerator::generate(['table' => 'users', 'field' => 'account_id', 'length' => 10, 'prefix' => $prefix . date('mdy')]);
            $accounts->accounts = $id;
            $accounts->save();
    
            DB::commit(); // Commit the transaction
            return Redirect::back();
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if an error occurred
            throw $e;
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\accounts  $accounts
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
     * @param  \App\Models\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $accounts = accounts::find($id);
        $accounts->update($req->all());
        return $accounts;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accounts = accounts::find($id);
        $accounts->delete();
        return $accounts->Redirect::back();
    }
}
