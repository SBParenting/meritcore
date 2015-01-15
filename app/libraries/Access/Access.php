<?php namespace Libraries\Access;

use Illuminate\Config\Repository as Config;
use Illuminate\Auth\AuthManager as Auth;
use Role;

class Access {

    protected $config;
    
    protected $auth;

    protected $user;

    protected $role;

    protected $permissions;

    /**
     * Inject the Config and AuthManager instance
     *
     * @param Illuminate\Config\Repository $config
     * @param Illuminate\Auth\AuthManager $auth
     */
    public function __construct(Config $config, Auth $auth)
    {
        $this->config = $config; 

        $this->auth = $auth;

        if ($this->auth->check())
        {
            $this->user = $this->auth->user();

            $this->role = $this->user->role;

            if (!empty($this->role))
            {
                $this->permissions = $this->role->permissions;
            }
        }
    }

    /**
     * Check if an authenticated user exists.
     * 
     * @return boolean
     */ 
    public function active()
    {
        return $this->auth->check();
    }

    /**
     * Return the current authenticated user.
     * 
     * @return Eloquent
     */ 
    public function user()
    {
        return $this->user;
    }

    /**
     * Return the current authenticated user's role.
     * 
     * @return string
     */ 
    public function role()
    {
        if (!empty($this->role))
        {
            return $this->role->name;
        }
    }

    /**
     * Return the current authenticated user's permissions.
     * 
     * @return object array
     */ 
    public function permissions()
    {
        return $this->permissions;
    }

    /**
     * Check if the current user has the specified permission.
     * 
     * @return boolean
     */ 
    public function can($id)
    {
        if ($id==='*')
        {
            return self::active();
        }

        return in_array($id, $this->permissions);
    }

    /**
     * Returns all possible roles that a user can be assigned to.
     * 
     * @return Eloquent 
     */ 
    public function allRoles()
    {
        return make_assoc_from_model(Role::where('name', '!=', 'Anonymous')->get(), 'id', 'name');
    }

    /**
     * Returns all the sections in which permissions are contained.
     * 
     * @return object array
     */ 
    public function allSections()
    {
        return make_obj_array( $this->config->get('security.permissions_sections') );
    }

    /**
     * Returns all the possible permissions a user can have, either a full list, or for the specified section only.
     * 
     * @param  string Optional section
     * @return object array
     */ 
    public function allPermissions($section=false)
    {
        if ($section===false)
        {
            return make_obj_array( $this->config->get('security.permissions') );
        }
        else 
        {
            return make_obj_array( $this->getPermissionsBySection($section) );
        }
    }

    /**
     * Returns all the permissions contained in the specified section only.
     * 
     * @param  string Section contained permissions
     * @return array
     */  
    public function getPermissionsBySection($section)
    {
        $return = [];

        foreach ( $this->config->get('security.permissions') as $key => $row )
        {
            if (strpos($key, "$section->id:")===0)
            {
                $return[$key] = $row;
            }
        }

        return $return;
    }

    /**
     * Check if the specified permission ID is an actual permission that exists in the system.
     * 
     * @param  integer Permission ID
     * @return boolean
     */ 
    public function isValidPermissionID($id)
    {
        $permissions = $this->allPermissions();

        return array_key_exists($id, $permissions);
    }

    /**
     * Update the Administrator role to include all permissions.
     * 
     * @return boolean
     */ 
    public function updateAdministrator()
    {
        $permissions = [];

        $admin = Role::where('name', '=', 'Administrator')->first();

        foreach (array_keys( $this->config->get('security.permissions') ) as $row)
        {
            $permissions[$row] = "true";
        }

        $admin->updatePermissions( $permissions )->save();

        return true;
    }

    /**
     * Lock the current application screen.
     * 
     * @return string
     */ 
    public function lock()
    {
        if (\Access::active())
        {
            \Access::user()->fill(['locked' => true])->save();
        }
    }

    /**
     * Unlock the current application screen.
     * 
     * @return string
     */ 
    public function unlock($password=false)
    {
        if (\Access::active())
        {
            if ($password === false)
            {
                \Auth::user()->fill(['locked' => false])->save();

                return true;
            }
            else
            {
                if (\Auth::validate(['username' => \Auth::user()->username, 'password' => $password]))
                {
                    \Auth::user()->fill(['locked' => false])->save();

                    return true;
                }
            }
        }

        return false;
    }

     /**
     * Check if the user screen is locked.
     * 
     * @return string
     */ 
    public function isLocked()
    {
        if (\Access::active())
        {
            return \Access::user()->locked;
        }
    }

}