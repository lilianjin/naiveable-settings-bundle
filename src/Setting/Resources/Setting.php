<?php

namespace Naiveable\SettingsBundle\Setting\Resources;

use Naiveable\Fields\Image;
use Naiveable\Fields\Slug;
use Naiveable\Fields\Tabs\Tab;
use Naiveable\Fields\Text;
use Naiveable\Fields\Textarea;
use Naiveable\Fields\Traits\Tabs as TraitsTabs;
use Naiveable\Foundation\Resource;
use Naiveable\Http\Request;
use Naiveable\SettingsBundle\Setting\SettingModel;

/**
 * class Setting
 *
 * PHP business application development core system
 *
 * This content is released under the Business System Toll License (MST)
 *
 * @link     https://ofcold.com
 * @link     https://naiveable.com
 *
 * @author   Bill Li (bill.li@ofcold.com) [Owner]
 *
 * @license https://licenses.naiveable.com/mst  MST License
 *
 * @copyright  Copyright (c) 2017-2019 Bill Li, Ofcold Institute of Technology. All rights reserved.
 */
class Setting extends Resource
{
	use TraitsTabs;

	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = SettingModel::class;

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'name';

	protected static $settingFields;

	/**
	 * Indicates if the resoruce should be globally searchable.
	 *
	 * @var bool
	 */
	public static $globallySearchable = false;

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param  \Naiveable\Http\Request  $request
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return static::getSettingFields();
	}

	public static function setSettingFields($fields)
	{
		static::$settingFields = $fields;
	}

	public static function getSettingFields()
	{
		return static::$settingFields;
	}

}
