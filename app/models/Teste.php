<?php

namespace app\models;

use core\Model;

class Teste extends Model
{
	public function testando()
	{
		$admins = $this->select(['value'], 'mdl_config')
		->where('name', '=', 'siteadmins')
		->get();

		$user_admins = $admins[0]['value'];

		if (str_contains($user_admins, ',')) {
			$user_admins = explode(',', $user_admins);
		} else {
			$user_admins = array($user_admins);
		}

		$users = $this->select(['id', 'firstname', 'lastname', 'email'], 'mdl_user')		
		->get();		

		foreach ($users as $key => $value) {
			if (array_intersect($user_admins, $users[$key])) {
				$users[$key] += ['is_admin' => true];
			} else {
				$users[$key] += ['is_admin' => false];
			}
		}

		return $users;
	}

}