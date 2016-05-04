<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 01:00
 */

namespace market\core\interfaces;


use market\models\Market;

interface iMarketUpdate
{
    public function editFromStart($id);

    /**
     * @param $input
     * @return Market
     */
    public function saveFromEditForm($input);

    /**
     * @return Market
     */
    public function saveFromEditPreview();

    public function previewFromEditForm($input);

    public function editFromEditPreview();
}