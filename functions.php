//Função Filtro do Marcos para impedir imagens com mais de 8Mb, mas aceitar PDF até 32Mb
function custom_upload_size_limit($file) {
    // Obtém o tipo de arquivo do arquivo carregado
    $filetype = wp_check_filetype($file['name']);

    // Aplica a verificação do nome do arquivo
    $file = check_file_name($file);

    // Define um limite de tamanho personalizado com base no tipo de arquivo
    if ($filetype['ext'] != 'pdf' && $file['size'] > 8388608) { // 8 MB em bytes
        $file['error'] = 'O tamanho do arquivo excede o limite permitido para fotos que é 8Mb. Colabore para que o nosso servidor não fique pesado. Dúvidas: Fale com Marcos Paulo!';
    } elseif ($file['size'] > 33554432) { // 32 MB em bytes
        $file['error'] = 'O tamanho do arquivo excede o limite permitido para PDFs estipulado em 32Mb. Você não precisa enviar um arquivo tão grande!';

    }
    
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'custom_upload_size_limit');

//Função para impedir nomes de arquivo com "WhatsApp Image"
function check_file_name($file) {
    if (stripos($file['name'], 'WhatsApp') !== false) {
        $file['error'] = 'O nome do arquivo não é permitido (contém "WhatsApp"). Renomeie o arquivo antes de enviar com um nome relativo ao release. Dúvidas: Fale com Marcos Paulo!';
    }
    return $file;
}

//Função que utiliza a lib Image Magick para impedir fotos com mais de 72dpi
function custom_dpi_check($file) {
    $filetype = wp_check_filetype($file['name']);
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');

    if (in_array($file['type'], $allowed_types)) {
        $image_path = $file['tmp_name'];
        $imagick = new Imagick();
        $imagick->readImage($image_path);

        $resolution = $imagick->getImageResolution();
        $xDPI = $resolution['x'];
        $yDPI = $resolution['y'];

        if ($xDPI > 72 || $yDPI > 72) {
            $file['error'] = 'A resolução da imagem excede o limite de 72 DPI, redimensione-a. Nunca use alta resolução como se faz para jornais ou revistas. Dúvidas: Fale com Marcos Paulo!';
        }
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'custom_dpi_check');
