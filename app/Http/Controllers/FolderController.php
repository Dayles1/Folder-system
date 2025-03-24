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
    public function update(Request $request ,Folder $folder)
    {
        if($request->hasFile('icon'))
        {
            $folder->icon->deletePhoto($folder->icon);
            $icon=$this->uploadPhoto($request->file('icon'),'icons');
            $folder->icon=$icon;
        }
        $folder->update([
            'name'=>$request->name,
        ]); 
        return $this->success(new FolderResource($folder->load('parent','child')),'Folder updated successfully');
    }

}
