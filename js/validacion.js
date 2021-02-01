/*
 * Copyright (c) 2021. Team Biscochito.
 *
 * Licensed under the GNU General Public License v3.0
 *
 * https://www.gnu.org/licenses/gpl-3.0.html
 *
 * Permissions of this strong copyleft license are conditioned on making available complete
 * source code of licensed works and modifications, which include larger works using a licensed
 * work, under the same license. Copyright and license notices must be preserved. Contributors
 * provide an express grant of patent rights.
 */

/**
 * Validaremos los campos del formulario con JS, ya que con PHP hay problemas al
 * actualizar la página.
 *
 * Se validaran los campos conforme vayamos rellenando el formulario
 *
 * Condiciones de validación de la función:
 *
 *  - Nombre de Carta / Animal, menor a 18 caracteres
 *  - Altura entre un valor de 1-9999
 *  - Peso entre un valor de 1-9999
 *  - Longitud entre un valor de 1-9999
 *  - Altura entre un valor de 1-9999
 *  - Poder mortífero entre un valor de 1-10
 *  - Campo de foto obligatorio
 *  - Descripción ya hecha la validaciñon (0-300 caracteres)
 *
 *  1.- Cuando pulsemos el botón submit, alertar para asegurar si se quiere realizar dicha acción
 *  2.- Cuando pulsemos el botón reset, alertar para asegurar si se quiere realizar dicha acción
 */

$(document).ready(function () {
    let nombreTXT1, alturaTXT2, pesoTXT3, longitudTXT4, velocidadTXT5, poderTXT6, fotoTXT7 = false;

    // Para propiedades de la carta
    let onlyNumber = new RegExp('^(?:[1-9][0-9]{0,3}(?:\\.\\d{1,3})?|9999|9999.00)$');

    // Para poder mortífero
    let onlyNumber1to10 = new RegExp('^[1-9]$|^10$');

    // Solo nombre - Regex
    let onlyLetters = new RegExp('^[A-Z][a-z][A-Za-z-ÖØ-öø-ÿ][\\s\\S]{0,9}$');

    // Validar nombre
    $('#nombre').change(function () {
        let val = $(this).val();
        if (!onlyLetters.test(val)) {
            $('#error').text('Nombre incorrecto (max caracteres 12)')
                .css('color', 'red').show();
            nombreTXT1 = false;
        } else {
            $('#error').hide();
            nombreTXT1 = true;
        }
    });

    // Validar Altura
    $('#altura').change(function () {
        let val = $(this).val();
        if (!onlyNumber.test(val)) {
            $('#error').text('Ponga una altura correcta (1-9999)')
                .css('color', 'red').show();
            alturaTXT2 = false;
        } else {
            $('#error').hide();
            alturaTXT2 = true;
        }
    });

    // Validar Peso
    $('#peso').change(function () {
        let val = $(this).val();
        if (!onlyNumber.test(val)) {
            $('#error').text('Ponga un peso correcto (1-9999)')
                .css('color', 'red').show();
            pesoTXT3 = false;
        } else {
            $('#error').hide();
            pesoTXT3 = true;
        }
    });

    // Validar Longitud
    $('#longitud').change(function () {
        let val = $(this).val();
        if (!onlyNumber.test(val)) {
            $('#error').text('Ponga una longitud correcta (1-9999)')
                .css('color', 'red').show();
            longitudTXT4 = false;
        } else {
            $('#error').hide();
            longitudTXT4 = true;
        }
    });

    // Validar Velocidad
    $('#velocidad').change(function () {
        let val = $(this).val();
        if (!onlyNumber.test(val)) {
            $('#error').text('Ponga una velocidad correcta (1-9999)')
                .css('color', 'red').show();
            velocidadTXT5 = false;
        } else {
            $('#error').hide();
            velocidadTXT5 = true;
        }
    });

    // Validar Poder
    $('#poder').change(function () {
        let val = $(this).val();
        if (!onlyNumber1to10.test(val)) {
            $('#error').text('Ponga un poder correcto (1-10)')
                .css('color', 'red').show();
            poderTXT6 = false;
        } else {
            $('#error').hide();
            poderTXT6 = true;
        }
    });

    // Validar Foto
    $("#validar").on('click', function () {
        var formData = new FormData();
        var files = $('#inputfile')[0].files[0];
        formData.append('file', files);
        $.ajax({
            url: 'index.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response !== 0) {

                } else {
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    });

    $('#inputfile').change(function () {
        if ($(this).val() === null) {
            $('#error').text('Tienes que subir una foto')
                .css('color', 'red').show();
            fotoTXT7 = false;
        } else {
            $('#error').hide();
            fotoTXT7 = true;
        }
    });

    //Boton reset
    // $('#reset').click(function () {
    //     let confirmacion = confirm('¿Estas seguro de quitar todos los datos?');
    //     if (confirmacion) {
    //         $(':reset')
    //         alert("Datos borrados");
    //     } else {
    //         alert("Datos no borrados");
    //     }
    // });

    //Boton submit
    $('#validar').click(function () {
        console.log(nombreTXT1, alturaTXT2, pesoTXT3, longitudTXT4, velocidadTXT5, poderTXT6, fotoTXT7);
        if (nombreTXT1 && alturaTXT2 && pesoTXT3 && longitudTXT4 && velocidadTXT5 && poderTXT6 && fotoTXT7) {
            $('#error').text('Carta lista para añadir')
                .css('color', 'green').show();
            $('#submit').prop('disabled', false);
            $('#submit').css({'background-color': "#1abc9c", 'color': "white"});
            console.log("¡El formulario ha sido enviado!")
        } else {
            if ($("#nombre").val() === "Nombre de la carta / Elefante (primera letra mayúscula) *") {
                nombreTXT1 = false;
            } else if ($("#altura").val() === "Altura (1-9999) *") {
                alturaTXT2 = false;
            } else if ($("#pesoTXT3").val() === "Peso (1-9999) *") {
                pesoTXT3 = false;
            } else if ($("#longitud").val() === "Longitud (1-9999) *") {
                longitudTXT4 = false;
            } else if ($("#velocidad").val() === "Velocidad (1-9999) *") {
                velocidadTXT5 = false;
            } else if ($("#poder").val() === "Poder mortífero (1-10) *") {
                poderTXT6 = false;
            }
            $('#error').text('Los campos con * tienen que rellenarse o existe algún error')
                .css('color', 'red').show();
        }
    });
});