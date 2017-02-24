<?php

use yii\db\Migration;

/**
 * Handles the creation of table `links`.
 */
class m170215_073523_create_links_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("CREATE  TABLE IF NOT EXISTS `links` (
                  `idlinks` INT(11) NOT NULL AUTO_INCREMENT ,
                  `sourse_url` VARCHAR(255) NOT NULL COMMENT 'исходный url' ,
                  `short_url` VARCHAR(255) NOT NULL COMMENT 'короткий url' ,
                  `dt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата создания' ,
                  `time_of_death` VARCHAR(30) NULL DEFAULT '0' COMMENT 'время жизни ссылки 0 вечная' ,
                  `delete` INT(1) NOT NULL DEFAULT '0' COMMENT 'при удалении значение меняется на 1' ,
                  PRIMARY KEY (`idlinks`))");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('links');
    }
}
