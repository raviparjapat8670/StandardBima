<?php

namespace App\Services\admin;

use App\Models\Occupation;
use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OccupationService
{

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function CreateOccupation(array $data)
    {

        if (empty($data))
            return false;

        $occupation = Occupation::create($data);
        // Log the activity
        UserActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity_type' => 'occupation-add',
            'activity_id' => $occupation->id,
            'message' => "Occupation {$data['title']} has been added.",
        ]);
        return $occupation;
    }


    public function getOccupations(array $data)
    {

        return Occupation::paginate(10);
    }

    public function getOccupationById($id)
    {
        if (empty($id))
            return false;

        return Occupation::find($id);
    }


    public function EditOccupation(array $data)
    {

        if (empty($data['id']))
            return false;


        $occupation = Occupation::find($data['id']);

        if (!$occupation)
            return false;

        $occupation->title = $data['title'];
        $occupation->status = $data['status'];
        $occupation->save();
        // Log the activity
        UserActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity_type' => 'occupation-edit',
            'activity_id' => $data['id'],
            'message' => "Occupation {$data['title']} has been updated.",
        ]);
        return $occupation;
    }

   
}
