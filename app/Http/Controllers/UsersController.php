<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use App\User;

use App\Post;

use App\Follow;

class UsersController extends Controller
{
    //
    public function profile()
    {
        return view('users.profile')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
    $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|min:5|max:40|email',
            'password' => 'alpha_num|required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'alpha_num|required|string|min:8|max:20|same:password',
            'bio' => 'max:150',
            'images' => 'image|mimes:jpg,png,bmp,gif,svg',
]);
if ($validator->fails()) {
    return redirect('/profile')
    ->withErrors($validator)
    ->withInput();
}
if ($request->hasFile('images')) {
    $image = $request->file('images');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $path = $image->storeAs('public', $imageName);
} else {
    $path = null;
}
//↓いらない
     //$list = DB::table('users')
     User::where('id', Auth::id())
     ->update([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'password' => bcrypt($request->input('password')),
            'bio' => $request->input('bio'),
            'images' => $imageName,
        ]);
                return redirect('/top');
    }

    public function search()
    {
    $list = \DB::table('users')->get();
     $user = Auth::user();
        return view('users.search',['list' => $list]);
    }
    public function searching(Request $request)
    {
       $name = $request->input('search');
       $list = DB::table('users')
     ->where('username','like','%'. $name . '%')
     ->get();
     $search_result = '検索ワード : '. $name;
     return view('users.search', [
      'list' => $list,
     'search_result' => $search_result
    ]);
    }

    public function yourprofile($id)
    {
                $profile = User::where('id', $id)->first();
                $UserPosts = Post::where('posts.user_id',$id)->get();
return view ('users.yourprofile',[
    'profile' => $profile, 'UserPosts' => $UserPosts]);
    }
}
