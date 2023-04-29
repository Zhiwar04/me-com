<?php

namespace App\Http\Controllers;

use App\Models\User;
use  Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function Admin(){

        return view('admin.index');
    }
    public function adminProfile(){
         $id = Auth::user()->id;
         //aw ida war agre ka login bwa
            $admin = User::find($id);
            // datakani aw ida war agretawa
        return view('admin.admin_profile',compact('admin'));
    }
    public function AdminProfileStore(Request $request){
    //sarata id user w datakani war agrenawa dway aw datayanay ka request krawn bo store krdn ayanxayna naw databasaka w save dakain
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        // agar reqeusti wena kra awa wenaka war agren w naweki nwe dadanen boy w ayxayna patheki dyari kraw dway awa save akain bo naw databasaka unlink bakar yat bo replace krdni wenaka lakate dubara bwnaway
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
// ka datakaman save krd notificationek bet ble sarkawtw bww
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod
    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    } // End Mehtod
    public function AdminUpdatePassword(Request $request){
        // Validation
        // old password w new password keywordi laravel xoyn ka abe name filedi passwordaka baw nawana save bbn bo away esh bkan wa lerada validationman bo aw 2 vilda krdwa ka abe datayan bo daxl bkret
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        // agar aw passworday ka ema daxlman krdwa yaksan nabw baw passworday hamana awa update nabet
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "current Password Doesn't Match!!");
        }
//agar yaksan bww dataka akata naw databasaka
        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");

    } // End Mehtod

    public function adminLogin(){
        return view('admin.admin_login');
    }
    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}