<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Build;
use Illuminate\Support\Facades\Validator;

class BuildController extends Controller
{
    public function index()
    {
        $builds = Build::all();
        return Inertia::render('Builds/Index', ['builds' => $builds]);
    }


    public function create()
    {
        return Inertia::render('Builds/Create');
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'character'=> ['required'],
            'element'=> ['required'],
            'talents'=> ['required'],
            'weapons'=> ['required'],
            'artifacts'=> ['required'],
            'teams'=> ['required']
        ])->validate();

        Build::create($request->all());

        return redirect()->route('builds.index');
    }

    public function edit(Build $build)
    {
        return Inertia::render('Build/Edit', [
            'build' => $build
        ]);
    }


    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'character'=> ['required'],
            'element'=> ['required'],
            'talents'=> ['required'],
            'weapons'=> ['required'],
            'artifacts'=> ['required'],
            'teams'=> ['required']
        ])->validate();

        Build::find($id)->update($request->all());
        return redirect()->route('builds.index');
    }


    public function destroy($id)
    {
        Build::find($id)->delete();
        return redirect()->route('builds.index');
    }
}
