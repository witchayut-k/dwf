<?php

namespace App\Helpers;

use App\Models\Visitor;

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
        return Visitor::ofYear()->count();
    }
    public static function TotalVisitor()
    {
        return Visitor::count();
    }
}
