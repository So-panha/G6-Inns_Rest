<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    use UploadImage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('setting.profile',['user'=>$user]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'phone_number' => 'required|string|unique:users,phone_number,'.$user->id.',id',
        ]);


        if($request->password != null){
            $request->validate([
                'passwo``rd' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        if($request->hasFile('profile')){
            if($name = $this->saveImage($request->profile)){
                $validated['profile'] = '/images/' .$name;
            }
        }

        $user->update($validated);

        return redirect()->back()->withSuccess('User updated !!!');
    }
}
