<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\GroupMail;
use App\Models\GroupName;
use App\Models\GroupMember;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function grouplist(Request $request)
    {
        $groupname = GroupName::get();

        if ($request->method() == "POST") {
            $searchkey = $request->input('search');
            DB::disableQueryLog();
            $groupname = GroupName::select(['id', 'name', 'created_at'])
                ->where('group_names.name', 'like', '%' . $searchkey . '%')
                ->get();

            return view("admin.group.group_list", compact('groupname'));
        }else{

            return view("admin.group.group_list", compact('groupname'));
        }
        // $userList = User::where('id', '!=', Auth::id())->get();
    }

    /**
     * Show the form for creating a new resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function addnewgrouplist(Request $request)
    {
        // dd($request->all());
        if ($request->method() == "POST") {
            $request->validate([
                'group_name' => 'required',
            ]);

            $group = new \App\Models\GroupName([
                'user_id' => Auth::user()->id,
                'name'    => $request->input('group_name'),
                'uniqid' =>   Str::random(10),
                'type' => $request->input('group_type'),
                'status' => "Active",
            ]);

            $group->save();

            return redirect()->route('group.new.list')->with('successmsg', 'Data has been added successfully.');
        } else {
            return view("admin.group.add_group_form");
        }
    }

    public function updatenewgrouplist(Request $request, $updateid = '')
    {

        if ($request->method() == "POST") {


            $request->validate([
                'group_name' => 'required',
            ]);

            $group = \App\Models\GroupName::find($request->input('update_id'));

            $group->fill([
                'user_id' => Auth::user()->id,
                'name'    => $request->input('group_name'),
                'uniqid' =>   Str::random(10),
                'type' => $request->input('group_type'),
                'status' => "Active",
            ]);
            $group->save();

            return redirect()->route('group.new.list')->with('successmsg', 'Data has been updated successfully.');
        } else {

            return view("admin.group.add_group_form");
        }
    }

    public function deletegroup(Request $request, $deleteid)
    {
        if (Auth::user()->role_id == 1) {
            $group = \App\Models\GroupName::find($deleteid);
            $groupmember = \App\Models\GroupMember::where('group_id', $deleteid)->get();
            foreach ($groupmember as $data) {
                $data->delete();
            }
            if ($group) {
                $group->delete();
                return redirect()->route('group.new.list')->with('successmsg', "Data has been deleted successfully!!.");
            } else {
                return redirect()->route('group.new.list')->with('errmsg', "Error!! Please try agian.");
            }
        } else {
            return redirect()->route('group.new.list')->with('errmsg', "Permission denied. Can't remove the client details.");
        }
    }

    public function invitegroup(Request $request)
    {
        // dd($request->all());
        $checkuserexist = User::where('email', $request->input('email'))->first();
        if ($checkuserexist) {
            if ($request->method() == "POST") {
                // $group = new \App\Models\GroupMember([
                //     'group_id' =>  $request->input('groupid'),
                //     'user_id' => $checkuserexist->id,
                // ]);
                // $group->save();
                $groupname = GroupName::where('id', $request->input('groupid'))->first();
                Mail::to($checkuserexist->email)->send(new GroupMail($groupname, $checkuserexist->email));
                return redirect()->route('group.new.list')->with('successmsg', 'Email Send successfully.');
            } else {
                return view("admin.group.add_group_form");
            }
        } else {
            $email = $request->input('email');
            $groupname = GroupName::where('id', $request->input('groupid'))->first();
            Mail::to($email)->send(new GroupMail($groupname, $email));
            return redirect()->route('group.new.list')->with('successmsg', 'Email Send successfully.');
            // return redirect()->route('group.new.list')->with('errormsg', 'User Not Exist.');
        }
    }

    public function acceptGroup($email, $uniqid)
    {
        $useremail = User::where('email', $email)->first();
        if ($useremail) {
            $groupname = GroupName::where('uniqid', $uniqid)->first();
            $membercheck = GroupMember::where('group_id', $groupname->id)->where('user_id', $useremail->id)->first();
            if (!$membercheck) {
                $group = new GroupMember([
                    'group_id' =>  $groupname->id,
                    'user_id' => $useremail->id,
                ]);
                $group->save();
            }
            return redirect(url('/'));
        } else {
            return redirect('/register/' . $email . '/' . $uniqid);
        }
    }

    public function userRegister($email, $uniqid)
    {
        return view('admin.group.userRegister', compact('email', 'uniqid'));
    }

    public function saveUser(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'role_id' => 2,
            'password' =>  Hash::make($request->password)
        ]);
        if ($user->save()) {
            $groupname = GroupName::where('uniqid', $request->uniqid)->first();
            $group = new GroupMember([
                'group_id' =>  $groupname->id,
                'user_id' => $user->id,
            ]);
            $group->save();
            return redirect('/login');
        }
    }

    public function allGroupMember($groupid)
    {

        
        // $group = \App\Models\GroupName::where('id', $groupid)->first();
        $group_member = \App\Models\GroupMember::with('user')->where('group_id', $groupid)->get();
        return view('admin.group.allGroupMember', compact('group_member'));
    }

    public function deleteMember($groupmemberid)
    {
        $groupmember = \App\Models\GroupMember::where('id', $groupmemberid)->first();
        $groupmember->delete();
        return redirect()->route('group.new.list')->with('successmsg', "Member has been removed successfully!!.");
    }
}
