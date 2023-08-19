<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Intl\Currencies;

class SettingsController extends Controller
{
    public function index()
    {
        if (!Gate::allows('setting-view')) {
            abort(500);
        }

      
        $settings = Setting::whereIn('key', ['titel_en', 'titel_ar', 'logo', 'contact_email', 'about_en', 'about_ar', 'currency', 'language_ar', 'language_en', 'policy_ar', 'policy_en'])->pluck('value', 'key');

        return view('dashboard.views-dash.setting.index',compact('settings'));
    }

    public function social()
    {
        if (!Gate::allows('setting-view')) {
            abort(500);
        }


        $settings = Setting::whereIn('key', ['titel_en', 'titel_ar', 'logo', 'contact_email', 'about_en', 'about_ar', 'currency', 'language_ar', 'language_en', 'policy_ar', 'policy_en'])->pluck('value', 'key');

        return view('dashboard.views-dash.setting.social',compact('settings'));
    }



    public function update(Request $request)
{

    $request->validate([
        'titel_en' => 'required',
        'titel_ar' => 'required',
        'logo' => 'required',
        'contact_email' => 'required',
        'about_ar' => 'required',
        'about_en' => 'required',
        'currency' => 'required',
        'language'=> 'required',
        'policy_ar' => 'required',
        'policy_en' => 'required',
    ]);

    $data = $request->except(['_token', '_method','logo']);


    foreach ($data as $key => $value) {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }





    if ($request->logo) {

        $logos = Setting::Where('key','logo')->first();
     if($logos){

        $destination = 'uploads/logos/' . $logos->value;


    if (File::exists($destination)) {

        File::delete($destination);

    }

     }

    $file = $request->file('logo');

    $extention = $file->getClientOriginalExtension();
    $filename = time() . '.' . $extention;
    $file->move(public_path('uploads/logos'), $filename);




    Setting::updateOrCreate(
        ['key' => 'logo'],
        ['value' => $filename]
    );





}








    return redirect()->back()->with('success', __('Updated successfully'));
}





    public function update_social(Request $request){

        // return Setting::where('key',$key)->update($data);

        $data = $request->except(['_token', '_method']);

    foreach ($data as $key => $value) {
           Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    $request->validate([
        'facebook' => 'required',
        'snapshat' => 'required',
        'whatsapp' => 'required',

    ]);

    return redirect()->back()->with('success', __('Updated successfully'));

    }


}
