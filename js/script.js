const form = document.createElement("form");
const inputID = document.createElement("input");
inputID.type = "hidden";
inputID.name = "id";
form.method = "POST";
form.appendChild(inputID);
function eliminar(id, entidad) {
  Swal.fire({
    title: `Seguro que deseas eliminar el animal # ${id}`,
    text: "Este cambio no lo puedes revertir",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#32b352ff",
    cancelButtonColor: "#fff",
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      form.action =  "../" + entidad +  "/op_eliminar.php";
      inputID.value = id;
      document.body.appendChild(form);
      form.submit();
    }
  });
}
