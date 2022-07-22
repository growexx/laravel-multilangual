<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Resources\Lang\en\Messages\SiteData;
use Stichoza\GoogleTranslate\GoogleTranslate;
include(app_path() . '/../resources/lang/en/messages.php');

class LangController extends Controller
{
    public function indexForLanguage()
    {
        return view('lang');
    }
    public function change(Request $request)
    {
        session()->put('from_lang', session()->get('to_lang'));
        session()->put('to_lang', $request->lang);
        return redirect()->back();
    }
    public function index()
    {
        $message = new SiteData();
        $message_data = $message->getData('LangIndex');
        $data['data']=$message_data['data'];
        $companies = DB::table('companies')->select('id', 'name', 'email', 'address')->get();
        foreach ($companies as $company) {
            $data['companies'][] = [
                'id' => GoogleTranslate::trans($company->id, $message_data['to_lang'], $message_data['from_lang']),
                'name' => GoogleTranslate::trans($company->name, $message_data['to_lang'], $message_data['from_lang']),
                'email' => GoogleTranslate::trans($company->email, $message_data['to_lang'], $message_data['from_lang']),
                'address' => GoogleTranslate::trans($company->address, $message_data['to_lang'], $message_data['from_lang']),
            ];
        }
        return view('lang', $data);
    }
    public function create()
    {
        $message = new SiteData();
        $message_data = $message->getData('LangCreate');
        $data['data']=$message_data['data'];
        return view('create',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')
            ->with('success', GoogleTranslate::trans('Company has been created successfully.', session()->get('to_lang'),'en'));
    }
    public function show(Company $company)
    {
        return view('lang', compact('company'));
    }
    public function edit(Company $company)
    {
        $message = new SiteData();
        $message_data = $message->getData('LangEdit');
        $data['data']=$message_data['data'];
        $company = compact('company')['company'];
        $data['company'] = [
            'id' => GoogleTranslate::trans($company->id, $message_data['to_lang'], $message_data['from_lang']),
            'name' => GoogleTranslate::trans($company->name, $message_data['to_lang'], $message_data['from_lang']),
            'email' => GoogleTranslate::trans($company->email, $message_data['to_lang'], $message_data['from_lang']),
            'address' => GoogleTranslate::trans($company->address, $message_data['to_lang'], $message_data['from_lang']),
        ];
        return view('edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')
            ->with('success', GoogleTranslate::trans('Company Has Been updated successfully', session()->get('to_lang'),'en'));
    }
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')
            ->with('success', GoogleTranslate::trans('Company has been deleted successfully', session()->get('to_lang'),'en'));
    }
}
