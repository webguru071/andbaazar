<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function active_agents(){
        $active_agents = User::with('agentDetails')->where([['type','agent'],['status',1]])->get();
        return view('admin.agent.active_agents',compact('active_agents'));
    }

    public function pending_agents(){
        $pending_agents = User::with('agentDetails')->where([['type','agent'],['status',0]])->get();
        return view('admin.agent.pending_agents',compact('pending_agents'));
    }

    public function rejected_agents(){
        $rejected_agents = User::with('agentDetails')->where([['type','agent'],['status',2]])->get();
        return view('admin.agent.rejected_agents',compact('rejected_agents'));
    }
}
