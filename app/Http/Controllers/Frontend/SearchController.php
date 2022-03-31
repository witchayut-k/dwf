<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\ViewContentSearch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $results = collect();

        if ($request->q) {
            $results = Content::ofPublished()->where('title', 'LIKE', '%' . $request->q . '%')->orWhere('content', 'LIKE', '%' . $request->q . '%')
                ->orderByDesc('updated_at')
                ->paginate(10);

            $results->appends(['q' => $request->q]);
            $results->appends(['search' => $request->search]);

            foreach ($results as $item) {
                $item->title = StringHelper::Mark($item->title, $request->q);
                $item->content = StringHelper::Mark(StringHelper::GetFirstParagraph($item->content), $request->q);
            }
        }

        return view('frontend.search.index', compact('request', 'results'));
    }

    public function advance(Request $request)
    {
        $results = collect();

        if ($request->search) {

            if ($request->q) {
                $query = Content::ofPublished()->where(function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->q . '%')->orWhere('content', 'LIKE', '%' . $request->q . '%');
                })->orderByDesc('updated_at');
            } else {
                $query = Content::ofPublished()->orderByDesc('updated_at');
            }

            if ($request->contentType)
                $query = $query->where('content_type_id', $request->contentType);

            if ($request->begin && $request->end) {
                $beginDate = Carbon::createFromFormat("d/m/Y", $request->begin);
                $endDate = Carbon::createFromFormat("d/m/Y", $request->end);
                $query = $query->whereBetween('created_at', [$beginDate->startOfDay(), $endDate->endOfDay()]);
            } else if ($request->begin) {
                $beginDate = Carbon::createFromFormat("d/m/Y", $request->begin);
                $query = $query->whereDate('created_at', '>=', $beginDate->startOfDay());
            } else if ($request->end) {
                $endDate = Carbon::createFromFormat("d/m/Y", $request->end);
                $query = $query->whereDate('created_at', '<=', $endDate->endOfDay());
            }

            $results = $query->paginate(10);

            $results->appends(['contentType' => $request->contentType]);
            $results->appends(['q' => $request->q]);
            $results->appends(['range' => $request->range]);
            $results->appends(['search' => $request->search]);

            if ($request->q) {
                foreach ($results as $item) {
                    $item->title = StringHelper::Mark($item->title, $request->q);
                    $item->content = StringHelper::Mark(StringHelper::GetFirstParagraph($item->content), $request->q);
                }
            }
        }

        $contentTypes = ContentType::ofPublished()->get();

        return view('frontend.search.advance', compact('request', 'results', 'contentTypes'));
    }
}
