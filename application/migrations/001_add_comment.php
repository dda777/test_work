<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_comment extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'comment_id' => array(
                                'type' => 'INT',
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'comment_body' => array(
                                'type' => 'TEXT',
                                'null' => FALSE,
                        ),
                        'comment_email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => FALSE,
                        ),
                        'comment_nickname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => TRUE,
                        ),
                        'comment_date_create' => array(
                                'type' => 'DATETIME',
                        ),
                ));
                $this->dbforge->add_key('comment_id', TRUE);
                $this->dbforge->create_table('comment');
        }

        public function down()
        {
                $this->dbforge->drop_table('comment');
        }
}
