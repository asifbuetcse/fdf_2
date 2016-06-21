<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Filesystem\File;
use Cake\Core\Configure;

/**
 * FileUpload component
 */
class FileUploadComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    function uploadImageToStorage($file) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
        $newFileName = uniqid() . '.' . $ext;
        if (in_array($ext, $arr_ext)) {
            move_uploaded_file($file['tmp_name'], Configure::read('fileUpload.imageFilePath') . $newFileName);
            return $newFileName;
        }
	}

	function removeImageFromStorage($image) {
        $path = Configure::read('fileUpload.imageFilePath') . $image;
        $file = new File($path, false, 0777);
        $file->delete();
	}
}
