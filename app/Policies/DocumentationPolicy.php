<?php

namespace App\Policies;

use App\Models\Documentation;
use App\Models\User;

class DocumentationPolicy
{

    public function list(User $user)
    {
        // Check if the user has permission to 'list' on the 'Documentations' module
        return checkUserPermission($user, 'documentations', 'list');
       
        
    }
    public function create(User $user)
    {
        // Check if the user has permission to 'create' on the 'Documentations' module
        return checkUserPermission($user, 'documentations', 'create');
       
        
    }
    public function edit(User $user)
    {
        // Check if the user has permission to 'edit' on the 'Documentations' module
        return checkUserPermission($user, 'documentations', 'edit');
       
        
    }
    public function delete(User $user)
    {
        // Check if the user has permission to 'delete' on the 'Documentations' module
        return checkUserPermission($user, 'documentations', 'delete');
       
        
    }
}
