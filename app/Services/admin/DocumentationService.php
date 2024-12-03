<?php

namespace App\Services\admin;

use App\Models\Documentation;
use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DocumentationService
{

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function CreateDocumentation(array $data)
    {

        if (empty($data))
            return false;

        $documentation = Documentation::create($data);
        // Log the activity
        UserActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity_type' => 'documentation-add',
            'activity_id' => $documentation->id,
            'message' => "Documentation {$data['name']} has been added.",
        ]);
        return $documentation;
    }


    public function getDocumentations(array $data)
    {

        return Documentation::paginate(10);
    }

    public function getDocumentationById($id)
    {
        if (empty($id))
            return false;

        return Documentation::find($id);
    }


    public function EditDocumentation(array $data)
    {

        if (empty($data['id']))
            return false;


        $documentation = Documentation::find($data['id']);

        if (!$documentation)
            return false;

        $documentation->name = $data['name'];
        $documentation->description = $data['description'];
        $documentation->mandatory = $data['mandatory'];
        $documentation->status = $data['status'];
        $documentation->save();
        // Log the activity
        UserActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity_type' => 'documentation-edit',
            'activity_id' => $data['id'],
            'message' => "Documentation {$data['name']} has been updated.",
        ]);
        return $documentation;
    }

   
}
