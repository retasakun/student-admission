<div id="data-diri">

    <div id="biodata">
      
        @livewire('dataAyah')
        @livewire('dataIbu')
        @livewire('dataWali')
     
    </div>

</div>

<script>

  Object.values(data).forEach(errors => {
    errors.forEach(error => {
      $("#wali-selector").after('<li id="error-bag">'+error+'</li><br>')
    });
  });
  data = null;

</script>
