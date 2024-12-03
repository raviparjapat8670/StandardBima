<?php

namespace App\Policies;

use App\Models\Occupation;
use App\Models\User;

class OccupationPolicy
{

    public function list(User $user)
    {
        // Check if the user has permission to 'list' on the 'Occupation' module
        return checkUserPermission($user, 'occupations', 'list');
       
        
    }
    public function create(User $user)
    {
        // Check if the user has permission to 'create' on the 'Occupation' module
        return checkUserPermission($user, 'occupations', 'create');
       
        
    }
    public function edit(User $user)
    {
        // Check if the user has permission to 'edit' on the 'Occupation' module
        return checkUserPermission($user, 'occupations', 'edit');
       
        
    }
    public function delete(User $user)
    {
        // Check if the user has permission to 'delete' on the 'Occupation' module
        return checkUserPermission($user, 'occupations', 'delete');
       
        
    }
}
