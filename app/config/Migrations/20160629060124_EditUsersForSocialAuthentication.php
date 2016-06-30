<?php
use Migrations\AbstractMigration;

class EditUsersForSocialAuthentication extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('users')
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 42,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 42,
                'null' => true,
            ])
            ->addColumn('facebook_id', 'string', [
                'default' => null,
                'limit' => 42,
                'null' => true,
            ])
            ->removeColumn('is_admin')
            ->addColumn('is_admin', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();
    }
}
