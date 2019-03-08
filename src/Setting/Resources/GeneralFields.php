<?php

namespace Naiveable\SettingsBundle\Setting\Resources;

use Naiveable\Fields\Boolean;
use Naiveable\Fields\Date;
use Naiveable\Fields\Email;
use Naiveable\Fields\Gravatar;
use Naiveable\Fields\HasMany;
use Naiveable\Fields\HasOne;
use Naiveable\Fields\ID;
use Naiveable\Fields\MorphOne;
use Naiveable\Fields\MorphToMany;
use Naiveable\Fields\Number;
use Naiveable\Fields\PhoneNumber;
use Naiveable\Fields\Qrcode;
use Naiveable\Fields\Select;
use Naiveable\Fields\Tabs\Tab;
use Naiveable\Fields\Text;
use Naiveable\SettingsBundle\Setting\Contracts\FieldableInterface;
use DateTimeZone;

/**
 * class GeneralFields
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
class GeneralFields implements FieldableInterface
{
	public function __invoke()
	{
		$listIdentifiers = DateTimeZone::listIdentifiers();
		return [
			new Tab(__('General'), [
				Text::make(__('Site Name'), 'site_name')
					->onlyOnForms(),

				Text::make(__('Site Description'), 'site_desciption')
					->onlyOnForms(),
				//Select::make('New User Notification', 'new_user_notification')
			]),

			new Tab(__('Date'), [
				Select::make(__('Timezone'), 'timezone')
					->onlyOnForms()
					->setInstructions('指定站点的默认时区')
					->resolveUsing(function() {
						return config('app.timezone');
					})
					->rules('required')
					->setDefaultValue(config('app.timezone'))
					->options(collect($listIdentifiers)->combine($listIdentifiers)),

				Select::make(__('Date Format'), 'date_format')
					->onlyOnForms()
					->resolveUsing(function() {
						return config('app.date_format');
					})
					->rules('required')
					->setDefaultValue(config('app.date_format'))
					->options([
						'j F, Y' => date('j F, Y'), // 06 November, 1996,
						'j M, y' => date('j M, y'), // 06 nov, 96,
						'm/d/Y'  => date('m/d/Y'), // 11/06/1996,
						'd/m/Y'  => date('d/m/Y'), // 06/11/1996,
						'Y-m-d'  => date('Y-m-d') // 1996-11-06,
					]),

				Select::make(__('Time Format'), 'time_format')
					->onlyOnForms()
					->setDefaultValue(config('app.time_format'))
					->resolveUsing(function() {
						return config('app.time_format');
					})
					->rules('required')
					->options([
						'g:i A' => date('g:i A'), // 4:00 PM,
						'g:i a' => date('g:i a'), // 4:00 pm,
						'H:i:s' => date('H:i:s'), // 16:00:00,
						'H:i'   => date('H:i') // 16:00,
					]),
			]),

			new Tab(__('维护'), [
				Text::make('Ip Whitelist', 'ip_whitelist')
					->setInstructions('当状态设定为 "禁用" 时，这些 IP 才能允许存取这个网站。')
					->onlyOnForms(),

				Boolean::make('Maintenance', 'maintenance')
					->setInstructions('使用此选项停止站点的前台系统.<br>打算进行维护或开发时适用.')
					->onlyOnForms(),

				Boolean::make('Basic Auth', 'basic_auth')
					->setInstructions('在开启维护模式时, 提示用户进行HTTP认证?')
					->onlyOnForms(),

				Text::make('503 Message', '503_message')
					->setInstructions(__('When the site is disabled or there is a major problem, this message will display to users.'))
					->onlyOnForms()
			]),
		];
	}
}
