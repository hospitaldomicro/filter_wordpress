# filter_wordpress
É um filtro que implementei no arquivos functions.php presente no template ativo no Wordpress.
Basicamente limito no código a diretiva de tamanho máximo de upload presente no servidor web, no meu caso está em 32Mb.
Essa limitação afeta o envio de fotos apenas onde limito em 8Mb e exibo uma mensagem personalizada ao usuário.
Além disso também verifico a resolução em dpi da imagem enviada, se tiver mais de 72 dpi bloqueio o envio e exibo a mensagem personalizada. Neste caso uso a lib Image Magick.
Por último bloqueio a string "WhatsApp" no nome do arquivo enviado para conscientizar o operador a utilizar nomes bons para SEO no lugar dos nomes que ele obtém no Whatsapp. Pode mudar para qualquer coisa, foi o meu exemplo.
