window.addEventListener('DOMContentLoaded', event => {
   // Simple-DataTables
   // https://github.com/fiduswriter/Simple-DataTables/wiki

   const datatablesSimple = document.querySelector('#datatablesSimple');
   if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple,{
         labels: {
            placeholder: "Buscar...",
            perPage: "Mostrar {select} entradas por pagina",
            noRows: "Entradas no encontradas",
            info: "Mostrando {start} del {end} a {rows} entradas",
        },
      });

   }
});