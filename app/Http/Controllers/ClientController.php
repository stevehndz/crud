<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all registers with paginate
        $clients = Client::paginate(5);
        return view("client.index")->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("client.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ // Validation rules for store data
            "name" => "required|max:35",
            "due" => "required|gte:10",
            "comment" => "required",
        ]);

        // Massive asignation
        $client = Client::create($request->only("name", "due", "comment"));
        // Redirect
        Session::flash("success", "Registro creado");
        return redirect()->route("client.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view("client.form")->with("client", $client); // Pasar variables a la vista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([ // Validation rules for store data
            "name" => "required|max:35",
            "due" => "required|gte:10",
            "comment" => "required",
        ]);

        // Individual asignation
        $client->name = $request->name;
        $client->due = $request->due;
        $client->comment = $request->comment;
        $client->save(); // Save client

        // Redirect
        Session::flash("success", "Registro editado");
        return redirect()->route("client.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        // Redirect
        Session::flash("success", "Registro eliminado");
        return redirect()->route("client.index");
    }
}
