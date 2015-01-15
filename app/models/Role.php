<?php

class Role extends BaseModel {

	protected $table = 'roles';

	protected $fillable = ['name', 'description', 'permissions', 'updatable'];

	public function hasPermission($id)
	{
		return in_array($id, $this->permissions);
	}

	public function getPermissionsAttribute($value)
	{
		return explode(',', $value);
	}

	public function updatePermissions($arr)
	{
		$permissions = make_assoc( $this->permissions );

		foreach ($arr as $id => $value)
		{
			$id = trim($id);

			if (Access::isValidPermissionID($id))
			{
				if ($value == "true")
				{
					$permissions = array_add($permissions, $id, $id);
				}
				else {

					array_forget($permissions, $id);
				}
			}
		}

		$this->permissions = implode(',', array_keys($permissions));

		return $this;
	}
}