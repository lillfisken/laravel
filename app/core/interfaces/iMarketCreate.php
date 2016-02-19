<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 21:16
 */

namespace market\core\interfaces;


interface iMarketCreate
{
    public function getRouteBase();

    public function getTitleNew();

    public function getMarketType();

    public function previewFromCreateForm($input);

    public function editFromCreatePreview();

    public function saveFromCreateForm($input);

    public function saveFromCreatePreview();
}