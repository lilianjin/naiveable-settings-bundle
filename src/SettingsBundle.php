<?php

namespace Naiveable\SettingsBundle;

use Naiveable\Foundation\Bundle\Bundle;
use Naiveable\Foundation\Bundle\BundleCollection;
use Naiveable\Foundation\Contracts\SettingFieldableInterface;

/**
 * Class SettingsBundle
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
 * @copyright  Copyright (c) 2017-2018 Ofcold Institute of Technology. All rights reserved.
 */
class SettingsBundle extends Bundle implements SettingFieldableInterface
{
	/**
	 * The navigation display flag.
	 *
	 * @var  bool
	 */
	protected $navigation = true;

	/**
	 * The addon icon.
	 *
	 * @var  string
	 */
	protected $icon = 'cogs';

	/**
	 * The view's component.
	 *
	 * @deprecated Deprecated in version 1.2
	 *
	 * @var string
	 */
	public $component = 'settings';

	/**
	 * The setting field instance.
	 *
	 * @var mixed
	 */
	protected $setting = Setting\Resources\GeneralFields::class;

	/**
	 * Get the bundle's sections.
	 *
	 * @return array
	 */
	public function getSections()
	{
		$settings = [
			[
				'slug'			=> 'settings',
				'uriKey'		=> 'core',
				'component'		=> 'ofcold.bundle.settings::index',
				'singularLabel'	=> 'General'
			],
		];

		$bundles = ofcold('bundle.collection')->getSettings()->filter(function (Bundle $bundle) {
			return $bundle->getSlug() !== $this->getSlug();
		});

		foreach ($bundles as $bundle) {
			$settings[] = [
				'slug'			=> 'settings_bundle_' . $bundle->getSlug(),
				'uriKey'		=> $bundle->getNamespace(),
				'component'		=> 'ofcold.bundle.settings::index',
				'singularLabel'	=> __(ucfirst($bundle->getSlug()))
			];
		}

		return $settings;
	}
}
