<?php 

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait FileUpload
{
    public function handleProfileUpload($files,$user_id)
    {
        $filePaths = [];
        foreach ($files as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/user'), $fileName);
            $filePaths[] = [
                'name' => $fileName,
                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        return $filePaths;
    }
}
