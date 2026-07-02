<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPricingTypeToPackages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('packages', [
            'pricing_type' => [
                'type'       => 'ENUM',
                'constraint' => ['per_jeep', 'per_pax'],
                'default'    => 'per_jeep',
                'after'      => 'price',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('packages', 'pricing_type');
    }
}
