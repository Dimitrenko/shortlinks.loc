<?php

use yii\db\Migration;

/**
 * Handles the creation of table `statistic`.
 */
class m170217_182851_create_statistic_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("CREATE  TABLE IF NOT EXISTS `statistic` (
                      `idstatistic` INT NOT NULL AUTO_INCREMENT ,
                      `сountry` VARCHAR(50) NOT NULL COMMENT 'страна откуда пользователь' ,
                      `city` VARCHAR(50) NOT NULL COMMENT 'Город пользователя' ,
                      `browser` VARCHAR(100) NOT NULL COMMENT 'Браузер' ,
                      `version` VARCHAR(100) NOT NULL COMMENT 'Браузер' ,
                      `os` VARCHAR(45) NOT NULL COMMENT 'Операционная система' ,
                      `dt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время перехода' ,
                      `links_idlinks` INT(11) NOT NULL ,
                      PRIMARY KEY (`idstatistic`) ,
                      INDEX `fk_statistic_links` (`links_idlinks` ASC) ,
                      CONSTRAINT `fk_statistic_links`
                        FOREIGN KEY (`links_idlinks` )
                        REFERENCES `links` (`idlinks` )
                        ON DELETE CASCADE
                        ON UPDATE CASCADE)");
        }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('statistic');
    }
}
