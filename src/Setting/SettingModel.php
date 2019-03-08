<?php

namespace Naiveable\SettingsBundle\Setting;

use Naiveable\Database\Eloquent\Model;
use Naiveable\SettingsBundle\Setting\Contracts\SettingInterface;

/**
 * Class SettingModel
 *
 * PHP business application development core system
 *
 * This content is released under the Business System Toll License (MST)
 *
 * @link	 https://ofcold.com
 * @link	 https://naiveable.ofcold.com
 *
 * @author	 Ofcold Naiveable Team (naiveable@ofcold.com)
 * @author	 Bill Li (bill.li@ofcold.com)
 *
 * @license	https://dev.ofcold.com/licenses  MST License
 *
 * @copyright  Copyright (c) 2017-2019 Ofcold Institute of Technology. All rights reserved.
 */
class SettingModel extends Model implements SettingInterface
{
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'key';

	/**
	 * The database table.
	 *
	 * @var string
	 */
	protected $table = 'settings_settings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var [type]
	 */
	protected $fillable = [
		'key',
		'value',
	];

	/**
	 * Get the key.
	 *
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * Determine if the given option value exists.
	 *
	 * @param  string  $key
	 *
	 * @return bool
	 */
	public function exists($key)
	{
		return self::where('key', $key)->exists();
	}

	/**
	 * Get the specified option value.
	 *
	 * @param  string  $key
	 * @param  mixed   $default
	 *
	 * @return mixed
	 */
	public function get($key, $default = null)
	{
		if ($option = self::where('key', $key)->first()) {
			return $option->value;
		}

		return $default;
	}

	/**
	 * Set a given option value.
	 *
	 * @param  array|string  $key
	 * @param  mixed   $value
	 *
	 * @return void
	 */
	public function set($key, $value = null)
	{
		$keys = is_array($key) ? $key : [$key => $value];

		foreach ($keys as $key => $value) {
			$option = self::firstOrNew(['key' => $key]);
			$option->value = $value;
			$option->save();
		}
	}

	/**
	 * Set the key.
	 *
	 * @param $key
	 *
	 * @return $this
	 */
	public function setKey($key)
	{
		$this->key = $key;

		return $this;
	}

	/**
	 * Get the value.
	 *
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set the value attribute.
	 *
	 * @param $value
	 *
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}
}
