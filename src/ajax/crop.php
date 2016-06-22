<?php
class Crop extends Utils {
private $w;
private $h;
private $p;
private $src;
private $out = array('s'=>'ok','n'=>NULL);

    function __construct() { $this->src = '../'.$_POST['src']; }

	private function __Infos()
	{	
		$np = $this->GetUName().'.jpg';
		
		if($_POST['_act'] == 1)
		{
			$this->w = array(self::foto_usuario_w);
			$this->h = array(self::foto_usuario_h);
			$this->p = array('fotos/usuarios/'.$np);
		}
		elseif($_POST['_act'] == 2)
		{
			$this->w = array(self::foto_anuncio_w,self::foto_anuncio_thumb_w);
			$this->h = array(self::foto_anuncio_h,self::foto_anuncio_thumb_h);
			$this->p = array('fotos/anuncios/'.$np,'fotos/anuncios/thumbs/'.$np);
		}
		
		$this->out['url'] = $np;
			
		return true;
	}

    public function __run()
	{
		if(!$this->__Infos()) return ;
	
        switch(exif_imagetype($this->src))
		{
          case IMAGETYPE_GIF:
            $src_img = imagecreatefromgif($this->src);
           break;

          case IMAGETYPE_JPEG:
            $src_img = imagecreatefromjpeg($this->src);
           break;

          case IMAGETYPE_PNG:
            $src_img = imagecreatefrompng($this->src);
           break;
        }

        $size = getimagesize($this->src);
        $size_w = $size[0]; // natural width
        $size_h = $size[1]; // natural height

        $src_img_w = $size_w;
        $src_img_h = $size_h;
		
		 $degrees = $_POST['rotate'];

		  // Rotate the source image
		  if (is_numeric($degrees) && $degrees != 0) {
			// PHP's degrees is opposite to CSS's degrees
			$new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );
	
			imagedestroy($src_img);
			$src_img = $new_img;
	
			$deg = abs($degrees) % 180;
			$arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;
	
			$src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
			$src_img_h = $size_w * sin($arc) + $size_h * cos($arc);
	
			// Fix rotated image miss 1px issue when degrees < 0
			$src_img_w -= 1;
			$src_img_h -= 1;
		  }

        $tmp_img_w = $_POST['width'];
        $tmp_img_h = $_POST['height'];
		
		foreach($this->p as $a=>$b)
		{
			$src_x = $_POST['x'];
       		$src_y = $_POST['y'];
		
			$dst_img_w = $this->w[$a];
			$dst_img_h = $this->h[$a];
	
			if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
			  $src_x = $src_w = $dst_x = $dst_w = 0;
			} else if ($src_x <= 0) {
			  $dst_x = -$src_x;
			  $src_x = 0;
			  $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
			} else if ($src_x <= $src_img_w) {
			  $dst_x = 0;
			  $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
			}
	
			if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
			  $src_y = $src_h = $dst_y = $dst_h = 0;
			} else if ($src_y <= 0) {
			  $dst_y = -$src_y;
			  $src_y = 0;
			  $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
			} else if ($src_y <= $src_img_h) {
			  $dst_y = 0;
			  $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
			}
	
			// Scale to destination position and size
			$ratio = $tmp_img_w / $dst_img_w;
			
			$dst_x /= $ratio;
			$dst_y /= $ratio;
			$dst_w /= $ratio;
			$dst_h /= $ratio;
	
			$dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);
	
			imagefill($dst_img, 0, 0, imagecolorallocate($dst_img, 255, 255, 255));
	
			$result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
	
			if(!$result or !imagejpeg($dst_img, '../'.$b,85)) return ;
	
			imagedestroy($dst_img);
		}
		
		imagedestroy($src_img);
		
		$this->out['n'] = $this->p[0];
		
		unlink($this->src);
			
		return json_encode($this->out);
    }
	
  }
?>
