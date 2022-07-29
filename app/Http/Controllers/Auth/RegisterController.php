<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            /* ----- make a unique db_name for current registering user ----- */
            $db_name = Str::snake(strtolower($data['name'])).'_'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'_'.date('s');

            /* ----- get the current/root db_name ----- */
            $root_db_name = Config::get('database.connections.mysql.database');

            /* ----- create new db and connect it ----- */
            DB::statement("CREATE DATABASE IF NOT EXISTS $db_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            Config::set('database.connections.mysql.database', $db_name);
            DB::purge('mysql');
            DB::reconnect('mysql');

            /* ----- create table in new db ----- */
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('type');
                $table->timestamps();
            });

            /* ----- connect with root db ----- */
            Config::set('database.connections.mysql.database', $root_db_name);
            DB::purge('mysql');
            DB::reconnect('mysql');

            /* ----- create the user in root db and add new db name in this root db users table ----- */
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'db_name' => $db_name,
            ]);
        } catch (\Exception $e){
            Log::channel('daily')->info('Error Log: '.date('d-m-Y H:i:s').'\n');
            Log::channel('daily')->info('Error Message: '.$e->getMessage().'\n');
            Log::channel('daily')->info('Error File: '.$e->getFile().'\n');
            Log::channel('daily')->info('Error Line: '.$e->getLine().'\n');
            Log::channel('daily')->info('Error Stack Trace: '.$e->getTraceAsString().'\n');
            Log::channel('daily')->info('Error Logged By: '.'Farhan Khan 3069'.'\n');
            throw new \ErrorException($e->getMessage());
        }
    }
}
