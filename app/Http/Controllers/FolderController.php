<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Resources\FolderResource;
use App\Http\Requests\FolderStoreRequest;

class FolderController extends Controller
{
    public function store(FolderStoreRequest $request)
    {
        $icon=$this->uploadPhoto($request->file('icon'),'icons');

        $folder=Folder::create([
            'name'=>$request->name,
            'icon'=>$icon,
            'parent_id'=>$request->parent_id,
        ]);
        return $this->success(new FolderResource($folder->load('parent')),'Folder created successfully',201);
    }

}
