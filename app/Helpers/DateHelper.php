<?php 
namespace App\Helpers;

use Auth;
use Carbon\Carbon;

class DateHelper
{
    public static function toString($date) 
    {
        if (empty($date) || $date == '0000-00-00') 
            return '';
        else if (gettype($date) == 'object') {
            $date = Carbon::parse($date);
            if ($date->format('H:i:s') == "00:00:00") {
                return $date->format('d/m/Y');
            } else {
                return $date->format('d/m/Y H:i:s');
            }
        }
        else {
            return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
        }
    }

    public static function dayList () {
        return array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');
    }

    public static function day($index) {
        $days = DateHelper::dayList();
        return $days[$index];
    }

    public static function isToday($date) 
    {
        return Carbon::parse($date)->eq(Carbon::today());
    }

    public static function isPastDate($date) 
    {
        return !Carbon::parse($date)->gte(Carbon::today());
    }

    public static function isPastDatetime($date) 
    {
        return !Carbon::parse($date)->gte(Carbon::now());
    }

    public static function isBetween($date, $begin, $end) 
    {
        if (empty($date)) return false;
        $begin = Carbon::createFromFormat('d/m/Y', $begin);
        $end = Carbon::createFromFormat('d/m/Y', $end);
        return $date->gte($begin->startOfDay()) && $date->lte($end->endOfDay());
    }

    public static function renderTime($value) 
    {
        return empty($value) ? "" : date('H:i', strtotime($value));
    }

    public static function renderTimeRange($begin, $end) 
    {
        $begin = date('H:i', strtotime($begin));
        $end = DateHelper::isEmptyTime($end) ? NULL : date('H:i', strtotime($end));
        $result = "";
        if ($begin == $end || empty($end)) {
            $result = $begin;
        } else {
            $result = $begin." - ".$end;
        } 
        return $result;
    }

    public static function renderDateRange($begin, $end, $format = "j F Y") 
    {
        $result = "";
        if ($begin == $end || empty($end)) {
            $result = $begin->addYear(543)->translatedFormat($format);
        } else if ($begin->year == $end->year && $begin->month != $end->month) {
            $result = $begin->addYear(543)->translatedFormat("j F")." - ".$end->addYear(543)->translatedFormat($format);
        } else if ($begin->year == $end->year && $begin->month == $end->month) {
            $result = $begin->addYear(543)->translatedFormat("j")." - ".$end->addYear(543)->translatedFormat($format);
        } else {
            $result = $begin->addYear(543)->translatedFormat($format)." - ".$end->addYear(543)->translatedFormat($format);
        }
        return $result;
    }

    public static function isEmptyTime($value) {
        return (empty($value) || $value=="00:00" || $value=="00:00:00");
    }

    public static function createDateTime($date, $time) {
        if (!DateHelper::isEmptyTime($time)) {
            return Carbon::parse($date)->startOfDay();
        } else {
            return Carbon::parse($date->startOfDay().' '.$time);
        }
    }

    public static function roundUpTime($datetime) {
        $datetime = Carbon::parse($datetime);
        $datetime->modify('+1 hour');
        return $datetime->format('H:00');
    }

    public static function monthName($index) 
    {
        $months = [
            __('date.january'),
            __('date.febuary'),
            __('date.march'),
            __('date.april'),
            __('date.may'),
            __('date.june'),
            __('date.july'),
            __('date.august'),
            __('date.september'),
            __('date.october'),
            __('date.november'),
            __('date.december')
        ];
        
        return $months[$index-1];
    }
}
