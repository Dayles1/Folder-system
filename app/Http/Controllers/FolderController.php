<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
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
        return $this->success($folder,'Folder created successfully',201);
    }
    
}
