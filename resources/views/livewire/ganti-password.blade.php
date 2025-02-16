<div id="ganti-password">

    <h1>Ganti Kata Sandi</h1>

    <form method="POST" action="{{url('/auth/ganti-password')}}" enctype="multipart/form-data">
        
        @if (\Session::has('success'))
        <br><br>
        <div style="color: rgb(0, 228, 0);padding: 1rem;">
            <span>{!! \Session::get('success') !!}</span>   
        </div>
        @endif
        @csrf
        <label for="password-lama">Kata Sandi Lama</label>
        <span>
            <input type="password" name="password_lama" id="password-lama">
            <span><i class="fa-solid fa-lock"></i></span>
        </span>

        <label for="password">Kata Sandi Baru</label>
        <span>
            <input type="password" name="password" id="password">
            <span><i class="fa-solid fa-lock"></i></span>
        </span>

        <label for="password-confirmation">Ketik Ulang Password Baru</label>
        <span>
            <input type="password" name="password_confirmation" id="password-confirmation">
            <span><i class="fa-solid fa-lock"></i></span>
        </span>
        <button class="btn-edit">Ganti Kata Sandi</button>

    </form>

</div>

<script>



  Object.values(data).forEach(errors => {
    
    if(!data.success){
        errors.forEach(error => {
          $("#ganti-password form").prepend('<li id="error-bag">'+error+'</li><br>')
       });
    }
    
    
  });
  
  $("#ganti-password form").prepend('<li style="color:white;background-color:#00BB00;">'+data.success[0]+'</li><br>')
  
  
  data = null;


</script>