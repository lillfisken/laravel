<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:16
 */

namespace market\core\interfaces;


use market\models\Market;

interface iMarketCreate
{
    public function getTitleNew();

    public function getMarketType();

    /**
     * @param $input
     * @return Market
     */
    public function previewFromCreateForm($input);

    public function editFromCreatePreview();

    /**
     * @param $input
     * @return Market
     */
    public function saveFromCreateForm($input);

    /**
     * @return Market
     */
    public function saveFromCreatePreview();
}