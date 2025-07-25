import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if (document.querySelector("#dropzone")) {
    const dropzone = new Dropzone("#dropzone", {
        acceptedFiles: ".jpg,.jpeg,.png,.gif",
        addRemoveLinks: true,
        dictDefaultMessage: "Sube aquí tu imagen",
        dictRemoveFile: "Borrar Archivo",
        maxFiles: 1,
        uploadMultiple: false,
        dictRemoveFileConfirmation:
            "¿Estás seguro de que quieres eliminar este archivo?",
        init: function () {
            if (document.querySelector('input[name="imagen"]').value.trim()) {
                const imagenPublicada = {};
                imagenPublicada.size = 1234; // Tamaño ficticio, puedes ajustarlo según sea necesario
                imagenPublicada.name = document.querySelector(
                    'input[name="imagen"]'
                ).value;
                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(
                    this,
                    imagenPublicada,
                    `/uploads/${imagenPublicada.name}`
                );
                imagenPublicada.previewElement.classList.add(
                    "dz-success",
                    "dz-complete"
                );
            }
        },
    });

    dropzone.on("success", function (file, response) {
        document.querySelector('input[name="imagen"]').value = response.imagen;
    });

    dropzone.on("removedfile", function (file) {
        document.querySelector('input[name="imagen"]').value = "";
    });
}
