<?php
namespace App\Component;
use App\Models\DanhMuc;

class Recusive{
    private $data;
    private $htmlSelect = '';

    public function __construct($data) {
        $this->data = $data;
    }
    public function categoryRecusise($parentId, $id = 0, $text = '') {
        foreach ($this->data as $value) {
            if ($value['dm_idcha'] == $id) {
                if(!empty($parentId) && $parentId == $value['dm_id']) {
                    $this->htmlSelect .= "<option selected value='". $value['dm_id']."'>". $text . $value['dm_ten'] ."</option>";
                } else {
                    $this->htmlSelect .= "<option value='". $value['dm_id']."'>". $text . $value['dm_ten'] ."</option>";
                }

                $this->categoryRecusise($parentId, $value['dm_id'], $text. '-');
            }
        }
        return $this->htmlSelect;
    }
}
?>
