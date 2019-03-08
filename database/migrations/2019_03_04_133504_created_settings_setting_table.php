<?php

use Naiveable\Database\Facades\Schema;
use Naiveable\Database\Schema\Blueprint;
use Naiveable\Database\Migrations\Migration;

/**
 * Class CreatedSettingsSettingTable
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
class CreatedSettingsSettingTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings_settings', function (Blueprint $table) {
			$table->string('key')->unique();
			$table->string('value')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings_settings');
	}
}
