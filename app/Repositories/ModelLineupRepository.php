<?php

namespace App\Repositories;

use App\Models\ModelLineup;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ModelLineupRepository
{
    protected $modelLineup;
    const DESC = "desc";
    const ASC = "asc";

    public function __construct(ModelLineup $modelLineup)
    {
        $this->modelLineup = $modelLineup;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->modelLineup
            ->newQuery()
            ->where($field, $operator, $value);
    }

    public function searchModelLineup($name, $amount, $startedAt, $endedAt, $sort)
    {
        $modelLineups = $this->modelLineup->newQuery();

        if($name != null) {
            $modelLineups = $modelLineups->where("name", $name);
        }

        if($amount != null) {
            $modelLineups = $modelLineups->where("amount", $amount);
        }

        if($startedAt != null && $endedAt != null) {
            $modelLineups = $modelLineups
                ->where("created_at", ">", $startedAt)
                ->where("created_at", ">", $endedAt);
        }

        if($sort == "降順") {
            return $modelLineups
                ->orderBy("id", self::DESC)
                ->paginate(10);
        }else {
            return $modelLineups
                ->orderBy("id", self::ASC)
                ->paginate(10);
        }
    }

    public function modelLineupCreateOrUpdate($id, $name, $detail, $amount, $previewFile, $downloadFile)
    {
        $modelLineup = $this->modelLineup->newQuery();
        $modelFile = $modelLineup->find($id);
        if($previewFile == null) {
            if($modelFile->preview_file == null) {
                $previewUrl = null;
            }else {
                $previewUrl = $modelFile->preview_file;
            }   
        }else {
            //ファイル名
            $now = Carbon::now();
            $fileName = $now->year . $now->month. $now->day . '_' . Str::random() . "_" . $previewFile->getClientOriginalName();
            //s3にアップロード
            $uploaded = $previewFile->storeAs("/preview", $fileName, "s3");
            
            $path = "/preview/" . $fileName;
            //フルパス取得
            $previewUrl = Storage::cloud('s3')->url($path);
        }

        if($downloadFile == null) {
            if($modelFile->download_file == null) {
                $downloadUrl = null;
            }else {
                $downloadUrl = $modelFile->download_file;
            }
        }else {
            //ファイル名
            $now = Carbon::now();
            $fileName = $now->year . $now->month. $now->day . '_' . Str::random() . "_" . $downloadFile->getClientOriginalName();
            //拡張子取得
            $extension = $downloadFile->getClientOriginalExtension();
            
            if($extension == 'mb') {
                //s3にアップロード
                $uploaded = $previewFile->storeAs("/download/maya/", $fileName, "s3");
                $path = "/download/maya/" . $fileName;
            }
            if($extension == 'max') {
                //s3にアップロード
                $uploaded = $previewFile->storeAs("/download/3dsmax/", $fileName, "s3");
                $path = "/download/3dsmax/" . $fileName;
            }
            if($extension == 'fbx') {
                $uploaded = $previewFile->storeAs("/download/game/", $fileName, "s3");
                $path = "/download/game/" . $fileName;
            }
            //フルパス取得
            $downloadUrl = Storage::cloud('s3')->url($path);   
        }

        return $modelLineup
            ->updateOrCreate(
                [ "id" => $id ],
                [
                    "name" => $name,
                    "detail" => $detail,
                    "amount" => $amount,
                    "preview_file" => $previewUrl,
                    "download_file" => $downloadUrl
                ]
            );
    }
}