<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImagesAndPickupToPackages extends Migration
{
    public function up()
    {
        $fields = [];
        
        // Cek apakah pickup_time sudah ada (untuk safety di local yang sudah ditambahkan manual)
        if (!$this->db->fieldExists('pickup_time', 'packages')) {
            $fields['pickup_time'] = [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'description'
            ];
        }

        if (!$this->db->fieldExists('image2', 'packages')) {
            $fields['image2'] = [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'thumbnail'
            ];
        }

        if (!$this->db->fieldExists('image3', 'packages')) {
            $fields['image3'] = [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'image2'
            ];
        }

        if (!$this->db->fieldExists('image4', 'packages')) {
            $fields['image4'] = [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'image3'
            ];
        }

        if (!empty($fields)) {
            $this->forge->addColumn('packages', $fields);
        }
    }

    public function down()
    {
        $fields = [];
        if ($this->db->fieldExists('pickup_time', 'packages')) {
            $fields[] = 'pickup_time';
        }
        if ($this->db->fieldExists('image2', 'packages')) {
            $fields[] = 'image2';
        }
        if ($this->db->fieldExists('image3', 'packages')) {
            $fields[] = 'image3';
        }
        if ($this->db->fieldExists('image4', 'packages')) {
            $fields[] = 'image4';
        }
        
        if (!empty($fields)) {
            $this->forge->dropColumn('packages', $fields);
        }
    }
}
