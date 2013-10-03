<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

interface MovieInterface
{
    public function getId();
    public function setId($id);

    public function getTitle();
    public function setTitle($title);
}