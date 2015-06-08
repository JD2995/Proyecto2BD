<script type="text/javascript">
stepcarousel.setup({
galleryid: 'carousel', //ID del div que contiene el carrusel
beltclass: 'belt', //Clase del primer div dentro del carrusel, que contiene al resto de divs
panelclass: 'panel', //Clase de cada panel individual
autostep: {enable:true, moveby:1, pause:3000},
panelbehavior: {speed:500, wraparound:true, persist:true},
statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
contenttype: ['external'] //content setting ['inline'] or ['external', 'path_to_external_file']
})
</script>