<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $team = TeamMember::where('is_visible', true)->orderBy('order')->get();
        return view('landing_page.tentang_kami', compact('team'));
    }
}
