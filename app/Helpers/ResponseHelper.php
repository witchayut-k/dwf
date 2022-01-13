<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ResponseHelper
{
    public static function saveSuccess(Request $request, $object, $key = "title")
    {
        if ($request->ajax()) {
            return response()->json(["id" => $object->id, "data" => $object, "message" => __("shared.save_success", ["name" => $object->{$key}])]);
        }

        return redirect("$request->moduleUrl/$object->id/edit")->with("success", __("shared.save_success", ["name" => $object->{$key}]));
    }

    public static function error(Request $request, $ex)
    {
        throw $ex;
        if ($request->ajax()) {
            return response()->json([
                'code' => $ex->getCode(),
                'message' => $ex->getMessage(),
                'exception' => $ex
            ], 422);
        }

        return redirect("$request->moduleUrl")->withErrors(['error' => $ex->getMessage()]);
    }

    public static function updateSuccess(Request $request, $object, $key = "title")
    {
        if ($request->ajax()) {
            return response()->json(["data" => $object, "message" => __("shared.update_success", ["name" => $object->{$key}])]);
        }

        return redirect("$request->moduleUrl/$object->id/edit")->with("success", __("shared.update_success", ["name" => $object->{$key}]));
    }

    public static function deleteSuccess(Request $request, $object, $key = "title")
    {
        if ($request->ajax()) {
            return response()->json(["data" => $object, "message" => __("shared.delete_success", ["name" => $object->{$key}])]);
        }

        return redirect("$request->moduleUrl")->with("success", __("shared.delete_success", ["name" => $object->{$key}]));
    }

    public static function updateSequenceSuccess(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(["message" => __("shared.update_sequence_success")]);
        }
    }
    

    public static function updateSequenceFailed(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(["message" => __("shared.update_sequence_failed")]);
        }
    }

    public static function updateStatusSuccess(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(["message" => __("shared.update_status_success")]);
        }
    }


    public static function cannotDeleteDependency(Request $request, $object, $key = "title")
    {
        if ($request->ajax()) {
            $errors = [];
            if (isset($object['herbs'])) {
                $object->herbs->map(function ($herb) {
                    $herb->group = "ข้อมูลสมุนไพร";
                    $herb->name = $herb->name_th;
                    $herb->url = url("admin/herbs/$herb->id/edit");
                });

                foreach ($object->herbs as $herb) {
                    $errors[] = $herb;
                }
            }

            if (isset($object['recipes'])) {
                $object->recipes->map(function ($recipe) {
                    $recipe->group = "ข้อมูลตำรับยาสมุนไพร";
                    $recipe->name = "รหัส" . $recipe->book->alias . " ตำรับที่ " . $recipe->recipe_number;
                    $recipe->url = url("admin/books/recipes/$recipe->id/edit");
                });

                foreach ($object->recipes as $recipe) {
                    $errors[] = $recipe;
                }
            }
            return response()->json(["data" => $object, "errors" => $errors, "message" => __("shared.delete_error_dependency", ["name" => $object->{$key}])], 422);
        }

        return redirect("$request->moduleUrl")->with("error", __("shared.delete_error_dependency", ["name" => $object->{$key}]));
    }
}
