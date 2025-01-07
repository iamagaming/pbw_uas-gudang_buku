<?php
function getDefaultBookImage() {
    // Buat gambar default menggunakan GD Library
    $width = 400;
    $height = 600;
    $image = imagecreatetruecolor($width, $height);
    
    // Warna background
    $bg = imagecolorallocate($image, 26, 26, 46);
    imagefill($image, 0, 0, $bg);
    
    // Warna untuk icon
    $color = imagecolorallocate($image, 0, 242, 254);
    
    // Gambar placeholder text
    $text = "No Image";
    $font_size = 5;
    $font = imageloadfont('assets/fonts/font.gdf');
    
    // Posisi text di tengah
    $text_width = imagefontwidth($font_size) * strlen($text);
    $text_height = imagefontheight($font_size);
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    
    imagestring($image, $font_size, $x, $y, $text, $color);
    
    // Output sebagai base64
    ob_start();
    imagepng($image);
    $image_data = ob_get_clean();
    imagedestroy($image);
    
    return 'data:image/png;base64,' . base64_encode($image_data);
}
?> 