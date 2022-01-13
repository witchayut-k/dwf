<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Banner;
use App\Models\Content;
use App\Models\Document;
use App\Models\LandingPage;
use App\Models\Video;
use Illuminate\Database\Seeder;

class MigrateUploadFiles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->importAlbumFiles();
        //$this->importBannerFiles();
        // $this->importContentFiles();
        // $this->importDocumentFiles();
        // $this->importLandingPageFiles();
        $this->importVideoFiles();
    }

    public function importAlbumFiles()
    {
        $albums = Album::all();

        foreach ($albums as $album) {
            $album->clearMediaCollection('featured_image');
            $album->clearMediaCollection('gallery_images');
        }

        foreach ($albums as $album) {
            $files = \DB::select('select * from albums_migrate where album_id = ?', [$album->id]);

            foreach ($files as $key => $file) {

                if ($key == 0) {
                    try {
                        $album->addMedia(public_path("uploads/gallerys/" . urlencode($file->migrate_image_url)))
                            ->preservingOriginal()
                            ->sanitizingFileName(function ($fileName) {
                                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                            })
                            ->toMediaCollection('featured_image');
                    } catch (\Exception $e) {
                    }
                }

                try {
                    $album->addMedia(public_path("uploads/gallerys/" . urlencode($file->migrate_image_url)))
                        ->preservingOriginal()
                        ->sanitizingFileName(function ($fileName) {
                            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                        })
                        ->toMediaCollection('gallery_images');
                } catch (\Exception $e) {
                }
            }
        }
    }

    public function importBannerFiles()
    {
        $banners = Banner::orderByDesc('id')->get();
        foreach ($banners as $key => $banner) {
            $banner->sequence = $key + 1;
            $banner->update();
        }

        $banners = Banner::where('migrate_image_url', '!=', null)->get();

        foreach ($banners as $banner) {
            try {
                $banner->clearMediaCollection('featured_image');
                $banner->addMediaFromUrl("https://www.dwf.go.th/assets/img/sliders/" . urlencode($banner->migrate_image_url))
                    // ->preservingOriginal()
                    ->sanitizingFileName(function ($fileName) {
                        return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                    })
                    ->toMediaCollection('featured_image');
            } catch (\Exception $e) {
            }
        }
    }

    public function importContentFiles()
    {
        $contents = Content::all();
        foreach ($contents as $content) {
            try {
                $content->clearMediaCollection('featured_image');
                if ($content->migrate_image_url) {
                    $content->addMedia(public_path("uploads/contents/" . urlencode($content->migrate_image_url)))
                        ->preservingOriginal()
                        ->sanitizingFileName(function ($fileName) {
                            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                        })
                        ->toMediaCollection('featured_image');
                }
            } catch (\Exception $e) {
            }
        }
    }

    public function importDocumentFiles()
    {
        $documents = Document::all();
        foreach ($documents as $document) {
            try {
                $document->clearMediaCollection('file');
                if ($document->migrate_file_url) {
                    $document->addMedia(public_path("uploads/Downloads/" . urlencode($document->migrate_file_url)))
                        ->preservingOriginal()
                        ->sanitizingFileName(function ($fileName) {
                            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                        })
                        ->toMediaCollection('file');
                }
            } catch (\Exception $e) {
            }
        }
    }

    public function importLandingPageFiles()
    {
        $contents = LandingPage::all();
        foreach ($contents as $content) {
            try {
                $content->clearMediaCollection('featured_image');
                if ($content->migrate_image_url) {
                    $content->addMedia(public_path("uploads/Intropage/" . urlencode($content->migrate_image_url)))
                        ->preservingOriginal()
                        ->sanitizingFileName(function ($fileName) {
                            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                        })
                        ->toMediaCollection('featured_image');
                }
            } catch (\Exception $e) {
            }
        }
    }

    public function importVideoFiles()
    {
        $contents = Video::all();
        foreach ($contents as $content) {
            try {
                $content->clearMediaCollection('featured_image');
                if ($content->migrate_image_url) {
                    $content->addMedia(public_path("uploads/video/" . urlencode($content->migrate_image_url)))
                        ->preservingOriginal()
                        ->sanitizingFileName(function ($fileName) {
                            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                        })
                        ->toMediaCollection('featured_image');
                }
            } catch (\Exception $e) {
            }

            try {
                $content->clearMediaCollection('video');
                if ($content->migrate_video_url) {
                    $content->addMedia(public_path("uploads/video/" . urlencode($content->migrate_video_url)))
                        ->preservingOriginal()
                        ->sanitizingFileName(function ($fileName) {
                            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                        })
                        ->toMediaCollection('video');
                }
            } catch (\Exception $e) {
            }
        }
    }
}
