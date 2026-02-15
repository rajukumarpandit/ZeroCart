<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InstallerController extends Controller
{
    public function welcome() {
        return view('installer.welcome');
    }

    public function requirements() {
        return view('installer.requirements', [
            'php' => phpversion(),
            'extensions' => [
                'openssl' => extension_loaded('openssl'),
                'pdo' => extension_loaded('pdo'),
                'mbstring' => extension_loaded('mbstring'),
                'tokenizer' => extension_loaded('tokenizer'),
                'xml' => extension_loaded('xml'),
            ]
        ]);
    }

    public function permissions() {
        return view('installer.permissions', [
            'storage' => is_writable(storage_path()),
            'cache' => is_writable(base_path('bootstrap/cache')),
        ]);
    }

    public function database() {
        return view('installer.database');
    }

    public function saveDatabase(Request $request) {
        config([
            'database.connections.mysql.host' => $request->db_host,
            'database.connections.mysql.database' => $request->db_name,
            'database.connections.mysql.username' => $request->db_user,
            'database.connections.mysql.password' => $request->db_pass,
        ]);

        DB::connection()->getPdo();

        Artisan::call('migrate --seed --force');

        return redirect('/install/admin');
    }

    public function admin() {
        return view('installer.admin');
    }

    public function saveAdmin(Request $request) {
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect('/install/finish');
    }

    public function finish() {
        // file_put_contents(storage_path('installed'), 'ZyroCart Installed');
        // Artisan::call('key:generate');
        // Artisan::call('optimize:clear');

        return view('installer.finish');
    }
}