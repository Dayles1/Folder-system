<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Resources\FolderResource;
use App\Http\Requests\FolderStoreRequest;
use App\Http\Requests\FolderUpdateRequest;

class FolderController extends Controller
{
    public function index(){
        $folders=Folder::with('children.children')->whereNull('parent_id')->paginate(perPage: 2);
    
        return $this->responsePagination($folders,FolderResource::collection($folders->items()),'Folders retrieved successfully');
    }
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
    public function destroy($id)
    {
        $folder=Folder::findOrFail($id);
        $this->deletePhoto($folder->icon);
        $folder->delete();
        return $this->success(null,'Folder deleted successfully');
    }
    public function search(Request $request)
    {
        $folders=Folder::where('name','like',"%$request->search%")->paginate(1);
        return $this->responsePagination($folders,FolderResource::collection($folders->items()),'Folders retrieved successfully');
    }
}
