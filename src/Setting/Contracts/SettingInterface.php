<?php

namespace Naiveable\SettingsBundle\Setting\Contracts;

/**
 * interface SettingInterface
 *
 * PHP business application development core system
 *
 * This content is released under the Business System Toll License (MST)
 *
 * @link	 https://ofcold.com
 * @link	 https://naiveable.ofcold.com
 *
 * @author   Ofcold Naiveable Team (naiveable@ofcold.com)
 * @author   Bill Li (bill.li@ofcold.com)
 *
 * @license https://dev.ofcold.com/licenses  MST License
 *
 * @copyright  Copyright (c) 2017-2019 Ofcold Institute of Technology. All rights reserved.
 */
interface SettingInterface
{
	/**
	 * Get the key.
	 *
	 * @return string
	 */
	public function getKey();

	/**
	 * Set the key.
	 *
	 * @param $key
	 *
	 * @return $this
	 */
	public function setKey($key);

	/**
	 * Get the value.
	 *
	 * @return mixed
	 */
	public function getValue();

	/**
	 * Set the value.
	 *
	 * @param $value
	 *
	 * @return $this
	 */
	public function setValue($value);
}
