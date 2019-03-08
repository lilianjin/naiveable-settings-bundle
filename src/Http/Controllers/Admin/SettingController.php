<?php

namespace Naiveable\SettingsBundle\Http\Controllers\Admin;

use Naiveable\Foundation\Bundle\BundleCollection;
use Naiveable\Foundation\Http\Controllers\AdminController;
use Naiveable\Foundation\Http\FormRequest;
use Naiveable\SettingsBundle\Setting\Resources\Setting;

/**
 * class SettingController
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
class SettingController extends AdminController
{
	/**
	 * List the creation fields for the setting.
	 *
	 * @param  BundleCollection $bundles
	 * @param  FormRequest      $request
	 * @param  string           $namespace
	 *
	 * @return \Naiveable\Http\JsonResponse
	 */
	public function form(BundleCollection $bundles, FormRequest $request, string $namespace)
	{
		$this->setResource($request, $namespace);

		return $this->response->json(
			$request->newResource()->updateFields($request)->values()->all()
		);
	}

	/**
	 * Save the settings for the bundle.
	 *
	 * @param  BundleCollection $bundles
	 * @param  FormRequest      $request
	 * @param  string           $namespace
	 *
	 * @return \Naiveable\Http\JsonResponse
	 */
	public function store(BundleCollection $bundles, FormRequest $request, string $namespace)
	{
		$this->setResource($request, $namespace);

		return $this->response->json($request->all());
	}

	/**
	 * Set the resources.
	 *
	 * @param FormRequest $request
	 *
	 * @return  void
	 */
	protected function setResource(FormRequest $request, $namespace): void
	{
		$request->resource = 'settings';

		$resource = $request->resource();

		$resource::authorizeToCreate($request);

		// Set current request configuration fields.
		$resource::setSettingFields(
			ofcold('bundle.collection')->get(
				$namespace === 'core' ? 'naiveable.bundle.settings' : $namespace
			)->getFields()
		);

		if ($this->request->method() === 'POST') {
			$resource::validateForCreation($request);
		}
	}
}
