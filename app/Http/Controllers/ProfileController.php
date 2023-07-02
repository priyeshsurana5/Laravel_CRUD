<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Log;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('profiles.create');
    }


public function datatables(Request $request)
{
    if ($request->ajax()) {
        $data = Profile::select(['id', 'name', 'email', 'address', 'pan_card', 'aadhar_card'])
            ->get();

      return Datatables::of($data)->make(true);
    }

    return abort(404);
}

    public function store(Request $request)
{
    try {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'pan_card' => 'required|unique:profiles',
            'aadhar_card' => 'required|unique:profiles',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Create a new profile
        $profile = new Profile();
        $profile->name = $validatedData['name'];
        $profile->email = $validatedData['email'];
        $profile->address = $validatedData['address'];
        $profile->pan_card = $validatedData['pan_card'];
        $profile->aadhar_card = $validatedData['aadhar_card'];

        // Handle profile image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $profile->image = $imageName;
        }

        // Save the profile
        $profile->save();

        // Redirect to the index page with success message
        Session::flash('success', 'Profile created successfully.');
        return redirect()->route('profiles.index');

    } catch (QueryException $e) {
        // Handle the duplicate entry error
        $errorMessage = 'The PAN Card or Aadhar Card number already exists. Please enter unique values.';
        Session::flash('error', $errorMessage);

        // Redirect back to the create profile page with the error message
        return redirect()->back()->withInput();
    }
}

    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profiles.show', compact('profile'));
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profiles.edit', compact('profile'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'pan_card' => 'required|unique:profiles,pan_card,'.$id,
        'aadhar_card' => 'required|unique:profiles,aadhar_card,'.$id,
        'image' => 'image|mimes:png,jpg|max:2048',
    ]);

    $profile = Profile::findOrFail($id);
    $profile->name = $request->input('name');
    $profile->email = $request->input('email');
    $profile->address = $request->input('address');
    $profile->pan_card = $request->input('pan_card');
    $profile->aadhar_card = $request->input('aadhar_card');
   
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $profile->image = $imageName;
    }

    $profile->save();

    return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
}
    public function deletedata()
    {
         $id = $_POST['val'];
         log::info($id);
         DB::table('profiles')->where('id', $id)->delete();
         return "success";
        
    }
}
