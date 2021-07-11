<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SeasonsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class SeasonsController extends Controller
{
    public function seasons(SeasonsDataTable $seasons)
    {
        $this->authorize('viewAny', Season::class);

        return $seasons->render('admin.seasons.seasons-index');
    }


    public function edit($id)
    {

        $this->authorize('view', Season::class);

        $season = Season::find($id);
        if ($season ) {
            return view('admin.seasons.season-edit', ['season' => $season]);
        } else {
            return back()->withErrors(trans('app.season.not-found'));
        }
    }



    public function update(Request $request)
    {
        $this->authorize('update', Season::class);

        $data = ($request->all());

        Validator::make($data, [
            'id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'date_format:Y', 'max:255'],
            'start_date' => ['required', 'date', 'max:255'],
            'end_date' => ['required', 'date', 'max:255'],
        ], [], [])->validate();

        $season = Season::find($request->id);

        if ($season) {
            
            $season->name = $data['name'];
            $season->year = $data['year'];
            $season->start_date = $data['start_date'];
            $season->end_date = $data['end_date'];

            $season->save();
            
            return back()->with('success', trans('app.season.updated-successfuly'));
        } else {
            return back()->withErrors(trans('app.season.not-found'));
        }
    }



    public function newSeason()
    {
        $this->authorize('create', Season::class);

        return view('admin.seasons.Season-create');
    }

    public function create(Request $request)
    {
        $this->authorize('create', Season::class);

        $data = ($request->all());

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'date_format:Y', 'max:255'],
            'start_date' => ['required', 'date', 'max:255'],
            'end_date' => ['required', 'date', 'max:255'],
        ], [], [])->validate();

        $Season =  Season::create([
            'name' => $data['name'],
            'year' => $data['year'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return redirect(route('admin.seasons.show'))->with('success', trans('app.season.created-successfuly'));
    }

    public function delete(Request $request)
    {
        $this->authorize('delete', Season::class);

        $data = ($request->all());

        Validator::make($data, [
            'id' => ['required'],
        ], [], [])->validate();
        if (Season::find($request->id)->delete()) {

            return back()->with('success', trans('app.season.deleted-successfuly'));
        } else {
            return back()->withErrors(trans('app.something-went-wrong'));
        }
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
