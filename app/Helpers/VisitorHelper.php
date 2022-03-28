<?php

namespace App\Helpers;

use App\Models\Visitor;
use Carbon\Carbon;

class VisitorHelper
{
    public static function TodayVisitor()
    {
        return Visitor::ofToday()->count();
    }
    public static function YesterdayVisitor()
    {
        return Visitor::ofYesterday()->count();
    }
    public static function MonthVisitor()
    {
        return Visitor::ofMonth()->count();
    }
    public static function YearVisitor()
    {
        $count = Visitor::ofYear()->count();
        if (date('Y') == 2022)
            $count += 30000;

        return $count;
    }
    public static function TotalVisitor()
    {
        return Visitor::count() + 30000;
    }
}
