<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageHelper
{
    public static function savePdfForGallery($image,$diskName)
    {
        // extract mime type
        //dd(Storage::disk($diskName));

        $fileName=$image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $exists = Storage::disk($diskName)->exists($fileName);
        if($exists)
        {
            $fileName = uniqid().'.'. $extension; // rename file as a unique name
        }

        $destinationPath = Storage::disk($diskName)->getAdapter()->getPathPrefix().'thumbs';
        //dd($destinationPath);
        $img = Image::make($image->getRealPath());
        $img->resize(500, 250, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($destinationPath.'/'.$fileName);
       // dd($destinationPath.'/'.$fileName);
        
        //echo $image->getRealPath();die;
        Storage::disk($diskName)->put($fileName, file_get_contents($image->getRealPath()));
        return $fileName;
    }
    public static function saveFileForGallery($image,$diskName)
    {
        // extract mime type
        try{
            
            $fileName=$image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $exists = Storage::disk($diskName)->exists($fileName);
            if($exists)
            {
                $fileName = uniqid().'.'. $extension; // rename file as a unique name
            }
                //dd($diskName);
    
            
            
            //echo $image->getRealPath();die;
            Storage::disk($diskName)->put($fileName, file_get_contents($image->getRealPath()));
            return $fileName;
        }catch(\Exception $e){
            dd($e->message());
        }
    }
    public static function removePdfMaterial($image,$diskName)
    {
        if( Storage::disk($diskName)->exists($image))
        {
            Storage::disk($diskName)->delete($image);
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function createThumbnail($exist_filename,$diskName)
    {
        //dd();
        try{
            $image=Storage::disk($diskName)->getAdapter()->getPathPrefix().$exist_filename;
            $destinationPath = Storage::disk($diskName)->getAdapter()->getPathPrefix().'thumbs';
           // $fileName=;
            $img = Image::make($image);
            $img->resize(300, 175, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($destinationPath.'/'.$exist_filename);
        }  
        catch(\Exception $e){
        dd($e->getMessage());
        }
        //Storage::disk($diskName)->put('/thumbnails'.'/'.$fileName, $img, 'public');
        
    }

}