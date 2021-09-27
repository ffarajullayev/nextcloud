<?php

declare(strict_types=1);

namespace OCA\DAV\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\DB\Types;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version1020Date20210826093640 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		$schema = $schemaClosure();

		if (!$schema->hasTable('calendar_appointments')) {
			$table = $schema->createTable('calendar_appointments');

			$table->addColumn('id', Types::BIGINT, [
				'autoincrement' => true,
				'notnull' => true,
				'length' => 11,
				'unsigned' => true
			]);
			// Appointment
			$table->addColumn('name', Types::STRING, [
				'notnull' => true,
				'length' => 128
			]);
			$table->addColumn('description', Types::TEXT, [
				'notnull' => false,
				'length' => null
			]);
			$table->addColumn('location', Types::TEXT, [
				'notnull' => false,
				'length' => null
			]);
			//Visibility [enum] - PUBLIC (shown somewhere on the user's profile), PRIVATE (only shareable by link)
			$table->addColumn('visibility', Types::STRING, [
				'notnull' => true,
				'length' => 7,
				'default' => 'PRIVATE'
			]);
			// Calendar settings
			$table->addColumn('calendar_uri', Types::STRING, [
				'notnull' => true,
				'length' => 265
			]);
			//Calendar(s) for conflict handling [string array]
			$table->addColumn('calendar_freebusy_uris', Types::TEXT, [
				'notnull' => false,
				'length' => null
			]);
			//Slot availabilities [RRULE]
			$table->addColumn('availability', Types::TEXT, [
				'notnull' => true,
				'length' => null,
			]);
			$table->addColumn('length', Types::INTEGER, [
				'notnull' => true
			]);
			$table->addColumn('increment', Types::INTEGER, [
				'notnull' => true
			]);
			$table->addColumn('preparation_duration', Types::INTEGER, [
				'notnull' => false,
				'default' => null
			]);
			$table->addColumn('followup_duration', Types::INTEGER, [
				'notnull' => false,
				'default' => null
			]);
			$table->addColumn('buffer', Types::INTEGER, [
				'notnull' => false,
				'default' => null
			]);
			//Maximum slots per day - if 0, fit as many as possible
			$table->addColumn('daily_max', Types::INTEGER, [
				'notnull' => false,
				'default' => null
			]);


			$table->setPrimaryKey(['id']);

			return $schema;
		}

		return null;
	}
}
