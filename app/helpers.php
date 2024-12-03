<?php

if (!function_exists('checkUserPermission')) {
    /**
     * Check if the user has the specified permission.
     *
     * @param \App\Models\User $user
     * @param string $permission
     * @return bool
     */
    function checkUserPermission($user, $module, $action)
    {
        // Ensure the permissions column exists and is in the correct format (a string for JSON).
        if ($user && isset($user->permission) && is_string($user->permission)) {
            // Decode the JSON stored in the 'permission' column
            $permissions = json_decode($user->permission, true);

            // Ensure that the 'modules' key exists in the permissions array
            if (isset($permissions) && is_array($permissions)) {
                // Check if the module exists in the permissions and if the action is allowed for that module
                if (isset($permissions[$module]) && in_array($action, $permissions[$module])) {
                    return true;
                }
            }
            
        }
        return false;

    }
    if (!function_exists('pr')) {
        function pr($data=array(), $exit=false)
        {
            echo "<pre>";
            print_r($data);
            if ($exit)
                exit;

            echo "</pre>";
        }
    }
}
