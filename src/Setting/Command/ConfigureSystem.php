<?php

namespace Naiveable\SettingsBundle\Command;

use Naiveable\Arrays\Arr;
use Naiveable\Config\Contracts\RepositoryInterface;


/**
 * Class ConfigureSystem
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
class ConfigureSystem
{
	/**
	 * Handle the command.
	 *
	 * @param BundleCollection $bundles
	 * @param Evaluator $evaluator
	 * @param Repository $config
	 */
	public function handle(BundleCollection $bundles, Evaluator $evaluator, RepositoryInterface $config)
	{
		/* @var Bundle $bundle */
		foreach ($bundles->withConfig('settings') as $bundle) {
			foreach ($config->get($bundle->getNamespace('settings')) as $key => $setting) {
				if (isset($setting['env']) && env($setting['env']) !== null) {
					continue;
				}
				if (!isset($setting['bind'])) {
					continue;
				}

				$default = Arr::get($setting, 'config.default_value');
				if (!$settings->has($key = $bundle->getNamespace($key)) && !$default) {
					continue;
				}

				$config->set($setting['bind'], $evaluator->evaluate($default));
			}
		}

		foreach ($bundles->withConfig('settings/settings') as $bundle) {

			foreach ($config->get($bundle->getNamespace('settings/settings')) as $key => $setting) {
				if (isset($setting['env']) && env($setting['env']) !== null) {
					continue;
				}

				if (!isset($setting['bind'])) {
					continue;
				}

				$default = Arr::get($setting, 'config.default_value');

				if (!$settings->has($key = $bundle->getNamespace($key)) && !$default) {
					continue;
				}

				$config->set($setting['bind'], $evaluator->evaluate($default));
			}
		}

		foreach ($config->get('settings/settings', []) as $key => $setting) {

			if (isset($setting['env']) && env($setting['env']) !== null) {
				continue;
			}

			if (!isset($setting['bind'])) {
				continue;
			}

			$default = Arr::get($setting, 'config.default_value');
			if (!$settings->has($key = $key) && !$default) {
				continue;
			}

			$config->set($setting['bind'], $evaluator->evaluate($default));
		}
	}
}
