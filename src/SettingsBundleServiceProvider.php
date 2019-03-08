<?php

namespace Naiveable\SettingsBundle;

use Naiveable\Foundation\Ofcold;
use Naiveable\Routing\Facades\Route;
use Naiveable\SettingsBundle\Setting\Resources\GeneralFields;
use Naiveable\SettingsBundle\Setting\Resources\Setting;
use Naiveable\Support\Contracts\ConfigableProviderInterface;
use Naiveable\Support\Contracts\ConsoleableProviderInterface;
use Naiveable\Support\Contracts\MigrateableProviderInterface;
use Naiveable\Support\Contracts\RouteableProviderInterface;
use Naiveable\Support\Contracts\TranslatableProviderInterface;
use Naiveable\Support\ServiceProvider;

/**
 * class SettingsBundleServiceProvider
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
class SettingsBundleServiceProvider extends ServiceProvider implements RouteableProviderInterface,
																TranslatableProviderInterface,
																MigrateableProviderInterface,
																// ConsoleableProviderInterface,
																ConfigableProviderInterface
{
	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'Naiveable\SettingsBundle\Http\Controllers';

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register(): void
	{
		$this->registerBundle('naiveable.bundle.settings', __DIR__);
	}

	/**
	 * Configure Streams.
	 *
	 * @return [type] [description]
	 */
	public function boot(): void
	{
		$this->resources();

		$this->cards();
		$this->tools();
		//$this->dispatch(new ConfigureSystem());
	}

	/**
	 * Register the application's Ofcold resources.
	 *
	 * @return void
	 */
	protected function resources()
	{
		Ofcold::resources([
			Setting::class
		]);
	}

	/**
	 * Get the tools that should be listed in the Nova sidebar.
	 *
	 * @return array
	 */
	public function tools()
	{
		// Ofcold::tools([
		// 	//new Settings,
		// ]);
	}

	/**
	 * Get the cards that should be displayed on the Nova dashboard.
	 *
	 * @return array
	 */
	protected function cards()
	{
		// return Ofcold::cards([
		// 	new Cards\Help
		// ]);
	}

	public function map()
	{
		Route::namespace($this->getNamespaceForApp('Admin'))
			->domain(config('app.domain.api', null))
			->middleware('auth:api')
			->as('naiveable.bundle.settings::api.')
			->group(function () {
				Route::get('admin/settings/{namespace?}', 'SettingController@form');
				Route::post('admin/settings/{namespace?}', 'SettingController@store');
			});
	}

	/**
	 * Register configuration namespace any bundle services.
	 *
	 * @return void
	 */
	public function configRegister(): void
	{
		// Load package configuration.
		$this->addNamespaceForConfig($this->bundle->getNamespace(), $this->bundle->getPath('resources/config'));
	}

	/**
	 * Register view namespace any bundle services.
	 *
	 * @return void
	 */
	public function viewRegister(): void
	{
		// Add the view namespaces.
		$this->addNamespaceForView($this->bundle->getNamespace(), $this->bundle->getPath('resources/views'));
	}

	/**
	 * Register translation namespace any bundle services.
	 *
	 * @return void
	 */
	public function translatorRegister(): void
	{
		$path = $this->bundle->getPath('resources/lang');

		// Load package translator.
		$this->loadTranslationsFrom($path, $this->bundle->getNamespace());
		$this->loadJsonTranslationsFrom($path);
	}

	/**
	 * Register a database migrate files of the service provider.
	 *
	 * @return void
	 */
	public function migrateRegister(): void
	{
		// Register a database migration path.
		$this->loadMigrationsFrom($this->bundle->getPath('database/migrations'));
	}
}
