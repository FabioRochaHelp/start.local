<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\AddressInstitution;

class InstitutionController extends Controller
{
    public function institutionListView(): View
    {

        $institutions = Institution::orderBy('name')->get();
        return view('institution.list', compact('institutions'));
    }

    public function institutionRegisterView(): View
    {
        return view('institution.register');
    }

    public function institutionEditView($id): View
    {
        $institution = Institution::with('address')->findOrFail($id);
        if (!$institution)
            return Redirect()->route('institution.list.view');

        return view('institution.edit', compact('institution'));
    }

    public function show(string $cnpj)
    {
        $institution = Institution::where('cnpj', $cnpj)->get();

        if (!$institution) {
            return response()->json(['mensagem' => "Não encontrado"], 500);
        }

        $address = AddressInstitution::find($institution->id);
        return response()->json(['institution' => $institution, 'address' => $address], 200);
    }

    public function institutionDestroy(string $id)
    {
        $institution = Institution::findOrFail($id);

        $institution->delete();

        return redirect()->route('institution.list.view');
    }

    public function edit($id, Request $request)
    {
        $institution = Institution::with('address')->findOrFail($id);

        $institution->name = $request->name;
        $institution->cnpj = preg_replace('/[^0-9]/', '', $request->cnpj);
        $institution->email = $request->email;
        $institution->phone = preg_replace('/[^0-9]/', '', $request->phone);
        $institution->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $institution->responsability = $request->responsability;

        if ($request->hasFile('image')) {
            $imagem = $request->file('image');
            $institution->image = $imagem->store('institution', 'public');
        }

        if ($request->postalcode) {
            $institution->address->country = $request->country;
            $institution->address->state = $request->state;
            $institution->address->city = $request->city;
            $institution->address->street_name = $request->street_name;
            $institution->address->complement = $request->complement;
            $institution->address->number = $request->number;
            $institution->address->neighborhood = $request->neighborhood;
            $institution->address->postalcode = $request->postalcode;
        }

        //$institution->address->save();
        $institution->save();

        return redirect()->route('institution.list.view');
    }

    public function store(Request $request)
    {

        $tenantName = str_replace(' ', '', strtolower($request->name));

        if (!Institution::where('cnpj', $request->cnpj)->first()) {
            $institution = new Institution();
            $institution->name = $request->name;
            $institution->cnpj = preg_replace('/[^0-9]/', '', $request->cnpj);
            $institution->email = $request->email;
            $institution->phone = preg_replace('/[^0-9]/', '', $request->phone);
            $institution->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
            $institution->responsability = $request->responsability;

            if ($request->hasFile('image')) {
                $imagem = $request->file('image');
                $institution->image = $imagem->store('institution', 'public');
            }

            $institution->save();

            $response['id'] = $institution->id;
            return response()->json($response);

            // return $this->response->setJSON($response);
        }

        return abort(409, 'Instituição já cadastrada');
    }

    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);

        $institution->delete();

        return redirect()->route('institution.list.view');
    }
}
