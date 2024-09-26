// Permitir apenas letras e acentuação
function onlyletter(e) {
    const regex = /^[a-zA-ZáÁàÀâÂãÃéÉêÊíÍóÓôÔõÕúÚçÇ]*$/; // Letras com acentuação
    const char = String.fromCharCode(e.keyCode || e.which);

    if (!regex.test(char)) {
        e.preventDefault();
    }
}

// Permitir letras, acentuação e espaços
function onlyletterspace(e) {
    const regex = /^[a-zA-ZáÁàÀâÂãÃéÉêÊíÍóÓôÔõÕúÚçÇ\s]*$/; // Letras, acentuação e espaços
    const char = String.fromCharCode(e.keyCode || e.which);

    if (!regex.test(char)) {
        e.preventDefault();
    }
}
