<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pasal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pasal $pasals)
    {
        $active = 'pasal';

        $q = $request->input('q');

        $pasals = $pasals->when($q, function($query) use ($q) {
                    return $query->where('perkara', 'like', '%'.$q.'%')
                                    ->orWhere('pasal', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        $notif = "none";
        return view('dashboard.pasal.index', 
                    compact('pasals',
                            'active', 
                            'request', 
                            'notif'
                    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'pasal';

        return view('dashboard.pasal.create', 
                    compact('active')
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pasal $pasals)
    {
        $validator = $request->validate([
            'perkara'            => 'required',
            'pasal'              => 'required|unique:pasal,pasal',
            'denda'              => 'required'
        ]);
        
        $pasal = Pasal::create([
            'perkara'             => $request->perkara,
            'pasal'               => $request->pasal,
            'denda'               => $request->denda
        ]);

        $active = 'pasal';
        $q = $request->input('q');
        $pasals = $pasals->when($q, function($query) use ($q) {
                    return $query->where('perkara', 'like', '%'.$q.'%')
                                    ->orWhere('pasal', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        $notif = "added";
        return view('dashboard.pasal.index', 
                    compact('pasals', 
                            'active', 
                            'request', 
                            'notif'
                    ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active = 'pasal';
        $pasal = Pasal::find($id);

        return view('dashboard.pasal.edit', 
                        compact('active',
                                'pasal'
                    ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Pasal $pasals)
    {
        $validator = $request->validate([
            'perkara'            => 'required',
            'pasal'              => 'required|unique:pasal,pasal,'.$id,
            'denda'              => 'required'
        ]);
        
        $pasal = Pasal::find($id);
        $pasal = $pasal->update([
            'perkara'             => $request->perkara,
            'pasal'               => $request->pasal,
            'denda'               => $request->denda
        ]);

        $active = 'pasal';
        $q = $request->input('q');
        $pasals = $pasals->when($q, function($query) use ($q) {
                    return $query->where('perkara', 'like', '%'.$q.'%')
                                    ->orWhere('pasal', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        $notif = "updated";
        return view('dashboard.pasal.index', 
                    compact('pasals', 
                            'active', 
                            'request',
                            'notif'
                    ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, Pasal $pasals)
    {
        $pasal = Pasal::find($id);
        $pasal->delete();

        $active = 'pasal';
        $q = $request->input('q');
        $pasals = $pasals->when($q, function($query) use ($q) {
                    return $query->where('perkara', 'like', '%'.$q.'%')
                                    ->orWhere('pasal', 'like', '%'.$q.'%');
                })
                ->paginate(10);
        
        $request = $request->all();
        $notif = "deleted";
        return view('dashboard.pasal.index', 
                    compact('pasals', 
                            'active', 
                            'request',
                            'notif'
                    ));
    }
}
