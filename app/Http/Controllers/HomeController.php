<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $applications = Application::paginate(12);
        return view('home', ['applications' => $applications])->with('page', 'Home');
    }

    public function myApp($id)
    {
        /** Application */
        $application = DB::table('applications')->where('id',$id)->first();

        /** Provider */
        $provider = DB::table('providers')->where('id',$application->provider_id)->first();

        /** Severs */
        $servers = DB::table('servers')->join('application_server', 'servers.id', '=', 'application_server.server_id')->where('application_server.application_id', $id)->get();

        /** Crendentials Servers */
        /** */
        $ids = [];

        foreach($servers as $server) {
           array_push($ids, $server->id);
        }

        $credentials_servers = DB::table('credentials')->whereIn('credentialable_id', $ids )->get();

        return [
            'application' => $application,
            'provider' => $provider,
            'servers' => $servers,
            'credential_servers' => $credentials_servers
        ];
    }
}
