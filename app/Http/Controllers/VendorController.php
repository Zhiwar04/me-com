<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use  Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
class VendorController extends Controller
{

    public function vendor(){
        return view('vendor.index');
    }
    public function vendorProfile(){
        $id = Auth::user()->id;
        //aw ida war agre ka login bwa
           $vendor = User::find($id);
           // datakani aw ida war agretawa
       return view('vendor.vendor_profile',compact('vendor'));
   }
   public function VendorProfileStore(Request $request){
   //sarata id user w datakani war agrenawa dway aw datayanay ka request krawn bo store krdn ayanxayna naw databasaka w save dakain
       $id = Auth::user()->id;
       $data = User::find($id);
       $data->name = $request->name;
       $data->email = $request->email;
       $data->phone = $request->phone;
       $data->address = $request->address;
       $data->vendor_join = $request->vendor_join;
       $data->vendor_short_info = $request->vendor_short_info;

       // agar reqeusti wena kra awa wenaka war agren w naweki nwe dadanen boy w ayxayna patheki dyari kraw dway awa save akain bo naw databasaka unlink bakar yat bo replace krdni wenaka lakate dubara bwnaway
       if ($request->file('photo')) {
           $file = $request->file('photo');
           @unlink(public_path('upload/vendor_images/'.$data->photo));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/vendor_images'),$filename);
           $data['photo'] = $filename;
       }
// ka datakaman save krd notificationek bet ble sarkawtw bww
       $data->save();
       $notification = array(
           'message' => 'vendor Profile Updated Successfully',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

   } // End Mehtod
   public function VendorChangePassword(){
    return view('vendor.vendor_change_password');
} // End Mehtod



public function VendorUpdatePassword(Request $request){
    // Validation
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed',
    ]);

    // Match The Old Password
    if (!Hash::check($request->old_password, auth::user()->password)) {
        return back()->with("error", "Current Password Doesn't Match!!");
    }

    // Update The new password
    User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->new_password)

    ]);
    return back()->with("status", " Password Changed Successfully");

} // End Mehtod


//login vendir
    public function vendorLogin(){
        return view('vendor.vendor_login');
    }

    //register vendor
    public function becomeVendor(){
        return view('auth.become_vendor');
    }
    public function RegisterVendor(Request $request){
        $user = User::Insert([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'vendor_join'=>$request->vendor_join,
            'password' => Hash::make($request->password),
            'role'=>'vendor',
            'status'=>'inactive',
        ]);
        $notification = array(
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.login')->with($notification);
    }
    public function vendorLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }
}