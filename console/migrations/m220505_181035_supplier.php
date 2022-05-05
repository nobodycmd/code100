<?php

use yii\db\Migration;

/**
 * Class m220505_181035_supplier
 */
class m220505_181035_supplier extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = <<<EOF
CREATE TABLE `supplier` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `code` char(3) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `t_status` enum('ok','hold') CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT 'ok',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
EOF;
        $this->execute($sql);

        $aryData = [];
        for ($i = 0; $i <= 50; $i++) {
            $str = md5(uniqid());
            $code = 'c' . $i;
            $aryData[] = [$str, $code, substr($str, 0, 1) >= 'f' ? 'ok' : 'hold'];
        }
        $this->batchInsert('supplier', ['name', 'code', 't_status'], $aryData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220505_181035_supplier cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220505_181035_supplier cannot be reverted.\n";

        return false;
    }
    */
}
