<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 01:00
 */

namespace market\core\interfaces;


interface iMarketUpdate
{
    public function editFromStart($id);

    public function saveFromEditForm($input);

    public function saveFromEditPreview();

    public function getRouteBase();

    public function previewFromEditForm($input);

    public function editFromEditPreview();
}