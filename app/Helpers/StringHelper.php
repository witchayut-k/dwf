<?php

namespace App\Helpers;

class StringHelper
{
    public static function PageTitle($model, $padNum = 0, $field = "name_th")
    {
        $id = str_pad($model->id, $padNum, '0', STR_PAD_LEFT);
        $name = $model->{$field};
        $moduleName = $model::moduleName();
        $title = $model->id ? "แก้ไข$name #$id" : "เพิ่ม$moduleName";
        return $title;
    }

    public static function Mark($content, $keyword)
    {
        // $content = str_ireplace($keyword, "<mark>$keyword</mark>", $content);
        $content = preg_replace("/$keyword/i", "<mark>\$0</mark>", $content);
        return $content;
    }

    public static function GetFirstParagraph ($content, $limit = 0) {
        $content = substr($content, strpos($content, "<p"), strpos($content, "</p>")+4);
        $content = strip_tags($content);
        $content = str_replace("&nbsp;", "", $content);
        if ($limit > 0)
            $content = substr($content,0 , $limit);
        return $content;
    }
}
