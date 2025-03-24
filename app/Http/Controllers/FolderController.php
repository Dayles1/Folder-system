<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Resources\FolderResource;
use App\Http\Requests\FolderStoreRequest;
use App\Http\Requests\FolderUpdateRequest;

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
    public function update(FolderUpdateRequest $request , $id)
    {
        $folder=Folder::findOrFail($id);
        if($request->hasFile('icon'))
        {
            $this->deletePhoto($folder->icon);
            $icon=$this->uploadPhoto($request->file('icon'),'icons');
            $folder->icon=$icon;
        }
       
        $folder->name=$request->name;
        $folder->save();
        
        
        return $this->success(new FolderResource($folder->load('parent','children')),'Folder updated successfully');
    }

}
