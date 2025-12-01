<?php

if (!function_exists('upload_file')) {
    function upload_file($error, $tmp_name, $name_of_image)
    {
        if ($error === UPLOAD_ERR_OK) {
            $imageInfo = getimagesize($tmp_name);

            if ($imageInfo !== false && ($imageInfo['mime'] == 'image/jpeg' || $imageInfo['mime'] == 'image/png' || $imageInfo['mime'] == 'image/webp' || $imageInfo['mime'] == 'image/svg+xml')) {
                $sourceImage = imagecreatefromstring(file_get_contents($tmp_name));

                if ($sourceImage !== false) {
                    // Convert palette-based images to true color
                    if (imageistruecolor($sourceImage) === false) {
                        $trueColorImage = imagecreatetruecolor(imagesx($sourceImage), imagesy($sourceImage));
                        imagecopy($trueColorImage, $sourceImage, 0, 0, 0, 0, imagesx($sourceImage), imagesy($sourceImage));
                        imagedestroy($sourceImage);
                        $sourceImage = $trueColorImage;
                    }

                    $outputImagePath = $name_of_image;

                    // Check if the image is a GIF
                    if ($imageInfo['mime'] == 'image/gif') {
                        $outputImagePath .= '.webp';
                        $success = exec('cwebp -q 80 ' . escapeshellarg($tmp_name) . ' -o ' . escapeshellarg($outputImagePath));
                    } else {
                        // Convert and save as WebP
                        $success = imagewebp($sourceImage, $outputImagePath);
                    }

                    imagedestroy($sourceImage);

                    if ($success) {
                        $uploadDestination = FILE_UPLOAD_PATH . $outputImagePath;

                        if (rename($outputImagePath, $uploadDestination)) {
                            $imgData['msg'] = 'Image successfully converted and uploaded as WebP.';
                            $imgData['status'] = 200;
                        } else {
                            $imgData['msg'] = 'Image upload failed.';
                            $imgData['status'] = 300;
                        }
                    } else {
                        $imgData['msg'] = 'Image conversion failed.';
                        $imgData['status'] = 300;
                    }
                } else {
                    $imgData['msg'] = 'Unable to create source image.';
                    $imgData['status'] = 300;
                }
            } else {
                $imgData['msg'] = 'Invalid image format. Supported formats: JPG, PNG, GIF, SVG, and WEBP';
                $imgData['status'] = 300;
            }
        } else {
            $imgData['msg'] = 'File upload failed.';
            $imgData['status'] = 300;
        }

        return $imgData;
    }
}
?>
